<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\TanggapanModel;

class Pengaduan extends BaseController
{
    protected $pengaduanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
    }

    // Menampilkan daftar pengaduan pengguna yang login
    public function index()
{
    $nim = session()->get('nim'); // Gunakan NIM dari session

    $data = [
        'title' => 'Pengaduan Anda',
        'pengaduan' => $this->pengaduanModel
            ->where('nim', $nim)
            ->orderBy('tanggal_pengaduan', 'DESC')
            ->findAll()
    ];

    return view('pengguna/pengaduan/index', $data);
}

    // Menampilkan form pengaduan
   public function create()
{
    $data = [
        'title' => 'Silakan Isi Formulir Pengaduan',
        'nama_lengkap' => session()->get('nama_lengkap'),
        'nim' => session()->get('nim'),
    ];
    return view('pengguna/pengaduan/create', $data);
}

// Menyimpan pengaduan baru
public function store()
{
    $foto = $this->request->getFile('foto');
    $fotoName = '';

    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        $fotoName = $foto->getRandomName();
        $foto->move('uploads/pengaduan', $fotoName);
    }

    $data = [
        'nim'                => session()->get('nim'),           // Ambil dari session (tidak bisa dimanipulasi)
        'nama_lengkap'       => session()->get('nama_lengkap'), // Ambil dari session (tidak bisa dimanipulasi)
        'tanggal_pengaduan'  => $this->request->getPost('tanggal_pengaduan'),
        'isi_pengaduan'      => $this->request->getPost('isi_pengaduan'),
        'foto'               => $fotoName,
        'status'             => 'Terkirim'
    ];

    $this->pengaduanModel->insert($data);

    return redirect()->to('/pengguna/pengaduan')->with('success', 'Pengaduan berhasil dikirim.');
}
// Controller: Pengaduan.php
public function lihatTanggapan($id)
{
    $pengaduanModel = new \App\Models\PengaduanModel();
    $tanggapanModel = new \App\Models\TanggapanModel();

    $pengaduan = $pengaduanModel->find($id);
    $tanggapan = $tanggapanModel->where('pengaduan_id', $id)->first();
        $data = [
            'title' => 'Detail Tanggapan Pengaduan', // Menambahkan title
            'pengaduan' => $pengaduan,
            'tanggapan' => $tanggapan
        ];
         return view('pengguna/pengaduan/tanggapan', $data);
    }
   public function daftarTanggapan()
{
    $nim = session()->get('nim');

    $pengaduanModel = new \App\Models\PengaduanModel();
    $tanggapanModel = new \App\Models\TanggapanModel();

    // Ambil semua pengaduan milik pengguna
    $pengaduanList = $pengaduanModel->where('nim', $nim)->findAll();

    // Untuk tiap pengaduan, ambil tanggapannya jika ada
    $data = [];
    foreach ($pengaduanList as $pengaduan) {
        $tanggapan = $tanggapanModel->where('pengaduan_id', $pengaduan['id'])->first();
        $data[] = [
            'pengaduan' => $pengaduan,
            'tanggapan' => $tanggapan
        ];
    }

    return view('pengguna/pengaduan/daftar_tanggapan', [
        'title' => 'Daftar Tanggapan dari Admin',
        'list' => $data
    ]);
}

}
