<?php
/** @var array $dataKategori */
?>

<div class="card">
    <div class="card-header">
        <h5>Ini adalah Halaman List Kategori</h5>
    </div>
    <div class="card-body">
        <a class="btn btn-primary" href="/admin/category/create">Tambah kategori</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataKategori as $kategori): ?>
                <tr>
                    <td><?= $kategori['id'] ?></td>
                    <td><?= $kategori['name'] ?></td>
                    <td><?= $kategori['description'] ?></td>
                    <td>
                        <a href="/admin/category/edit/<?= $kategori['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="/admin/category/delete/<?= $kategori['id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>