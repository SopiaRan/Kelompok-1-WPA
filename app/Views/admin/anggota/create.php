<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="form-floating-card">
    <h5>Form Tambah Anggota</h5>
    <hr>
    <form action="/admin/anggota/store" method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Nama" class="form-label">Nama:</label>
                <input type="text" name="Nama" id="Nama" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Nim" class="form-label">NIM:</label>
                <input type="text" name="Nim" id="Nim" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Departemen" class="form-label">Departemen:</label>
                <select name="Departemen" id="Departemen" class="form-control" required>
                    <option value="">-- Pilih Departemen --</option>
                    <option value="BPHI">BPHI</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Sosial dan Agama">Sosial dan Agama</option>
                    <option value="Advokasi">Advokasi</option>
                    <option value="Kaderisasi">Kaderisasi</option>
                    <option value="Kominfo">Kominfo</option>
                    <option value="Minat dan Bakat">Minat dan Bakat</option>
                    <option value="PSDO">PSDO</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="Jabatan" class="form-label">Jabatan:</label>
                <select name="Jabatan" id="Jabatan" class="form-control" required>
                    <option value="">-- Pilih Jabatan --</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Wakil">Wakil</option>
                    <option value="Ketua Departemen">Ketua Departemen</option>
                    <option value="Sekretaris Departemen">Sekretaris Departemen</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>
