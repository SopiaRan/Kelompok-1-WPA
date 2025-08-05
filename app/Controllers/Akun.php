<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Akun extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data = [
            'title' => 'Data Akun Pengguna',
            'pengguna' => $userModel->findAll()
        ];
        return view('admin/akun_pengguna/index', $data);
    }

    public function create()
    {
        return view('admin/akun_pengguna/create', ['title' => 'Tambah Akun']);
    }

    public function store()
{
    $userModel = new UserModel();

    $data = [
        'username'      => $this->request->getPost('username'),
        'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
        'nim'           => $this->request->getPost('nim'),
        'email'         => $this->request->getPost('email'),
        'role'          => $this->request->getPost('role'),
        'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    ];

    if ($userModel->insert($data)) {
        return redirect()->to('/admin/akun_pengguna')->with('success', 'Akun berhasil ditambahkan.');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan akun. Silakan coba lagi.');
    }
}

    public function delete($id)
{
    $userModel = new \App\Models\UserModel();

    // Cek apakah user dengan ID tersebut ada
    $user = $userModel->find($id);
    if (!$user) {
        return redirect()->to('/admin/akun_pengguna')->with('error', 'Akun tidak ditemukan.');
    }


    if ($userModel->delete($id)) {
        return redirect()->to('/admin/akun_pengguna')->with('success', 'Akun berhasil dihapus.');
    } else {
        return redirect()->to('/admin/akun_pengguna')->with('error', 'Gagal menghapus akun.');
    }
}


}
