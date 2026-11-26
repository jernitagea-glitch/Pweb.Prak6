<?php
/** @var array $category */
?>
<div class="card">
    <div class="card-header">
        <h5>UBAH Kategori</h5>
    </div>
    <div class="card-body">
        <!-- FORM UBAH -->
        <form action="/admin/category/update" method="POST">
            <input type="hidden" name="id" value="<?=$category['id'] ?>">
            <div class="mb-3">
                <label for="">Nama Kategori</label>
                <input type="text" value="<?=$category['name'] ?>" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Deskripsi Kategori</label>
                <textarea name="description" id="" class="form-control"><?=$category['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <a href="/admin/category" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>