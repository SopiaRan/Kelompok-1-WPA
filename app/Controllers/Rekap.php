<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rekap extends BaseController
{
    protected $pengaduanModel;

    public function __construct()
{
    helper(['form']); // <--- Tambahkan ini
    $this->pengaduanModel = new PengaduanModel();
}

   public function index()
    {
        return view('admin/rekap/index', [
            'pengaduan' => [],
            'tipe' => '',
            'judul' => '',
            'title' => 'Rekap Laporan Pengaduan'
        ]);
    }

public function filter()
{
    $tipe = $this->request->getPost('tipe');
    $data = [
        'tipe' => $tipe,
        'title' => 'Rekap Laporan Pengaduan'
    ];

    if ($tipe == 'harian') {
        $tanggal = $this->request->getPost('tanggal');
        $data['pengaduan'] = $this->pengaduanModel->getRekapHarian($tanggal);
        $data['judul'] = "Rekap Harian: $tanggal";
        $data['tanggal'] = $tanggal; // 👈 DITAMBAHKAN
    } elseif ($tipe == 'bulanan') {
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $data['pengaduan'] = $this->pengaduanModel->getRekapBulanan($bulan, $tahun);
        $data['judul'] = "Rekap Bulanan: $bulan-$tahun";
        $data['bulan'] = $bulan;   // 👈 DITAMBAHKAN
        $data['tahun'] = $tahun;   // 👈 DITAMBAHKAN
    }

    return view('admin/rekap/index', $data);
}


public function exportPdf()
{
    $tipe = $this->request->getGet('tipe');
    $data = ['tipe' => $tipe, 'title' => 'Rekap PDF'];

    if ($tipe == 'harian') {
        $tanggal = $this->request->getGet('tanggal');
        $data['pengaduan'] = $this->pengaduanModel->getRekapHarian($tanggal);
        $data['judul'] = "Rekap Harian: $tanggal";
    } elseif ($tipe == 'bulanan') {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $data['pengaduan'] = $this->pengaduanModel->getRekapBulanan($bulan, $tahun);
        $data['judul'] = "Rekap Bulanan: $bulan-$tahun";
    }

    $dompdf = new Dompdf();
    $html = view('admin/rekap/pdf', $data);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('rekap_pengaduan.pdf', ['Attachment' => 1]); // <-- download
}

public function exportExcel()
{
    $tipe = $this->request->getGet('tipe');
    $data = [];
    $judul = 'Rekap';

    if ($tipe == 'harian') {
        $tanggal = $this->request->getGet('tanggal');
        $data = $this->pengaduanModel->getRekapHarian($tanggal);
        $judul = "Rekap Harian - $tanggal";
    } elseif ($tipe == 'bulanan') {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $data = $this->pengaduanModel->getRekapBulanan($bulan, $tahun);
        $judul = "Rekap Bulanan - $bulan-$tahun";
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle("Data Pengaduan");

    // Header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'NIM');
    $sheet->setCellValue('C1', 'Nama Lengkap');
    $sheet->setCellValue('D1', 'Tanggal Pengaduan');
    $sheet->setCellValue('E1', 'Isi Pengaduan');
    $sheet->setCellValue('F1', 'Status');

    // Data
    $row = 2;
    $no = 1;
    foreach ($data as $d) {
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $d['nim']);
        $sheet->setCellValue('C' . $row, $d['nama_lengkap']);
        $sheet->setCellValue('D' . $row, $d['tanggal_pengaduan']);
        $sheet->setCellValue('E' . $row, $d['isi_pengaduan']);
        $sheet->setCellValue('F' . $row, $d['status']);
        $row++;
    }

    // Download
    $filename = 'rekap_pengaduan.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
public function rekapBulanan()
{
    $bulan = date('n'); // Bulan sekarang
    $tahun = date('Y'); // Tahun sekarang

    $data = [
        'tipe' => 'bulanan',
        'bulan' => $bulan,
        'tahun' => $tahun,
        'pengaduan' => $this->pengaduanModel->getRekapBulanan($bulan, $tahun),
        'judul' => "Rekap Bulanan: $bulan-$tahun",
        'title' => 'Rekap Bulanan'
    ];

    return view('admin/rekap/index', $data);
}
public function rekapHarian()
{
    $tanggal = date('Y-m-d');

    $data = [
        'tipe' => 'harian',
        'tanggal' => $tanggal,
        'pengaduan' => $this->pengaduanModel->getRekapHarian($tanggal),
        'judul' => "Rekap Harian: $tanggal",
        'title' => 'Rekap Harian'
    ];

    return view('admin/rekap/index', $data);
}

}
