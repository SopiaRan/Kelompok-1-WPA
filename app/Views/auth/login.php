<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Sistem Pengaduan</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <style>
    body {
      background: linear-gradient(to right, #eef1f7, #f6f9ff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
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
      flex: 1 1 45%;
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
      flex: 1 1 55%;
      padding: 40px;
    }

    .form-control {
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

<div class="login-container">
  <div class="card-wrapper">
    <!-- Kiri: Gambar dan Sambutan -->
    <div class="card-left text-center">
      <img src="<?= base_url('assets/images/logo/gambar3.png') ?>" alt="Gambar Login">
      <h4>Selamat Datang</h4>
      <p class="mb-0">Masuk ke sistem pengaduan untuk melanjutkan</p>
    </div>

    <!-- Kanan: Formulir Login -->
    <div class="card-right">
      <h3 class="text-primary mb-2">Login</h3>
      <p class="text-muted mb-4">Masukkan informasi akun Anda</p>

      <!-- Flash Message -->
      <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>
      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>

      <form action="<?= site_url('auth/attemptLogin') ?>" method="post">
        <div class="mb-3">
          <label class="form-label">Nama Pengguna</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan nama pengguna" required>
        </div>

        <div class="mb-4">
          <label class="form-label">Kata Sandi</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>

      <p class="text-center mt-3">
        Belum punya akun? <a href="<?= site_url('auth/register') ?>" class="text-decoration-none text-primary">Daftar sekarang</a>
      </p>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
