<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h2><?= esc($title) ?></h2>

<form action="/admin/akun_pengguna/store" method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Nama Lengkap:</label><br>
    <input type="text" name="nama_lengkap"><br><br>

    <label>NIM:</label><br>
    <input type="text" name="nim" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Role:</label><br>
    <select name="role" required>
        <option value="pengguna">Pengguna</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>
