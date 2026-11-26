<?php
/** @var string $pageTitle */
/** @var array $categories */
/** @var array $news */
?>

<div class="card">
    <div class="card-header">
        <h5><?= $pageTitle ?></h5>
    </div>

    <div class="card-body">
        <form action="/admin/news/update" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $news['id'] ?>">

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($news['title']) ?>"
                    required>
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control"><?= htmlspecialchars($news['content']) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="id_category" class="form-control" required>
                    <option value="" disabled>Pilih Kategori</option>

                    <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?= $news['id_category'] == $category['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">

                <?php if (!empty($news['image'])): ?>
                <p class="mt-2">Gambar saat ini:</p>
                <img src="/uploads/<?= htmlspecialchars($news['image']) ?>" width="150">
                <?php endif; ?>
            </div>

            <input type="submit" value="Simpan Perubahan" class="btn btn-primary">

        </form>
    </div>
</div>