<?= $this->extend('pengguna/layout') ?>
<?= $this->section('content') ?>

<div class="text-center my-5">
    <button type="button" class="btn btn-primary btn-lg animated-button" 
            data-bs-toggle="modal" data-bs-target="#modalPengaduan">
        <i class="bi bi-megaphone-fill me-2"></i> Kirim Pengaduan
    </button>
    <p class="text-muted mt-2">Sampaikan keluhan, saran, atau masalah Anda dengan mudah</p>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="modalPengaduan" tabindex="-1" aria-labelledby="modalPengaduanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <!-- Header Modal -->
<div class="modal-header justify-content-center position-relative">
    <h5 class="modal-title fw-bold text-primary d-flex align-items-center" id="modalPengaduanLabel">
        📝 Kirim Pengaduan
    </h5>
    <!-- Tombol close tetap di kanan atas -->
    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Tutup"></button>
</div>


      <!-- Body Modal -->
      <div class="modal-body">
        <form action="/pengaduan/store" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" id="nim" class="form-control" 
                       value="<?= session()->get('nim') ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" 
                       value="<?= session()->get('nama_lengkap') ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="tanggal_pengaduan" class="form-label">Tanggal Pengaduan</label>
                <?php
                    $hariIni = date('Y-m-d');
                    $hariIniFormat = date('d-m-Y');
                ?>
                <input type="text" class="form-control" value="<?= $hariIniFormat ?>" readonly>
                <input type="hidden" name="tanggal_pengaduan" value="<?= $hariIni ?>">
            </div>
            <div class="mb-3">
                <label for="isi_pengaduan" class="form-label">Isi Pengaduan</label>
                <textarea name="isi_pengaduan" id="isi_pengaduan" rows="5" class="form-control" required><?= old('isi_pengaduan') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
