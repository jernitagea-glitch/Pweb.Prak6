<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Login Admin') ?> - Portal Blog</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

    <div class="container" style="max-width: 420px;">

        <div class="text-center mb-4">
            <h1 class="h3 fw-bold text-dark">
                <i class="fa-solid fa-lock text-primary me-2"></i>Panel Admin
            </h1>
            <p class="text-muted small">Praktikum Web Blog - PWEB UKRIM</p>
        </div>

        <?php 
    $flash = get_flash(); 
    if ($flash): 
    ?>
        <div class="alert alert-<?= $flash['type'] === 'danger' ? 'danger' : 'success' ?> alert-dismissible fade show"
            role="alert">
            <i
                class="fa-solid <?= $flash['type'] === 'danger' ? 'fa-triangle-exclamation' : 'fa-circle-check' ?> me-2"></i>
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body p-4">
                <form action="<?= url('admin/auth/login') ?>" method="POST">

                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-user"></i></span>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Masukkan username" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-key"></i></span>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk ke Dashboard
                    </button>
                </form>

            </div>
        </div>

        <div class="text-center">
            <a href="<?= url() ?>" class="text-decoration-none text-muted small">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Halaman Utama
            </a>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>