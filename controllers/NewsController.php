<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/News.php';
class NewsController extends Controller
{

  private $categoryModel;
  private $newsModel;
  private $uploadDir;
  public function __construct($pdo)
  {
    $this->categoryModel = new Category($pdo);
    $this->newsModel = new News($pdo);
    $this->uploadDir = __DIR__ . '/../uploads/';

    //Cek, kalau folder tidak ada kita buat
    if (!is_dir($this->uploadDir)) {
      mkdir($this->uploadDir, 0777, true);
    }
  }


  public function index()
  {
    $pageTitle = "Daftar Berita";
    $dataBerita = $this->newsModel->getAll();
    $this->view('news/index', [
      'pageTitle' => $pageTitle,
      'dataBerita' => $dataBerita
    ]);
  }

  public function create()
  {
    $pageTitle = "Tambah Berita";
    $categories = $this->categoryModel->getAll();
    $this->view('news/create', [
      'pageTitle' => $pageTitle,
      'categories' => $categories
    ]);
  }

  public function store()
  {
    $id_category = $_POST['id_category'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id_user = $_SESSION['user']['id'];

    // Handle upload file
    $namaFile = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $namaFile =  $_FILES['image']['name'];
      $tmpFile = $_FILES['image']['tmp_name'];
      $fileExt = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
      $allowedExt = ['jpg', 'jpeg', 'png','webp'];

      //validasi ekstensi file
      if (!in_array($fileExt, $allowedExt)) {
        set_flash('danger', 'Ekstensi file tidak diizinkan. Hanya jpg, jpeg, dan png yang diperbolehkan.');
        $this->redirect('admin/news/create');
        exit;
      }

      //validasi ukuran file : 2MB
      $maxSize = 2 * 1024 * 1024; // 2MB
      if ($_FILES['image']['size'] > $maxSize) {
        set_flash('danger', 'Ukuran file terlalu besar. Maksimal 2MB.');
        $this->redirect('admin/news/create');
        exit;
      }

      $namaFile = uniqid("img_", true) . '.' . $fileExt;
      move_uploaded_file($tmpFile, $this->uploadDir . $namaFile);
    }
    $news = [
      'title' => $title,
      'content' => $content,
      'slug' => strtolower(str_replace(' ', '-', $title)),
      'id_category' => $id_category,
      'id_user' => $id_user,
      'image' => $namaFile
    ];
    $this->newsModel->store($news);
    set_flash('success', 'Berita berhasil ditambahkan.');
    $this->redirect('admin/news');
  }   
  public function edit($id)
  {
    $pageTitle = "Edit Berita";
    $categories = $this->categoryModel->getAll();
    $news = $this->newsModel->getById($id);

    //cek apakah news ada
    if (!$news) {
        set_flash('danger', 'Berita tidak ditemukan.');
        $this->redirect('admin/news');
        exit;
    }

    $this->view('news/edit', [
        'pageTitle' => $pageTitle,
        'categories' => $categories,
        'news' => $news
    ]);
  }
    public function update ()
  {
    $id = $_POST['id'];
    $id_category = $_POST['id_category'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id_user = $_SESSION['user']['id'];

    // Handle upload file
    $namaFile = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $namaFile =  $_FILES['image']['name'];
      $tmpFile = $_FILES['image']['tmp_name'];
      $fileExt = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
      $allowedExt = ['jpg', 'jpeg', 'png','webp'];

      //validasi ekstensi file
      if (!in_array($fileExt, $allowedExt)) {
        set_flash('danger', 'Ekstensi file tidak diizinkan. Hanya jpg, jpeg, dan png yang diperbolehkan.');
        $this->redirect('admin/news/create');
        exit;
      }

      //validasi ukuran file : 2MB
      $maxSize = 2 * 1024 * 1024; // 2MB
      if ($_FILES['image']['size'] > $maxSize) {
        set_flash('danger', 'Ukuran file terlalu besar. Maksimal 2MB.');
        $this->redirect('admin/news/create');
        exit;
      }

      $namaFile = uniqid("img_", true) . '.' . $fileExt;
      move_uploaded_file($tmpFile, $this->uploadDir . $namaFile);
    }
    $news = [
      'id' => $id,
      'title' => $title,
      'content' => $content,
      'slug' => strtolower(str_replace(' ', '-', $title)),
      'id_category' => $id_category,
      'id_user' => $id_user,
      'image' => $namaFile
    ];
    $this->newsModel->update($news);
    set_flash('success', 'Berita berhasil ditambahkan.');
    $this->redirect('admin/news');
  } 
  public function delete($id)
{
    $news = $this->newsModel->getById($id);

    // cek apakah news ada
    if (!$news) {
        set_flash('danger', 'Berita tidak ditemukan.');
        $this->redirect('admin/news');
        exit;
    }

    // Hapus file gambar jika ada
    if ($news['image']) {
        $imagePath = $this->uploadDir . $news['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $this->newsModel->delete($id);
    set_flash('success', 'Berita berhasil dihapus.');
    $this->redirect('admin/news');
}
   
}