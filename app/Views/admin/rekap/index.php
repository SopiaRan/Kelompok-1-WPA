<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
        <h4>📊 Rekap Pengaduan Mahasiswa</h4>
        <div>
            <a href="<?= base_url('admin/rekap/harian') ?>" class="btn btn-sm btn-outline-secondary">📅 Rekap Harian Hari Ini</a>
            <a href="<?= base_url('admin/rekap/bulanan') ?>" class="btn btn-sm btn-outline-primary">📆 Rekap Bulanan Sekarang</a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="filter-box">
        <form method="post" action="<?= base_url('admin/rekap/filter') ?>" class="row g-3">
            <div class="col-md-3">
                <label for="tipe" class="form-label">Jenis Rekap:</label>
                <select name="tipe" id="tipe" class="form-select" onchange="toggleFilter()" required>
                    <option value="">-- Pilih --</option>
                    <option value="harian" <?= $tipe == 'harian' ? 'selected' : '' ?>>Harian</option>
                    <option value="bulanan" <?= $tipe == 'bulanan' ? 'selected' : '' ?>>Bulanan</option>
                </select>
            </div>

            <div class="col-md-3" id="form-harian" style="display: <?= $tipe == 'harian' ? 'block' : 'none' ?>;">
                <label for="tanggal" class="form-label">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="<?= esc($tanggal ?? '') ?>">
            </div>

            <div class="col-md-6 row" id="form-bulanan" style="display: <?= $tipe == 'bulanan' ? 'flex' : 'none' ?>;">
                <div class="col">
                    <label for="bulan" class="form-label">Bulan:</label>
                    <select name="bulan" class="form-select">
                        <?php for ($b = 1; $b <= 12; $b++): ?>
                            <option value="<?= $b ?>" <?= isset($bulan) && $bulan == $b ? 'selected' : '' ?>>
                                <?= DateTime::createFromFormat('!m', $b)->format('F') ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="tahun" class="form-label">Tahun:</label>
                    <input type="number" name="tahun" class="form-control" value="<?= esc($tahun ?? date('Y')) ?>">
                </div>
            </div>

            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-success">🔍 Tampilkan</button>
            </div>
        </form>
    </div>

    <!-- Tabel Rekap -->
    <?php if (isset($pengaduan)): ?>
        <div class="rekap-card card mt-4">
            <div class="card-body">
                <h5><?= esc($judul) ?></h5>

                <?php if (count($pengaduan) > 0): ?>
                    <div class="export-links mb-3">
                        <a href="<?= base_url('admin/rekap/pdf?' . http_build_query([
                            'tipe' => $tipe,
                            'tanggal' => $tanggal ?? '',
                            'bulan' => $bulan ?? '',
                            'tahun' => $tahun ?? ''
                        ])) ?>" class="btn btn-outline-danger btn-sm" target="_blank">📄 Export PDF</a>

                        <a href="<?= base_url('admin/rekap/excel?' . http_build_query([
                            'tipe' => $tipe,
                            'tanggal' => $tanggal ?? '',
                            'bulan' => $bulan ?? '',
                            'tahun' => $tahun ?? ''
                        ])) ?>" class="btn btn-outline-success btn-sm" target="_blank">📊 Export Excel</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal Pengaduan</th>
                                    <th>Isi Pengaduan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengaduan as $i => $p): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($p['nim']) ?></td>
                                        <td><?= esc($p['nama_lengkap']) ?></td>
                                        <td><?= date('d-m-Y', strtotime($p['tanggal_pengaduan'])) ?></td>
                                        <td><?= esc($p['isi_pengaduan']) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $p['status'] === 'Ditanggapi' ? 'success' : 'danger' ?>">
                                                <?= esc($p['status']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted mt-3"><em>Tidak ada data pengaduan untuk <?= esc($judul) ?>.</em></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    function toggleFilter() {
        const tipe = document.getElementById('tipe').value;
        document.getElementById('form-harian').style.display = tipe === 'harian' ? 'block' : 'none';
        document.getElementById('form-bulanan').style.display = tipe === 'bulanan' ? 'flex' : 'none';
    }

    window.onload = toggleFilter;
</script>

<?= $this->endSection() ?>
