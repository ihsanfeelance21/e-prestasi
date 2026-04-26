<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\PrestasiModel; // Pastikan Anda sudah membuat PrestasiModel

class Siswa extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    // --- Menampilkan Halaman Induk Data Siswa (Dengan Filter & Search) ---
    public function index()
    {
        // 1. Tangkap parameter dari URL (GET)
        $keyword = $this->request->getGet('keyword');
        $kelas   = $this->request->getGet('kelas');
        $perPage = $this->request->getGet('per_page') ?? 10; // Default 10 data

        // 2. Mulai query dari Model
        $query = $this->siswaModel;

        // 3. Logika Filter Pencarian
        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('nama_siswa', $keyword)
                ->orLike('nisn', $keyword)
                ->groupEnd();
        }

        // 4. Logika Filter Kelas
        if (!empty($kelas)) {
            $query = $query->where('kelas', $kelas);
        }

        // 5. Eksekusi Query berdasarkan Paginasi
        if ($perPage == 'all') {
            $siswa = $query->findAll();
            $pager = null; // Tidak perlu pagenation jika 'all'
        } else {
            $siswa = $query->paginate($perPage);
            $pager = $this->siswaModel->pager;
        }

        $data = [
            'title' => 'Data Siswa',
            'siswa' => $siswa,
            'pager' => $pager
        ];

        return view('siswa/index', $data);
    }

    // --- Menampilkan Form Tambah Siswa ---
    public function create()
    {
        $data = [
            'title'      => 'Tambah Data Siswa',
            'validation' => \Config\Services::validation()
        ];

        return view('siswa/create', $data);
    }

    // --- Memproses Data Tambah Siswa ---
    // --- Memproses Data Tambah Siswa ---
    // --- Memproses Data Tambah Siswa ---
    public function store()
    {
        $rules = [
            'nama_siswa' => 'required|min_length[3]|alpha_space',
            'nisn'       => 'required|numeric|is_unique[siswa.nisn]',
            'kelas'      => 'required',
            'no_hp'      => 'permit_empty|numeric',
            'foto'       => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]'
        ];

        // PERBAIKAN 1: Kirimkan pesan error validasi ke halaman create
        if (!$this->validate($rules)) {
            return redirect()->to('/siswa/create')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // --- 1. PROSES UPLOAD & KONVERSI FOTO ---
        $fotoFile = $this->request->getFile('foto');
        $namaFotoWebp = 'default.jpg';

        if ($fotoFile->getError() != 4) {
            $namaAsli = $fotoFile->getRandomName();
            $namaTanpaEkstensi = pathinfo($namaAsli, PATHINFO_FILENAME);
            $namaFotoWebp = $namaTanpaEkstensi . '.webp';

            $fotoFile->move(FCPATH . 'uploads/siswa/', $namaAsli);

            \Config\Services::image()
                ->withFile(FCPATH . 'uploads/siswa/' . $namaAsli)
                ->convert(IMAGETYPE_WEBP)
                ->save(FCPATH . 'uploads/siswa/' . $namaFotoWebp, 80);

            if (file_exists(FCPATH . 'uploads/siswa/' . $namaAsli)) {
                unlink(FCPATH . 'uploads/siswa/' . $namaAsli);
            }
        }

        // --- 2. GENERATE PASSWORD UNTUK AKUN ---
        $nisn = $this->request->getPost('nisn');
        $email = $this->request->getPost('email'); // Tangkap email dari form
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $passwordAwal = substr(str_shuffle($characters), 0, 6);
        $passwordHash = password_hash($passwordAwal, PASSWORD_DEFAULT);
        $waktuSekarang = date('Y-m-d H:i:s');

        // --- 3. MULAI TRANSAKSI DATABASE ---
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // PERBAIKAN 2: Sesuaikan nama kolom tabel users (password_hash, is_active, dll)
            $db->table('users')->insert([
                'username'       => $nisn,
                'email'          => $email,
                'password_hash'  => $passwordHash,
                'role_id'        => 2, // Role Siswa
                'is_active'      => 1, // Akun langsung aktif
                'login_attempts' => 0,
                'locked_until'   => null,
                'created_at'     => $waktuSekarang,
                'updated_at'     => $waktuSekarang
            ]);

            // B. Simpan Biodata ke Tabel Siswa
            $db->table('siswa')->insert([
                'nama_siswa'    => $this->request->getPost('nama_siswa'),
                'kelas'         => $this->request->getPost('kelas'),
                'nisn'          => $nisn,
                'email'         => $email,
                'no_hp'         => $this->request->getPost('no_hp'),
                'foto_siswa'    => $namaFotoWebp,
                'password_awal' => $passwordAwal
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data ke database.');
            }

            return redirect()->to('/siswa')->with('success', 'Data siswa dan akun berhasil dibuat otomatis!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    // --- Menampilkan Form Edit ---
    public function edit($id)
    {
        $data = [
            'title'      => 'Edit Data Siswa',
            'siswa'      => $this->siswaModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        if (empty($data['siswa'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Siswa tidak ditemukan');
        }

        return view('siswa/edit', $data);
    }

    // --- Memproses Data Edit ---
    public function update($id)
    {
        $siswaLama = $this->siswaModel->find($id);
        $ruleNisn = ($siswaLama['nisn'] == $this->request->getPost('nisn')) ? 'required' : 'required|is_unique[siswa.nisn]';

        $rules = [
            'nama_siswa' => 'required|min_length[3]|alpha_space',
            'nisn'       => $ruleNisn . '|numeric',
            'kelas'      => 'required',
            'no_hp'      => 'permit_empty|numeric',
            'foto'       => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/siswa/edit/' . $id)->withInput();
        }

        $fotoFile = $this->request->getFile('foto');
        $namaFotoWebp = $siswaLama['foto_siswa'];

        if ($fotoFile->getError() != 4) {
            $namaAsli = $fotoFile->getRandomName();
            $namaTanpaEkstensi = pathinfo($namaAsli, PATHINFO_FILENAME);
            $namaFotoWebp = $namaTanpaEkstensi . '.webp';

            $fotoFile->move(FCPATH . 'uploads/siswa/', $namaAsli);

            \Config\Services::image()
                ->withFile(FCPATH . 'uploads/siswa/' . $namaAsli)
                ->convert(IMAGETYPE_WEBP)
                ->save(FCPATH . 'uploads/siswa/' . $namaFotoWebp, 80);

            if (file_exists(FCPATH . 'uploads/siswa/' . $namaAsli)) {
                unlink(FCPATH . 'uploads/siswa/' . $namaAsli);
            }

            if ($siswaLama['foto_siswa'] != 'default.jpg' && file_exists(FCPATH . 'uploads/siswa/' . $siswaLama['foto_siswa'])) {
                unlink(FCPATH . 'uploads/siswa/' . $siswaLama['foto_siswa']);
            }
        }

        $this->siswaModel->update($id, [
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'kelas'      => $this->request->getPost('kelas'),
            'nisn'       => $this->request->getPost('nisn'),
            'email'      => $this->request->getPost('email'),
            'no_hp'      => $this->request->getPost('no_hp'),
            'foto_siswa' => $namaFotoWebp
        ]);

        session()->setFlashdata('success', 'Data siswa berhasil diperbarui!');
        return redirect()->to('/siswa');
    }

    // --- Menghapus Data Siswa ---
    public function delete($id)
    {
        $siswa = $this->siswaModel->find($id);

        if ($siswa['foto_siswa'] != 'default.jpg' && file_exists(FCPATH . 'uploads/siswa/' . $siswa['foto_siswa'])) {
            unlink(FCPATH . 'uploads/siswa/' . $siswa['foto_siswa']);
        }

        $this->siswaModel->delete($id);
        session()->setFlashdata('success', 'Data siswa berhasil dihapus secara permanen!');

        return redirect()->to('/siswa');
    }

    public function detail($id)
    {
        $siswa = $this->siswaModel->find($id);

        if (empty($siswa)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Siswa tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Data Siswa',
            'siswa' => $siswa
        ];

        // --- MENGOLAH DATA PRESTASI ---
        $prestasiModel = new \App\Models\PrestasiModel();

        // PERBAIKAN PENTING: Cari dulu ID user di tabel 'users' berdasarkan NISN
        $db = \Config\Database::connect();
        $akunUser = $db->table('users')->where('username', $siswa['nisn'])->get()->getRowArray();

        // Jika akunnya tidak ketemu, kita buat id-nya jadi 0 agar query prestasinya aman (kosong)
        $idAkunUsers = $akunUser ? $akunUser['id'] : 0;

        $keyword = $this->request->getGet('keyword');
        $tingkat = $this->request->getGet('tingkat');
        $perPage = $this->request->getGet('per_page') ?? 10;

        // Gunakan $idAkunUsers, BUKAN $id tabel siswa
        $query = $prestasiModel->where('user_id', $idAkunUsers);

        if (!empty($keyword)) {
            $query = $query->like('judul_prestasi', $keyword);
        }

        if (!empty($tingkat)) {
            $query = $query->where('tingkat', $tingkat);
        }

        if ($perPage == 'all') {
            $data['prestasi'] = $query->findAll();
            $data['pager']    = null;
        } else {
            $data['prestasi'] = $query->paginate((int)$perPage, 'prestasi');
            $data['pager']    = $prestasiModel->pager;
        }

        return view('siswa/detail', $data);
    }
}
