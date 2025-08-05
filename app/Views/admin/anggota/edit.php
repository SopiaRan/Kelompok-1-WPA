<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5>Form Edit Anggota</h5>
    </div>
    <div class="card-body">
<form action="/admin/anggota/update/<?= $anggota['id'] ?>" method="POST">
    <?= csrf_field() ?>
    <div class="form-group">
        <label for="Nama">Nama</label>
        <input type="text" name="Nama" class="form-control" value="<?= esc($anggota['Nama']) ?>" required>
    </div>
    <div class="form-group">
        <label for="Nim">NIM</label>
        <input type="text" name="Nim" class="form-control" value="<?= esc($anggota['Nim']) ?>" required>
    </div>
    <div class="form-group">
        <label for="Departemen">Departemen</label>
        <input type="text" name="Departemen" class="form-control" value="<?= esc($anggota['Departemen']) ?>" required>
    </div>
    <div class="form-group">
        <label for="Jabatan">Jabatan</label>
        <input type="text" name="Jabatan" class="form-control" value="<?= esc($anggota['Jabatan']) ?>" required>
    </div>

   <button type="submit" class="btn btn-primary">💾 Update Anggota</button>
        <a href="<?= base_url('admin/anggota') ?>" class="btn btn-secondary">↩️ Kembali</a>
</form>
</div>

<?= $this->endSection() ?>
