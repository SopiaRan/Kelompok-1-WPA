<?= $this->extend('pengguna/layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p><strong>NIM:</strong> <?= esc($pengaduan['nim']) ?></p>
            </div>
            <div class="mb-3">
                <p><strong>Tanggal Pengaduan:</strong> <?= esc($pengaduan['tanggal_pengaduan']) ?></p>
            </div>
            <div class="mb-3">
                <p><strong>Isi Pengaduan:</strong> <?= esc($pengaduan['isi_pengaduan']) ?></p>
            </div>

            <?php if ($pengaduan['foto']): ?>
                <div class="mb-3">
                    <p><strong>Foto:</strong></p>
                    <img src="/uploads/pengaduan/<?= esc($pengaduan['foto']) ?>" class="img-fluid" width="300" alt="Foto Pengaduan">
                </div>
            <?php endif; ?>

            <hr>

            <div class="mt-4">
                <h3>Tanggapan Admin:</h3>
                <?php if ($tanggapan): ?>
                    <p><?= esc($tanggapan['tanggapan']) ?></p>
                    <p><em>Diberikan pada: <?= esc($tanggapan['tanggal_tanggapan']) ?></em></p>
                <?php else: ?>
                    <p><em>Belum ada tanggapan untuk pengaduan ini.</em></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <a href="/pengguna/pengaduan" class="btn btn-primary mt-3 mb-4">Kembali</a>
</div>

<?= $this->endSection() ?>
