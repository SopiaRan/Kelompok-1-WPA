<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>


<!-- Konten Dashboard -->
<div class="dashboard-admin">
    <div class="row gy-4">
        <div class="col-xl-4 col-md-6">
            <div class="stat-card">
                <div class="stat-icon bg-purple">
                    <i class="lni lni-user"></i>
                </div>
                <div class="stat-info">
                    <h6>Total Pengurus</h6>
                    <h3><?= esc($totalAnggota) ?></h3>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="stat-card">
                <div class="stat-icon bg-blue">
                    <i class="lni lni-warning"></i>
                </div>
                <div class="stat-info">
                    <h6>Total Pengaduan</h6>
                    <h3><?= esc($totalPengaduan) ?></h3>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="lni lni-comments"></i>
                </div>
                <div class="stat-info">
                    <h6>Total Tanggapan</h6>
                    <h3><?= esc($totalTanggapan) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Pengaduan Terbaru -->
<div class="section-title">Pengaduan Terbaru</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover border-primary">
        <thead class="table-primary text-dark">
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Tanggal</th>
                <th>Isi Pengaduan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pengaduanTerbaru)): ?>
                <?php $no = 1; foreach ($pengaduanTerbaru as $pd): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($pd['nama_lengkap']) ?></td>
                        <td><?= esc(date('Y-m-d', strtotime($pd['tanggal_pengaduan']))) ?></td>
                        <td><?= esc($pd['isi_pengaduan']) ?></td>
                        <td>
                            <?php
                                $status = strtolower($pd['status']);
                                $badgeColor = 'secondary';
                                if ($status === 'terkirim') {
                                    $badgeColor = 'warning'; // oranye
                                } elseif ($status === 'ditanggapi') {
                                    $badgeColor = 'success'; // hijau
                                }
                            ?>
                            <span class="badge bg-<?= $badgeColor ?>">
                                <?= ucfirst($status) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center text-muted">Belum ada pengaduan terbaru.</td></tr>
            <?php endif ?>
        </tbody>
    </table>
</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikStatistik').getContext('2d');
    const grafikStatistik = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($bulanChart) ?>,
            datasets: [
                {
                    label: 'Pengaduan',
                    data: <?= json_encode($jumlahPengaduanPerBulan) ?>,
                    backgroundColor: '#007bff'
                },
                {
                    label: 'Tanggapan',
                    data: <?= json_encode($jumlahTanggapanPerBulan) ?>,
                    backgroundColor: '#28a745'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: {
                    display: true,
                    text: 'Grafik Pengaduan dan Tanggapan Per Bulan'
                }
            }
        }
    });
</script>

<?= $this->endSection() ?>
