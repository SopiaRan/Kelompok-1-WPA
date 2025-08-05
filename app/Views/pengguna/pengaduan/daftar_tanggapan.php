<?= $this->extend('pengguna/layout'); ?>
<?= $this->section('content'); ?>

<div class="container pengaduan-container">
    <h4 class="mb-4 text-primary">Riwayat Pengaduan</h4>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengaduan</th>
                <th>Isi Pengaduan</th>
                <th>Tanggapan Admin</th>
                <th>Tanggal Tanggapan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($list)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada Tanggapan untuk pengaduan.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach ($list as $item): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= esc($item['pengaduan']['tanggal_pengaduan']) ?></td>
                        <td><?= esc($item['pengaduan']['isi_pengaduan']) ?></td>
                        <td>
                            <?php if ($item['tanggapan']): ?>
                                <?= esc($item['tanggapan']['tanggapan']) ?>
                            <?php else: ?>
                                <em class="text-muted">Belum ditanggapi</em>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <?= $item['tanggapan'] ? esc(date('Y-m-d', strtotime($item['tanggapan']['tanggal_tanggapan']))) : '-' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>
