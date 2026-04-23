<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        // Jika user sudah login, langsung tendang ke dashboard agar tidak perlu login lagi
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function process()
    {
        $db = \Config\Database::connect();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan username
        $user = $db->table('users')->where('username', $username)->get()->getRowArray();

        if ($user) {
            // Verifikasi password menggunakan BCRYPT (standar keamanan modern)
            if (password_verify($password, $user['password_hash'])) {

                // Set Session Login
                session()->set([
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'role_id'    => $user['role_id'],
                    'isLoggedIn' => true
                ]);

                return redirect()->to('/dashboard');
            }
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return redirect()->back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
