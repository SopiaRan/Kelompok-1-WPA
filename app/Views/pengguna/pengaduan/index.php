<?= $this->extend('pengguna/layout') ?>
<?= $this->section('content') ?>

<!-- ===== Flash Message ===== -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<!-- ===== Tombol Tambah Pengaduan ===== -->
<a href="#" class="btn btn-primary mb-3" onclick="openModal()">+ Tambah Pengaduan</a>

<!-- ===== Tabel Pengaduan ===== -->
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="datatables">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th style="width: 150px;">Tanggal Pengaduan</th>
                <th>Isi Pengaduan</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pengaduan)): ?>
                <tr>
                    <td colspan="8" class="text-muted">Tidak ada pengaduan.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($pengaduan as $i => $p): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($p['nim']) ?></td>
                        <td><?= esc($p['nama_lengkap']) ?></td>
                        <td>
                            <?php
                                $tanggal = date('d F Y', strtotime($p['tanggal_pengaduan']));
                                echo esc($tanggal);
                            ?>
                        </td>
                        <td><?= esc($p['isi_pengaduan']) ?></td>
                        <td>
                            <?php if (!empty($p['foto'])): ?>
                                <img src="/uploads/pengaduan/<?= esc($p['foto']) ?>" width="100" alt="Foto Pengaduan">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada foto</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge <?= $p['status'] == 'Selesai' ? 'bg-success' : 'bg-warning' ?>">
                                <?= esc($p['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="/pengguna/pengaduan/tanggapan/<?= $p['id'] ?>" class="btn btn-primary btn-sm">Lihat Tanggapan</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ===== Modal Form Tambah Pengaduan ===== -->
<div id="modalForm" class="modal-overlay">
    <div class="modal-box">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h5>Form Kirim Pengaduan</h5>
        <form action="/pengaduan/store" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" id="nim" class="form-control" value="<?= session()->get('nim') ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= session()->get('nama_lengkap') ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="tanggal_pengaduan" class="form-label">Tanggal Pengaduan</label>
                <input type="date" name="tanggal_pengaduan" id="tanggal_pengaduan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="isi_pengaduan" class="form-label">Isi Pengaduan</label>
                <textarea name="isi_pengaduan" id="isi_pengaduan" rows="4" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
        </form>
    </div>
</div>

<!-- ===== JS Modal dan Set Tanggal Hari Ini ===== -->
<script>
    function openModal() {
        document.getElementById('modalForm').style.display = 'flex';
        const today = new Date().toISOString().split('T')[0];
        const tanggalInput = document.getElementById('tanggal_pengaduan');
        tanggalInput.value = today;
        tanggalInput.setAttribute('min', today);
        tanggalInput.setAttribute('max', today);
    }

    function closeModal() {
        document.getElementById('modalForm').style.display = 'none';
    }
</script>

<?= $this->endSection() ?>
