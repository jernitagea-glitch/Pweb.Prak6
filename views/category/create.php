<div class="card">
    <div class="card-header">
        <h5>Tambah Kategori</h5>
    </div>
    <div class="card-body">
        <!-- FORM TAMBAH -->
        <form action="/admin/category/store" method="POST">
            <div class="mb-3">
                <label for="">Nama Kategori</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Deskripsi Kategori</label>
                <textarea name="description" id="" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <a href="/admin/category" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>