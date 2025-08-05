<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\TanggapanModel;

class Pengaduan2 extends BaseController
{
    protected $pengaduanModel;
    protected $tanggapanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
        $this->tanggapanModel = new TanggapanModel();
    }

    // Menampilkan daftar semua pengaduan
    public function index()
    {
        $data = [
            'title' => 'Daftar Pengaduan Masuk',
            'pengaduan' => $this->pengaduanModel->orderBy('tanggal_pengaduan', 'DESC')->findAll(),
        ];

        return view('admin/pengaduan/index', $data);
    }

    // Menampilkan form tanggapan
    public function tanggapi($id)
    {
        $pengaduan = $this->pengaduanModel->find($id);

        if (!$pengaduan) {
            return redirect()->to('/admin/pengaduan')->with('error', 'Pengaduan tidak ditemukan.');
        }

        $data = [
            'title' => 'Tanggapi Pengaduan',
            'pengaduan' => $pengaduan,
        ];

        return view('admin/pengaduan/tanggapi', $data);
    }

    // Menyimpan tanggapan dari admin
    public function storeTanggapan($id)
    {
        $pengaduan = $this->pengaduanModel->find($id);

        if (!$pengaduan) {
            return redirect()->to('/admin/pengaduan')->with('error', 'Pengaduan tidak ditemukan.');
        }

        // Simpan tanggapan
        $this->tanggapanModel->insert([
            'pengaduan_id' => $id,
            'tanggapan' => $this->request->getPost('tanggapan'),
            'tanggal_tanggapan' => $this->request->getPost('tanggal_tanggapan'),
        ]);

        // Update status pengaduan
        $this->pengaduanModel->update($id, ['status' => 'Ditanggapi']);

        return redirect()->to('/admin/pengaduan')->with('success', 'Tanggapan berhasil dikirim.');
    }

public function daftarTanggapan()
{
    $db = \Config\Database::connect();
    $builder = $db->table('tanggapan');
    $builder->select('tanggapan.*, pengaduan.nama_lengkap, pengaduan.nim, pengaduan.tanggal_pengaduan, pengaduan.isi_pengaduan');
    $builder->join('pengaduan', 'pengaduan.id = tanggapan.pengaduan_id');
    $builder->orderBy('tanggal_tanggapan', 'DESC');
    $query = $builder->get();

    $data = [
        'title' => 'Daftar Tanggapan',
        'tanggapan' => $query->getResultArray()
    ];

    return view('admin/tanggapan/index', $data);
}
public function detail($id)
{
    $model = new PengaduanModel();
    $data['pengaduan'] = $model->find($id);
    $data['title'] = 'Detail Pengaduan';
    return view('admin/pengaduan/detail', $data);
}

}
