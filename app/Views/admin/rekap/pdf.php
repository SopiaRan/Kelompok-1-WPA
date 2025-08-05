<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= esc($judul) ?></title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2><?= esc($judul) ?></h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Pengaduan</th>
                <th>Isi Pengaduan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengaduan as $i => $p): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($p['nim']) ?></td>
                    <td><?= esc($p['nama_lengkap']) ?></td>
                    <td><?= esc($p['tanggal_pengaduan']) ?></td>
                    <td><?= esc($p['isi_pengaduan']) ?></td>
                    <td><?= esc($p['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
