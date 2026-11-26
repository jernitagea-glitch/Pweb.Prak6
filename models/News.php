<?php

class News
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getAll()
  {
    $query = "Select c.name as category_name, c.description, u.name as user_name, n.* 
    from news as n
    join categories as c on n.id_category = c.id 
    join users as u on n.id_user = u.id 
    order by n.created_at desc";
    $stmt = $this->pdo->query($query);
    return $stmt->fetchAll();
  }
  
  public function getByCategory($id_category)
{
    $query = "select n.*, c.name as category_name, u.name as user_name
              from news n
              join categories c on n.id_category = c.id
              join users u on n.id_user = u.id
              where n.id_category = :id_category";

    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['id_category' => $id_category]);
    return $stmt->fetchAll();
}

  public function getById($id)
  {
    $query = "Select c.name, c.description, u.name, n.* 
    from news as n
    join categories as c on n.id_category = c.id 
    join users as u on n.id_user = u.id 
    where n.id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

public function getBySlug($slug)
{
    $query = "SELECT
                c.name AS category_name,
                c.description AS category_description,
                u.name AS user_name,
                n.*
              FROM news AS n
              JOIN categories AS c ON n.id_category = c.id
              JOIN users AS u ON n.id_user = u.id
              WHERE n.slug = :slug";

    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['slug' => $slug]);

    return $stmt->fetch();
}


  public function store(array $news)
  {
    $query = "insert into news(title,content,slug,id_category,id_user,image) 
    values (:title, :content, :slug, :id_category, :id_user, :image)";
    $stmt = $this->pdo->prepare($query);
    return $stmt->execute([
      'title' => $news['title'],
      'content' => $news['content'],
      'slug' => $news['slug'],
      'id_category' => $news['id_category'],
      'id_user' => $news['id_user'],
      'image' => $news['image'],
    ]);
  }
  public function update(array $news)
  {
    if ($news['image'] != null) {
        $query = "update news set title = :title, content = :content, slug = :slug, id_category = :id_category,
         id_user = :id_user, image = :image where id = :id";
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            'title' => $news['title'],
            'content' => $news['content'],
            'slug' => $news['slug'],
            'id_category' => $news['id_category'],
            'id_user' => $news['id_user'], 
            'image' => $news['image'],
            'id' => $news['id']
        ]);
    }

    // Kondisi dimana image null -> tidak diupdate
    $query = "update news set title = :title, content = :content, slug = :slug, id_category = :id_category,
        id_user = :id_user where id = :id";
    $stmt = $this->pdo->prepare($query);
    return $stmt->execute([
        'title' => $news['title'],
        'content' => $news['content'],
        'slug' => $news['slug'],
        'id_category' => $news['id_category'],
        'id_user' => $news['id_user'],
        'id' => $news['id']
    ]);
  }
    public function delete($id)
    {
      $query = "delete from news where id = :id";
      $stmt = $this->pdo->prepare($query);
      return $stmt->execute(['id' => $id]);
    }
 

}