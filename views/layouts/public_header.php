<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Portal Berita') ?> - PWEB UKRIM</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar Publik -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="<?= url() ?>">
                <span>PWEB UKRIM</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="publicNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-medium" href="<?= url() ?>">
                            <i class="fa-solid fa-house me-1"></i> Beranda
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary btn-sm" href="<?= url('admin/category') ?>">
                            <i class="fa-solid fa-gauge-high me-1"></i> Dashboard Admin
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="<?= url('admin/auth/login') ?>">
                            <i class="fa-solid fa-lock me-1"></i> Login Admin
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4 flex-grow-1">