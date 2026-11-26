<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/News.php';
require_once __DIR__ . '/../models/Category.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class HomeController extends Controller
{
    private $newsModel;
    private $categoryModel;

    public function __construct($pdo)
    {
        $this->newsModel = new News($pdo);
        $this->categoryModel = new Category($pdo);
    }

    public function index()
    {
        $this->viewPublic('/home/index', [
            'pageTitle' => 'Home',
            'news' => $this->newsModel->getAll(),
            'categories' => $this->categoryModel->getAll(),
            'activeCategoryId' => null
        ]);
    }
    public function category($id_category)
{
    $category = $this->categoryModel->getById($id_category);

    if (!$category) {
        http_response_code(404);
        echo "Kategori tidak ditemukan.";
        exit;
    }

    $this->viewPublic('/home/index', [
        'pageTitle' => 'Category: ' . $category['name'],
        'news' => $this->newsModel->getByCategory($id_category), 
        'categories' => $this->categoryModel->getAll(),
        'activeCategoryId' => $id_category
    ]);
}
public function news($slug){
    $newsItem = $this->newsModel->getBySlug($slug);
    if(!$newsItem){
        http_response_code(404);
        echo "Berita tidak ditemukan.";
        exit;
    }
    $this->viewPublic('/home/detail', [
        'pageTitle' => $newsItem['title'],
        'news' => $newsItem
    ]);
}
public function pdf($slug){
    $newsItem = $this->newsModel->getBySlug($slug);
    if(!$newsItem){
        http_response_code(404);
        echo "Berita tidak ditemukan.";
        exit;
    }

    ob_start();
    require_once __DIR__ . '/../views/home/pdf.php';
    $html = ob_get_clean();

    #set options
    $options = new Options();
    $options ->set('isHtml5ParserEnabled',true);
    $options->set('defaultFont','Arial');

    #set Dompdf
    $dompdf = new Dompdf($options);
    $dompdf ->loadHtml($html);
    $dompdf ->setPaper('A4','portrait');
    $dompdf ->render();
    
    #set filename dan Dwonload
    $filename = 'berita_'.$slug.'.pdf';
    $dompdf ->stream($filename, ['Attachment' => true]);
    exit;
    }
}