<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="table-wrapper">
    <h4 class="mb-4">Data Pengaduan Mahasiswa</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle" id="pengaduanTable">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NIM</th>
                    <th>Tanggal Pengaduan</th>
                    <th>Isi Pengaduan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pengaduan)): ?>
                    <tr>
                        <td colspan="9" class="text-muted">Belum ada data pengaduan.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pengaduan as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($p['nama_lengkap']) ?></td>
                            <td><?= esc($p['nim']) ?></td>
                            <td><?= date('d-m-Y', strtotime($p['tanggal_pengaduan'])) ?></td>
                            <td><?= esc($p['isi_pengaduan']) ?></td>
                            <td>
                                <?php if (!empty($p['foto'])): ?>
                                    <img src="/uploads/pengaduan/<?= esc($p['foto']) ?>" class="img-thumbnail">
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada foto</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status-badge <?= $p['status'] === 'Ditanggapi' ? 'status-ditanggapi' : 'status-terkirim' ?>">
                                    <?= esc($p['status']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($p['status'] === 'Ditanggapi'): ?>
                                    <button class="btn btn-secondary btn-sm" disabled>Sudah Ditanggapi</button>
                                <?php else: ?>
                                    <a href="/admin/pengaduan/tanggapi/<?= $p['id'] ?>" class="btn btn-primary btn-sm">Tanggapi</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/admin/pengaduan/detail/<?= $p['id'] ?>" class="btn btn-info btn-sm">Lihat</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables (search only) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#pengaduanTable').DataTable({
            paging: false,
            info: false
        });
    });
</script>

<?= $this->endSection() ?>
