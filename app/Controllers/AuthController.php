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
        $session = session();
        $db = \Config\Database::connect();

        $username = $this->request->getPost('username'); // Bisa username atau NISN
        $password = $this->request->getPost('password');

        // 1. Cari user berdasarkan username/NISN
        $user = $db->table('users')->where('username', $username)->get()->getRowArray();

        if ($user) {
            // 2. CEK APAKAH AKUN SEDANG TERKUNCI?
            if ($user['locked_until'] !== null && strtotime($user['locked_until']) > time()) {
                // Hitung sisa waktu kunci
                $sisaWaktu = strtotime($user['locked_until']) - time();
                $jam = floor($sisaWaktu / 3600);
                $menit = floor(($sisaWaktu % 3600) / 60);

                $session->setFlashdata('error', "Akun Anda terkunci karena terlalu banyak percobaan gagal. Silakan coba lagi dalam $jam jam $menit menit atau hubungi Admin.");
                return redirect()->to('/login')->withInput();
            }

            // 3. JIKA AKUN TIDAK TERKUNCI, CEK PASSWORD
            // Catatan: Jika kolom di database bernama 'password_hash', ganti $user['password'] menjadi $user['password_hash']
            if (password_verify($password, $user['password_hash'])) {

                // Password Benar! Reset kembali attempt jadi 0 dan hilangkan waktu kunci
                $db->table('users')->where('id', $user['id'])->update([
                    'login_attempts' => 0,
                    'locked_until'   => null
                ]);

                // Set Session Login (Menggunakan format asli Anda: isLoggedIn)
                session()->set([
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'role_id'    => $user['role_id'],
                    'isLoggedIn' => true
                ]);

                return redirect()->to('/dashboard');
            } else {
                // 4. PASSWORD SALAH!
                $attempts = $user['login_attempts'] + 1; // Tambah 1 kegagalan
                $updateData = ['login_attempts' => $attempts];

                // Cek apakah sudah 4 kali gagal?
                if ($attempts >= 4) {
                    // Set waktu kunci: Waktu saat ini ditambah 6 jam
                    $updateData['locked_until'] = date('Y-m-d H:i:s', strtotime('+6 hours'));
                    $session->setFlashdata('error', 'Anda telah gagal login 4 kali. Akun Anda dikunci selama 6 jam demi keamanan.');
                } else {
                    $sisa = 4 - $attempts;
                    $session->setFlashdata('error', "Password salah! Sisa percobaan Anda: $sisa kali lagi sebelum akun dikunci.");
                }

                // Update data kegagalan ke database
                $db->table('users')->where('id', $user['id'])->update($updateData);
                return redirect()->to('/login')->withInput();
            }
        } else {
            // User tidak ditemukan sama sekali
            $session->setFlashdata('error', 'Username/NISN atau Password salah!');
            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
