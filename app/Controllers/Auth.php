<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $userModel;

    public function __construct()
    {
        helper(['url', 'form']);
        session();
        $this->userModel = new UserModel();
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // Menampilkan halaman registrasi
    public function register()
    {
        return view('auth/register');
    }

    // Proses registrasi
   public function attemptRegister()
{
    $data = $this->request->getPost();
    $foto = $this->request->getFile('foto_profil');
    $namaFoto = 'default.png';

    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        $namaFoto = $foto->getRandomName();
        $foto->move('uploads/profil/', $namaFoto); // simpan ke folder
    }

    $this->userModel->save([
        'username'      => $data['username'],
        'nama_lengkap'  => $data['nama_lengkap'],
        'nim'           => $data['nim'],
        'email'         => $data['email'],
        'password'      => password_hash($data['password'], PASSWORD_DEFAULT),
        'foto_profil'   => $namaFoto, // ⬅️ simpan nama file ke database
        'role'          => $data['role'] ?? 'pengguna'
    ]);

    return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil, silakan login.');
}



    // Proses login
    public function attemptLogin()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $user = $this->userModel->where('username', $username)->first();

    if ($user && password_verify($password, $user['password'])) {
        $sessionData = [
    'user_id'      => $user['id'],
    'nim'          => $user['nim'],
    'username'     => $user['username'],
    'nama_lengkap' => $user['nama_lengkap'],
    'email'        => $user['email'],
    'role'         => $user['role'],
    'foto_profil'  => $user['foto_profil'], // ✅ tambahkan baris ini
    'logged_in'    => true
];


        session()->set($sessionData);

        // Redirect sesuai dengan role
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif ($user['role'] === 'pengguna') {
            return redirect()->to('/pengguna/dashboard');
        } else {
            return redirect()->to('/auth/login')->with('error', 'Role tidak dikenali');
        }
    } else {
        return redirect()->to('/auth/login')->with('error', 'Username atau password salah.');
    }
}


    // Proses logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda telah logout.');
    }
}
