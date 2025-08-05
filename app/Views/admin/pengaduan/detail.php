<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="detail-container">
    <div class="detail-card">
        <div class="detail-item">
            <span class="detail-label">Nama Lengkap:</span>
            <?= esc($pengaduan['nama_lengkap']) ?>
        </div>

        <div class="detail-item">
            <span class="detail-label">NIM:</span>
            <?= esc($pengaduan['nim']) ?>
        </div>

        <div class="detail-item">
            <span class="detail-label">Tanggal Pengaduan:</span>
            <?= date('d-m-Y', strtotime($pengaduan['tanggal_pengaduan'])) ?>
        </div>

        <div class="detail-item">
            <span class="detail-label">Isi Pengaduan:</span>
            <?= nl2br(esc($pengaduan['isi_pengaduan'])) ?>
        </div>

        <div class="detail-item">
            <span class="detail-label">Status:</span>
            <span class="status-badge <?= $pengaduan['status'] === 'Ditanggapi' ? 'status-ditanggapi' : 'status-terkirim' ?>">
                <?= esc($pengaduan['status']) ?>
            </span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Foto:</span>
            <?php if ($pengaduan['foto']): ?>
                <a href="/uploads/pengaduan/<?= esc($pengaduan['foto']) ?>" target="_blank">
                    <img src="/uploads/pengaduan/<?= esc($pengaduan['foto']) ?>" class="img-preview">
                </a>
            <?php else: ?>
                <span class="text-muted">Tidak ada foto</span>
            <?php endif; ?>
        </div>

        <a href="/admin/pengaduan" class="btn btn-secondary btn-back">← Kembali ke Daftar</a>
    </div>
</div>

<?= $this->endSection() ?>
