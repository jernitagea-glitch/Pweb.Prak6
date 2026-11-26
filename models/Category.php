<?php
class Category
{
  private $pdo;
  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  # 1.READ : Fungsi untuk mengambil semua data kategori dari database
  public function getAll()
  {
    $stmt = $this->pdo->prepare("select * from categories order by id desc");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  # 2.READ : Fungsi untuk mengambil data kategori berdasarkan id
  public function getById($id)
  {
    $stmt = $this->pdo->prepare("select * from categories where id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  # 3.CREATE : Fungsi untuk menambahkan data kategori baru
  public function store($name, $description)
  {
    $stmt = $this->pdo->prepare("insert into categories (name, description) 
    values (:name, :description)");
    $stmt->execute(['name' => $name, 'description' => $description]);
  }

  # DELETE
  public function delete($id){
    $stmt = $this->pdo->prepare("delete from categories where id = :id");
    $stmt->execute(['id' => $id]);
  }

  public function update($id, $name, $description){
    $stmt = $this->pdo->prepare("update categories set name = :name, description = :description where id = :id");
    $stmt->execute(['id' => $id, 'name' => $name, 'description' => $description]);
  }
}