<?= $this->extend('admin/layout') ?>
<link rel="stylesheet" href="<?= base_url('css/anggota.css') ?>">
<?= $this->section('content') ?>

<div class="anggota-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="anggota/create" class="btn btn-primary">+ Tambah Anggota</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash-message">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash-message">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Search Input -->
    <input type="text" id="searchInput" placeholder="Cari Nama / NIM / Departemen..." class="form-control mb-3" style="max-width: 300px;">

    <!-- Tabel Anggota -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="anggotaTable">
            <thead class="table-primary">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anggota as $index => $a): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= esc($a['Nama']) ?></td>
                        <td><?= esc($a['Nim']) ?></td>
                        <td><?= esc($a['Departemen']) ?></td>
                        <td><?= esc($a['Jabatan']) ?></td>
                        <td class="text-center">
                            <a href="anggota/edit/<?= $a['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="anggota/delete/<?= $a['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script Pencarian -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll("#anggotaTable tbody tr");

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? "" : "none";
        });
    });
</script>


<?= $this->endSection() ?>
