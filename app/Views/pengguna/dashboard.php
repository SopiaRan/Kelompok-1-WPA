<?= $this->extend('pengguna/layout') ?>
<?= $this->section('content') ?>


<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <h1>Halo, <?= esc(session()->get('nama_lengkap')) ?>! 👋</h1>
        <p>Selamat datang di sistem pengaduan. Berikut ringkasan aktivitas kamu:</p>
    </div>

    <div class="card-grid">
        <div class="dashboard-card">
            <i class="fas fa-file-alt"></i>
            <h4>Total Pengaduan</h4>
            <p><?= esc($jumlahPengaduan ?? 0) ?></p>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-hourglass-half"></i>
            <h4>Dalam Proses</h4>
            <p><?= esc($jumlahProses) ?></p>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-check-circle"></i>
            <h4>Selesai</h4>
            <p><?= esc($jumlahSelesai) ?></p>
        </div>
    </div>

    <div class="quick-action">
        <a href="<?= base_url('pengaduan/create') ?>"><i class="fas fa-plus-circle me-1"></i> Buat Pengaduan Baru</a>
    </div>
</div>

<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?= $this->endSection() ?>
