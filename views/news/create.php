<?php
/** @var string $pageTitle */
/** @var array $categories */
?>
<div class="card">
    <div class="card-header">
        <h5><?= $pageTitle ?></h5>
    </div>
    <div class="card-body">
        <form action="/admin/news/store" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Content</label>
                <textarea name="content" id="" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="">Category</label>
                <select name="id_category" class="form-control" id="">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <input type="submit" value="Simpan" class="btn btn-primary">
        </form>
    </div>
</div>