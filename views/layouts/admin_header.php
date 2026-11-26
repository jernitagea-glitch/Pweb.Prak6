<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin Panel') ?> - Portal Blog</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= url('admin/category') ?>">
                <i class="fa-solid fa-gauge-high text-primary me-1"></i> Dashboard Admin
            </a>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('admin/category') ?>"><i class="fa-solid fa-tags me-1"></i>
                        category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('admin/news') ?>"><i class="fa-solid fa-newspaper me-1"></i>
                        news</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('admin/auth/logout') ?>"><i
                            class="fa-solid fa-sign-out-alt me-1"></i> Logout</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= url() ?>" target="_blank"><i class="fa-solid fa-globe me-1"></i> Lihat
                        Web</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container my-4 flex-grow-1">
        <?php $flash = get_flash(); if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>