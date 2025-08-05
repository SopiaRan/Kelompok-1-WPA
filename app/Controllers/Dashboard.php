<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\AnggotaModel;
use App\Models\TanggapanModel;

class Dashboard extends BaseController
{
    public function admin()
    {
        if (session()->get('role') === 'admin') {
            // Panggil model
            $pengaduanModel = new PengaduanModel();
            $anggotaModel = new AnggotaModel();
             $tanggapanModel = new TanggapanModel(); $tanggapanModel = new TanggapanModel();

            // Kirim jumlah data ke view
            $data = [
                'title' => 'Dashboard Admin',
                'totalAnggota' => $anggotaModel->countAll(),
                'totalPengaduan' => $pengaduanModel->countAll(),
                'totalTanggapan' => $tanggapanModel->countAll(),
                'pengaduanTerbaru' => $pengaduanModel->orderBy('tanggal_pengaduan', 'DESC')->limit(5)->findAll(),
                'bulanChart' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'], // bisa diganti dinamis
                'jumlahPengaduanPerBulan' => [10, 15, 8, 12, 5, 20],
                'jumlahTanggapanPerBulan' => [8, 14, 7, 10, 5, 18],
            ];

            return view('admin/dashboard', $data);
        }

        return redirect()->to('/auth/login');
    }

   public function pengguna()
{
    if (session()->get('role') !== 'pengguna') {
        return redirect()->to('/auth/login');
    }

    $pengaduanModel = new \App\Models\PengaduanModel();
    $nim = session()->get('nim'); // Gunakan NIM dari session

    // Total pengaduan pengguna
    $jumlahPengaduan = $pengaduanModel
        ->where('nim', $nim)
        ->countAllResults();

    // Pengaduan status 'proses'
    $jumlahProses = $pengaduanModel
        ->where('nim', $nim)
        ->where('status', 'Terkirim')
        ->countAllResults();

    // Pengaduan status 'selesai'
    $jumlahSelesai = $pengaduanModel
        ->where('nim', $nim)
        ->where('status', 'Ditanggapi')
        ->countAllResults();

    $data = [
        'title' => 'Dashboard Pengguna',
        'jumlahPengaduan' => $jumlahPengaduan,
        'jumlahProses' => $jumlahProses,
        'jumlahSelesai' => $jumlahSelesai
    ];

    return view('pengguna/dashboard', $data);
}
public function profile()
{
    if (session()->get('role') !== 'pengguna') {
        return redirect()->to('/auth/login');
    }

    $data = [
        'title' => 'Profil Saya'
    ];

    return view('pengguna/profile', $data);
}
public function updateFoto()
{
    if (session()->get('role') !== 'pengguna') {
        return redirect()->to('/auth/login');
    }

    $file = $this->request->getFile('foto_profil');
    
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('uploads/profil', $newName);

        // Simpan ke database
        $userModel = new \App\Models\UserModel();
        $userModel->update(session()->get('user_id'), ['foto_profil' => $newName]);

        // Perbarui juga di session
        session()->set('foto_profil', $newName);
    }

    return redirect()->to('pengguna/profile')->with('success', 'Foto profil berhasil diperbarui.');
}
}


