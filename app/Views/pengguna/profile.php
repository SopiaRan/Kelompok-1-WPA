<?= $this->extend('pengguna/layout') ?>
<?= $this->section('content') ?>

        <div class="container profile-container">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <div class="profile-card">
                <div class="text-center d-flex flex-column align-items-center">
            <!-- Avatar -->
            <img src="<?= base_url('uploads/profil/' . (session()->get('foto_profil') ?? 'default.png')) ?>" class="profile-avatar mb-2">

            <!-- Form Upload -->
            <form action="<?= site_url('pengguna/updateFoto') ?>" method="post" enctype="multipart/form-data" class="form-upload mt-2">
                <input type="file" name="foto_profil" class="form-control mb-2" required style="max-width: 250px;">
                <button type="submit" class="btn btn-primary btn-sm">Ubah Foto</button>
            </form>
        </div>

        <hr class="my-4">

        <!-- Detail Profil -->
        <div class="profile-row">
            <div class="profile-label">Nama Lengkap</div>
            <div class="profile-value"><?= esc(session()->get('nama_lengkap')) ?></div>
        </div>

        <div class="profile-row">
            <div class="profile-label">NIM</div>
            <div class="profile-value"><?= esc(session()->get('nim')) ?></div>
        </div>

        <div class="profile-row">
            <div class="profile-label">Username</div>
            <div class="profile-value"><?= esc(session()->get('username')) ?></div>
        </div>

        <div class="profile-row">
            <div class="profile-label">Email</div>
            <div class="profile-value"><?= esc(session()->get('email')) ?></div>
        </div>

        <div class="profile-row">
            <div class="profile-label">Role</div>
            <div class="profile-value"><span class="badge bg-info text-dark"><?= esc(session()->get('role')) ?></span></div>
        </div>

        <a href="<?= site_url('pengguna/dashboard') ?>" class="btn btn-outline-secondary back-btn">← Kembali ke Dashboard</a>
    </div>
</div>

<?= $this->endSection() ?>
