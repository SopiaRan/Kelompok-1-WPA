<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>


<a href="/admin/akun_pengguna/create/" class="btn btn-primary mb-3" style="font-weight: bold;">
    + Tambah Akun
</a>
    <input type="text" id="searchInput" placeholder="🔍 Cari Nama / NIM / Username..." style="margin-bottom: 15px; padding: 8px; width: 280px;">
        <table id="akunTable" class="table table-bordered align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal Registrasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pengguna)) : ?>
                    <tr>
                        <td colspan="8" class="text-muted">Tidak ada data akun yang tersedia.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($pengguna as $i => $user) : ?>
                        <tr style="background-color: <?= $i % 2 == 0 ? '#ffffff' : '#f9f9f9' ?>;">
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($user['username']) ?></td>
                            <td><?= esc($user['nama_lengkap']) ?: '-' ?></td>
                            <td><?= esc($user['nim']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><?= esc(ucfirst($user['role'])) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($user['created_at'])) ?></td>
                            <td>
                                <a href="/admin/akun_pengguna/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll("#akunTable tbody tr").forEach(row => {
            const nama = row.cells[2].textContent.toLowerCase();
            const nim = row.cells[3].textContent.toLowerCase();
            const username = row.cells[1].textContent.toLowerCase();
            row.style.display = nama.includes(keyword) || nim.includes(keyword) || username.includes(keyword) ? "" : "none";
        });
    });
</script>



<?= $this->endSection() ?>
