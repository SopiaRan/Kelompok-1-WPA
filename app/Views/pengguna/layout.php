<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
  <title><?= $title ?></title>

  <!-- ========== CSS Files ========= -->
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/lineicons.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/materialdesignicons.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/fullcalendar.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/pengaduanpengguna.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/pengaduantambah.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/riwayattanggapan.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/dashboard2.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/profil.css') ?>" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- ========== Tabler Icon ========= -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.28.1/tabler-icons.min.css" 
        integrity="sha512-UuL1Le1IzormILxFr3ki91VGuPYjsKQkRFUvSrEuwdVCvYt6a1X73cJ8sWb/1E726+rfDRexUn528XRdqrSAOw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <!-- ======== Preloader =========== -->
  <div id="preloader">
    <div class="spinner"></div>
  </div>

  <!-- ======== Sidebar =========== -->
  <aside class="sidebar-nav-wrapper">
     <div class="navbar-logo" style="text-align: center;">
    <a href="layout">
     <img style="width:30%;" src="<?= base_url('assets/images/logo/hima.png') ?>" alt="logo" />
    </a>
</div>
    <nav class="sidebar-nav">
      <ul>
        <li class="nav-item mb-2">
          <a href="<?= base_url('pengguna/dashboard') ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                 stroke-linecap="round" stroke-linejoin="round" 
                 class="icon icon-tabler icons-tabler-outline icon-tabler-home">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
              <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
              <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
            </svg>
            <span class="text">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('pengguna/pengaduan/create') ?>">
            <span class="icon">📄</span>
            <span class="text">Buat Pengaduan</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('pengguna/pengaduan') ?>">
            <span class="icon">📋</span>
            <span class="text">Pengaduan Mahasiswa</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url('pengguna/pengaduan/tanggapan') ?>">
            <span class="icon">💬</span>
            <span class="text">Tanggapan</span>
          </a>
        </li>
      </ul>
    </nav>
  </aside>

  <div class="overlay"></div>

  <!-- ======== Main Wrapper =========== -->
  <main class="main-wrapper">
    <!-- ========== Header ========== -->
    <header class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-6">
            <div class="header-left d-flex align-items-center">
              <div class="menu-toggle-btn mr-15">
                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                  <i class="lni lni-chevron-left me-2"></i> Menu
                </button>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-6">
            <div class="header-right">
              <!-- Profile -->
              <div class="profile-box ml-15">
                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                        data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="profile-info">
                    <div class="info">
                      <div class="image" style="width: 50px; height: 50px; overflow: hidden; border-radius: 50%;">
                      <?php
                        $foto = session()->get('foto_profil') ?: 'default.png';
                      ?>
                      <img src="<?= base_url('uploads/profil/' . $foto) ?>"
                          alt="Foto Profil"
                          style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                    </div>
                      <div>
                        <h6 class="fw-500"><?= esc(session()->get('username')) ?></h6>
                        <p class="text-xs mt-1 text-blue-600"><?= ucfirst(esc(session()->get('role'))) ?></p>
                      </div>
                    </div>
                  </div>
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                  <li>
                    <div class="author-info flex items-center gap-3 p-2">
                      <div class="content">
                        <h4 class="text-base font-semibold text-black mb-1">
                          <?= esc(session()->get('username')) ?>
                        </h4>
                        <a href="#" class="text-sm text-gray-500"><?= esc(session()->get('email')) ?></a>
                      </div>
                    </div>
                  </li>
                  <li class="divider my-1 border-t"></li>
                  <li><a href="<?= site_url('pengguna/profile') ?>" class="flex items-center gap-2 px-4 py-2 text-sm"></i> View Profile</a></li>
                  <li class="divider my-1 border-t"></li>
                  <li><a href="<?= base_url('auth/logout') ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600"><i class="lni lni-exit"></i> Keluar</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- ========== Content Section ========== -->
    <section class="section">
      <div class="container-fluid">
        <div class="title-wrapper pt-30">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="title">
                <h2><?= $title ?></h2>
              </div>
            </div>
          </div>
        </div>

        <!-- Content injected here -->
        <?= $this->renderSection('content') ?>
      </div>
    </section>

    <!-- ========== Footer ========== -->
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 order-last order-md-first">
            <div class="copyright text-center text-md-start">
              &copy; <?= date('Y') ?> .
            </div>
          </div>
          </div>
        </div>
      </div>
    </footer>
  </main>

  <!-- ========== Scripts ========== -->
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/fullcalendar.js') ?>"></script>
  <script src="<?= base_url('assets/js/jvectormap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/world-merc.js') ?>"></script>
  <script src="<?= base_url('assets/js/polyfill.js') ?>"></script>
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
