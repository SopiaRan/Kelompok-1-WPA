<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    public function index()
    {
    $model = new AnggotaModel();
    $data = [
        'title' => 'Data Anggota',
        'anggota' => $model->findAll(),
    ];
    return view('admin/anggota/index', $data);
    }

    public function create()
    {
    $data = [
        'title' => 'Tambah Anggota',
    ];
    return view('admin/anggota/create', $data);
    }


    public function store()
{
    $model = new \App\Models\AnggotaModel();

    $data = [
        'Nama'       => $this->request->getPost('Nama'),
        'Nim'        => $this->request->getPost('Nim'),
        'Departemen' => $this->request->getPost('Departemen'),
        'Jabatan'    => $this->request->getPost('Jabatan'),
    ];

    $model->insert($data);

    session()->setFlashdata('success', 'Data anggota berhasil disimpan.');
    return redirect()->to('/admin/anggota');
}

public function edit($id)
{
    $model = new AnggotaModel();
    $data = [
        'anggota' => $model->find($id),
        'title'   => 'Edit Anggota'
    ];
    return view('admin/anggota/edit', $data);
}


public function update($id)
{
    $model = new \App\Models\AnggotaModel();
    $data = [
        'Nama'       => $this->request->getPost('Nama'),
        'Nim'        => $this->request->getPost('Nim'),
        'Departemen' => $this->request->getPost('Departemen'),
        'Jabatan'    => $this->request->getPost('Jabatan'),
    ];
    $model->update($id, $data);

    session()->setFlashdata('success', 'Data anggota berhasil diperbarui.');
    return redirect()->to('/admin/anggota');
}

    public function delete($id)
{
    $model = new AnggotaModel();
    $model->delete($id);

    // Tambahkan flashdata
    session()->setFlashdata('success', 'Data anggota berhasil dihapus.');

    return redirect()->to('/admin/anggota');
}

}
