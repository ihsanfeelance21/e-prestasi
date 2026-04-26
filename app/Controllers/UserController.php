<?php

namespace App\Controllers;

class UserController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // --- Menampilkan Daftar User ---
    public function index()
    {
        // Ambil data users, gabungkan dengan tabel siswa (jika username = nisn) agar nama siswa tampil
        $builder = $this->db->table('users');
        $builder->select('users.*, siswa.nama_siswa');
        $builder->join('siswa', 'siswa.nisn = users.username', 'left');
        $users = $builder->get()->getResultArray();

        $data = [
            'title' => 'Manajemen Pengguna',
            'users' => $users
        ];

        return view('user/index', $data);
    }

    // --- Membuka Kunci Akun (Reset Login) ---
    public function resetLogin($id)
    {
        $this->db->table('users')->where('id', $id)->update([
            'login_attempts' => 0,
            'locked_until'   => null
        ]);

        session()->setFlashdata('success', 'Kunci login berhasil dibuka! User sekarang bisa mencoba login kembali.');
        return redirect()->to('/user');
    }

    // --- Reset Password ---
    public function resetPassword($id)
    {
        $user = $this->db->table('users')->where('id', $id)->get()->getRowArray();

        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan!');
            return redirect()->to('/user');
        }

        // 1. Generate Password Baru (6 Karakter: Huruf, Angka, Simbol)
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $passwordBaru = substr(str_shuffle($characters), 0, 6);
        $passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

        $this->db->transStart();
        try {
            // 2. Update password di tabel users
            $this->db->table('users')->where('id', $id)->update([
                'password'       => $passwordHash,
                'login_attempts' => 0,    // Sekalian buka kunci jika sedang terkunci
                'locked_until'   => null
            ]);

            // 3. Update password_awal di tabel siswa (agar Admin bisa melihatnya di Detail Siswa)
            // Asumsi role_id 2 adalah siswa
            if ($user['role_id'] == 2) {
                $this->db->table('siswa')->where('nisn', $user['username'])->update([
                    'password_awal' => $passwordBaru
                ]);
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                session()->setFlashdata('error', 'Gagal mereset password.');
            } else {
                session()->setFlashdata('success', 'Password berhasil direset! Password baru untuk ' . $user['username'] . ' adalah: ' . $passwordBaru);
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('/user');
    }

    // --- Hapus Akun (Proteksi Superadmin) ---
    public function delete($id)
    {
        $user = $this->db->table('users')->where('id', $id)->get()->getRowArray();

        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan!');
            return redirect()->to('/user');
        }

        // PROTEKSI: Mencegah akun Superadmin (Role 1) dihapus
        if ($user['role_id'] == 1) {
            session()->setFlashdata('error', 'Akses Ditolak! Akun Superadmin tidak boleh dihapus.');
            return redirect()->to('/user');
        }

        $this->db->table('users')->where('id', $id)->delete();
        session()->setFlashdata('success', 'Akun pengguna berhasil dihapus!');
        return redirect()->to('/user');
    }

    // --- Menampilkan Form Ganti Password Sendiri ---
    public function gantiPassword()
    {
        $data = [
            'title'      => 'Ganti Password',
            'validation' => \Config\Services::validation()
        ];
        return view('user/ganti_password', $data);
    }

    // --- Memproses Ganti Password ---
    public function prosesGantiPassword()
    {
        $userId = session()->get('user_id');
        $username = session()->get('username');

        // Aturan validasi: Minimal 6 karakter, wajib ada huruf, angka, dan simbol (Non-Word)
        $rules = [
            'password_lama'       => 'required',
            'password_baru'       => [
                'rules'  => 'required|min_length[6]|regex_match[/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{6,}$/]',
                'errors' => [
                    'regex_match' => 'Password baru harus mengandung kombinasi huruf, angka, dan simbol khusus (seperti !@#$%).',
                    'min_length'  => 'Password minimal harus 6 karakter.'
                ]
            ],
            'konfirmasi_password' => [
                'rules'  => 'required|matches[password_baru]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sama dengan password baru.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/profil/ganti-password')->withInput();
        }

        $user = $this->db->table('users')->where('id', $userId)->get()->getRowArray();

        // 1. Cek apakah password lama benar
        if (!password_verify($this->request->getPost('password_lama'), $user['password_hash'])) { // <--- UBAH DI SINI
            return redirect()->back()->with('error', 'Password lama Anda salah!');
        }

        // 2. Hash password baru
        $passwordBaruHash = password_hash($this->request->getPost('password_baru'), PASSWORD_DEFAULT);

        $this->db->transStart();
        try {
            // 3. Update password di tabel users
            $this->db->table('users')->where('id', $userId)->update([
                'password_hash' => $passwordBaruHash // <--- UBAH DI SINI
            ]);

            // 4. Samarkan password_awal di tabel siswa untuk privasi (Jika role siswa)
            if ($user['role_id'] == 2) {
                $this->db->table('siswa')->where('nisn', $username)->update([
                    'password_awal' => '[Telah diubah oleh Pengguna]'
                ]);
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal memperbarui password di database.');
            }

            return redirect()->to('/profil/ganti-password')->with('success', 'Password Anda berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    // --- Generate Akun Massal untuk Siswa Lama ---
    public function generateAkunSiswa()
    {
        // 1. Ambil data siswa yang BELUM ada di tabel users
        // Kita gunakan subquery agar lebih akurat
        $siswaList = $this->db->query("SELECT * FROM siswa WHERE nisn NOT IN (SELECT username FROM users)")->getResultArray();

        $jumlahTerbuat = 0;
        $waktuSekarang = date('Y-m-d H:i:s');

        if (empty($siswaList)) {
            session()->setFlashdata('success', 'Semua data siswa saat ini sudah memiliki akun.');
            return redirect()->to('/user');
        }

        foreach ($siswaList as $siswa) {
            // Generate Password
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
            $passwordAwal = substr(str_shuffle($characters), 0, 6);
            $passwordHash = password_hash($passwordAwal, PASSWORD_DEFAULT);

            $this->db->transStart();

            // 2. Insert ke tabel users (PASTIKAN SEMUA KOLOM TERISI)
            $this->db->table('users')->insert([
                'username'       => $siswa['nisn'],
                'email'          => $siswa['email'], // Kita ambil email dari tabel siswa
                'password_hash'  => $passwordHash,
                'role_id'        => 2,               // Role Siswa
                'is_active'      => 1,               // Langsung aktifkan
                'login_attempts' => 0,
                'locked_until'   => null,
                'created_at'     => $waktuSekarang,
                'updated_at'     => $waktuSekarang
            ]);

            // 3. Update password_awal di tabel siswa
            $this->db->table('siswa')->where('nisn', $siswa['nisn'])->update([
                'password_awal' => $passwordAwal
            ]);

            $this->db->transComplete();

            if ($this->db->transStatus() !== false) {
                $jumlahTerbuat++;
            }
        }

        if ($jumlahTerbuat > 0) {
            session()->setFlashdata('success', "Berhasil! $jumlahTerbuat akun siswa baru telah dibuat dan diaktifkan.");
        } else {
            session()->setFlashdata('error', 'Gagal membuat akun. Silakan cek apakah kolom email di tabel siswa sudah terisi semua.');
        }

        return redirect()->to('/user');
    }
}
