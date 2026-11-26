<?php

require_once __DIR__ . '/../models/Category.php';
class CategoryController
{
  private $categoryModel;

  public function __construct($pdo)
  {
    $this->categoryModel = new Category($pdo);
  }

  public function index()
  {
    $pageTitle = "List Kategori";
    $dataKategori = $this->categoryModel->getAll();

    require __DIR__ . '/../views/layouts/admin_header.php';
    require __DIR__ . '/../views/category/index.php';
    require __DIR__ . '/../views/layouts/admin_footer.php';
  }

  public function create()
  {
    $pageTitle = "Tambah Kategori";

    require __DIR__ . '/../views/layouts/admin_header.php';
    require __DIR__ . '/../views/category/create.php';
    require __DIR__ . '/../views/layouts/admin_footer.php';
  }
  public function store()
  {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    $this->categoryModel->store($name, $description);
    set_flash('success', "Kategori Berhasil disimpan");
    header("Location: /admin/category");
    exit();
  }

  public function delete($id)
  {
    if (!empty($id)) {
      $category = $this->categoryModel->getById($id);
      if ($category) {
        $this->categoryModel->delete($id);
        set_flash('success', "Kategori Berhasil dihapus");
      } else {
        set_flash('danger', "Kategori tidak ditemukan");
      }
    } else {
      set_flash('danger', "ID Kategori tidak valid");
    }
    header("Location: /admin/category");
    exit();
  }

  public function edit($id)
  {
    $pageTitle = "Edit Kategori";
    $category = $this->categoryModel->getById($id);
    if (!$category) {
      set_flash('danger', "Kategori tidak ditemukan");
      header("Location: /admin/category");
      exit();
    }
    #kondisi dimana ada kategori
    require __DIR__ . '/../views/layouts/admin_header.php';
    require __DIR__ . '/../views/category/update.php';
    require __DIR__ . '/../views/layouts/admin_footer.php';
  }

  public function update(){
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    $this->categoryModel->update($id, $name, $description);
    set_flash('info', "Kategori Berhasil diubah");
    header("Location: /admin/category");
    exit();
  }
}