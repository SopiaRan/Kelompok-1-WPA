<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
    $today = date('Y-m-d'); // tanggal hari ini
?>

<div class="tanggapan-container">
    <div class="tanggapan-card">
        <h4>Form Tanggapan Pengaduan</h4>

        <form action="/admin/pengaduan/tanggapi/<?= esc($pengaduan['id']) ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap:</label>
                <div class="form-control-plaintext"><?= esc($pengaduan['nama_lengkap']) ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">NIM:</label>
                <div class="form-control-plaintext"><?= esc($pengaduan['nim']) ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Pengaduan:</label>
                <div class="form-control-plaintext"><?= esc($pengaduan['isi_pengaduan']) ?></div>
            </div>

            <div class="mb-3">
                <label for="tanggapan" class="form-label">Tanggapan:</label>
                <textarea name="tanggapan" id="tanggapan" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label for="tanggal_tanggapan" class="form-label">Tanggal Tanggapan:</label>
                <input type="date" name="tanggal_tanggapan" id="tanggal_tanggapan"
                       class="form-control" required
                       value="<?= $today ?>"
                       min="<?= $today ?>" max="<?= $today ?>">
            </div>

            <div class="btn-group">
                <a href="<?= base_url('admin/pengaduan') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
