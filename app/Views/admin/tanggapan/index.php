<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>


<div class="container-fluid px-4">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>

    <div class="card card-custom mt-4">
        <div class="card-body">
            <h5 class="mb-4">Data Pengaduan yang telah Ditanggapi</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center" id="datatables">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengadu</th>
                            <th>NIM</th>
                            <th>Tanggal Pengaduan</th>
                            <th>Isi Pengaduan</th>
                            <th>Tanggapan</th>
                            <th>Tanggal Tanggapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($tanggapan)): ?>
                            <tr>
                                <td colspan="7" class="text-muted text-center">Belum ada data tanggapan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($tanggapan as $i => $t): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($t['nama_lengkap']) ?></td>
                                    <td><?= esc($t['nim']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($t['tanggal_pengaduan'])) ?></td>
                                    <td><?= esc($t['isi_pengaduan']) ?></td>
                                    <td><?= esc($t['tanggapan']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($t['tanggal_tanggapan'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
