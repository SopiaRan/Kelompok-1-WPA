<?= $this->extend('pengguna/layout') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Detail Pengaduan</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Nama Pengadu:</strong><br>
            <?= esc($pengaduan['nama_lengkap']) ?>
        </div>
        <div class="mb-3">
            <strong>NIM:</strong><br>
            <?= esc($pengaduan['nim']) ?>
        </div>
        <div class="mb-3">
            <strong>Tanggal Pengaduan:</strong><br>
            <?= date('d F Y', strtotime($pengaduan['tanggal_pengaduan'])) ?>
        </div>
        <div class="mb-3">
            <strong>Isi Pengaduan:</strong><br>
            <?= nl2br(esc($pengaduan['isi_pengaduan'])) ?>
        </div>
        <div class="mb-3">
            <strong>Foto:</strong><br>
            <?php if ($pengaduan['foto']): ?>
                <a href="/uploads/pengaduan/<?= esc($pengaduan['foto']) ?>" target="_blank">
                    <img src="/uploads/pengaduan/<?= esc($pengaduan['foto']) ?>" width="300" class="img-thumbnail mt-2">
                </a>
            <?php else: ?>
                <span class="text-muted">Tidak ada foto</span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <strong>Status:</strong><br>
            <span class="badge <?= $pengaduan['status'] === 'Selesai' ? 'bg-success' : 'bg-warning text-dark' ?>">
                <?= esc($pengaduan['status']) ?>
            </span>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Tanggapan Admin</h5>
    </div>
    <div class="card-body">
        <?php if ($tanggapan): ?>
            <div class="mb-3">
                <strong>Tanggapan:</strong><br>
                <?= nl2br(esc($tanggapan['tanggapan'])) ?>
            </div>
            <div class="mb-3">
                <strong>Tanggal Tanggapan:</strong><br>
                <?= date('d F Y', strtotime($tanggapan['tanggal_tanggapan'])) ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning mb-0">
                Belum ada tanggapan dari admin.
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="mt-4">
    <a href="/pengguna/pengaduan" class="btn btn-secondary">← Kembali ke Daftar Pengaduan</a>
</div>

<?= $this->endSection() ?>
