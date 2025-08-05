<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrasi | Sistem Informasi</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <style>
    body {
      background: linear-gradient(to right, #eef1f7, #f6f9ff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .register-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card-wrapper {
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      max-width: 900px;
      width: 100%;
      display: flex;
      flex-wrap: wrap;
    }
    .card-left {
      background: #0d6efd;
      color: #fff;
      padding: 40px;
      flex: 1 1 40%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .card-left img {
      max-width: 100%;
      height: 180px;
      margin-bottom: 20px;
    }
    .card-right {
      flex: 1 1 60%;
      padding: 40px;
    }
    .form-control,
    .form-select {
      border-radius: 10px;
    }
    .btn-primary {
      border-radius: 10px;
    }
    @media(max-width: 768px) {
      .card-left {
        display: none;
      }
      .card-right {
        flex: 1 1 100%;
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

<div class="register-container">
  <div class="card-wrapper">
    <!-- Kiri: Gambar dan Sambutan -->
    <div class="card-left text-center">
      <h4>Selamat Datang!</h4>
      <p class="mb-0">Silakan daftar di Sistem Pengaduan.</p>
    </div>

    <!-- Kanan: Formulir -->
    <div class="card-right">
      <h3 class="text-primary mb-2">Buat Akun</h3>
      <p class="text-muted mb-4">Isi data berikut untuk registrasi akun</p>

      <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>

      <form action="<?= site_url('auth/attemptRegister') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
        </div>

        <div class="mb-3">
          <label class="form-label">NIM</label>
          <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM Anda" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Masukkan Email Aktif" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Buat Password" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Foto Profil (opsional)</label>
          <input type="file" name="foto_profil" class="form-control">
        </div>

        <input type="hidden" name="role" value="pengguna">

        <button type="submit" class="btn btn-primary w-100">Daftar</button>
      </form>

      <p class="text-center mt-3">
        Sudah punya akun? <a href="<?= site_url('auth/login') ?>" class="text-decoration-none text-primary">Login di sini</a>
      </p>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
