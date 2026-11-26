<div class="row justify-content-center my-3">
    <div class="col-lg-9 col-md-11">

        <div class="mb-3">
            <a href="<?= url() ?>" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Beranda
            </a>
            <a href="<?= url('pdf/'.$news['slug']) ?>" target="_blank" class=" btn btn-danger btn-sm">
                <i class="fa-solid fa-file me-1"></i>Download PDF
            </a>
        </div>

        <article class="card shadow-sm border-0 p-4 p-md-5">
            <header class="text-center mb-4 pb-3 border-bottom">
                <a href="<?= url('category/' . $news['id_category']) ?>"
                    class="badge bg-primary-subtle text-primary border border-primary-subtle text-decoration-none fs-6 mb-2">
                    <?= htmlspecialchars($news['category_name']) ?>
                </a>

                <h1 class="display-6 fw-bold text-dark my-2">
                    <?= htmlspecialchars($news['title']) ?>
                </h1>

                <div class="d-flex gap-3 justify-content-center text-muted small mt-2">
                    <span><i class="fa-solid fa-user-pen me-1"></i> Ditulis oleh
                        <strong><?= htmlspecialchars($news['user_name'] ?? 'Admin') ?></strong></span>
                    <span>·</span>
                    <span><i class="fa-regular fa-calendar-days me-1"></i>
                        <?= date('d F Y', strtotime($news['created_at'])) ?>|
                        <?= ucwords(waktuLalu($news['created_at'])) ?>
                    </span>
                </div>

            </header>

            <?php if (!empty($news['image']) && file_exists(__DIR__ . '/../../uploads/' . $news['image'])): ?>
            <div class="text-center mb-4">
                <img src="<?= url('uploads/' . $news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>"
                    class="img-fluid rounded shadow-sm" style="max-height: 440px; width: 100%; object-fit: cover;">
            </div>
            <?php endif; ?>

            <div class="article-content fs-5 lh-lg text-secondary mb-4" style="white-space: pre-line;">
                <?= nl2br(htmlspecialchars($news['content'])) ?>
            </div>

            <div class="pt-4 border-top d-flex justify-content-between align-items-center">
                <a href="<?= url() ?>" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Baca Berita Lainnya
                </a>

                <?php if (isset($_SESSION['user'])): ?>
                <a href="<?= url('admin/news/edit/' . $news['id']) ?>" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit Artikel Ini (Admin)
                </a>
                <?php endif; ?>
            </div>

        </article>

    </div>
</div>