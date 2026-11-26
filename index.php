<?php
session_start();
require_once __DIR__ . '/config/database.php';
date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . '/vendor/autoload.php';

use Carbon\Carbon;

carbon::setLocale('id');

// Helper URL & Flash Message
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$basePath  = ($scriptDir === '/' || $scriptDir === '\\') ? '' : rtrim(str_replace('\\', '/', $scriptDir), '/');
define('BASE_URL', $basePath);

function url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

function set_flash($type, $message) {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}
 // fungsi ini untuk menampilkan waktu lalu cth: 1 bulan yg lalu
function waktuLalu($datetime)
{
   if (empty($datetime)){
    return "-";
   } 
   return Carbon::parse($datetime,'Asia/Jakarta')->diffForHumans();
}

// Parsing URL
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (BASE_URL !== '' && strpos($requestUri, BASE_URL) === 0) {
    $requestUri = substr($requestUri, strlen(BASE_URL));
}
$cleanPath = trim($requestUri, '/');
$segments  = $cleanPath === '' ? [] : explode('/', $cleanPath);

$isAdmin = isset($segments[0]) && $segments[0] === 'admin';

if ($isAdmin) {
    $controllerName = $segments[1] ?? 'kategori';
    $actionName     = $segments[2] ?? 'index';
    $paramId        = $segments[3] ?? null;

    if (!isset($_SESSION['user']) && $controllerName !== 'auth') {
    set_flash('danger', 'Anda harus login terlebih dahulu.');
    header('Location: ' . url('admin/auth/login'));
    exit;
}

} else {
    $controllerName = 'home';
    $actionName     = $segments[0] ?? 'index';
    $paramId        = $segments[1] ?? null;

    if ($actionName === '') {
        $actionName = 'index';
    }
}

$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile  = __DIR__ . '/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerClass($pdo);
    if (method_exists($controller, $actionName)) {
        $controller->$actionName($paramId);
    } else {
        die("Method $actionName tidak ditemukan!");
    }
} else {
    die("Controller $controllerClass tidak ditemukan!");
}