<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h2>Rekap Harian Pengaduan</h2>

<form action="<?= base_url('admin/rekap/harian') ?>" method="get">
    <label for="tanggal">Pilih Tanggal:</label>
    <input type="date" name="tanggal" id="tanggal" value="<?= esc($_GET['tanggal'] ?? '') ?>" required>
    <button type="submit">Tampilkan</button>
</form>

<?php if (!empty($pengaduan)) : ?>
    <table border="1" cellpadding="5" cellspacing="0" style="margin-top:20px;">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Pengaduan</th>
                <th>Isi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengaduan as $i => $p): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($p['nim']) ?></td>
                    <td><?= esc($p['nama_lengkap']) ?></td>
                    <td><?= esc($p['tanggal_pengaduan']) ?></td>
                    <td><?= esc($p['isi_pengaduan']) ?></td>
                    <td><?= esc($p['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif (isset($_GET['tanggal'])): ?>
    <p>Tidak ada data pengaduan pada tanggal tersebut.</p>
<?php endif; ?>
