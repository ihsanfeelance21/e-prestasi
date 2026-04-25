<?php

namespace App\Controllers;

use App\Models\PrestasiModel;
use App\Models\SiswaModel;

class PrestasiController extends BaseController
{
    protected $prestasiModel;

    public function __construct()
    {
        $this->prestasiModel = new PrestasiModel();
    }

    public function index()
    {
        $roleId = session()->get('role_id');
        $userId = session()->get('user_id');

        // Jika Admin (1), ambil semua. Jika Siswa (2), ambil miliknya saja.
        $dataPrestasi = ($roleId == 1)
            ? $this->prestasiModel->getPrestasiWithUser()
            : $this->prestasiModel->getPrestasiWithUser($userId);

        $data = [
            'title'    => 'Daftar Prestasi',
            'prestasi' => $dataPrestasi
        ];

        return view('prestasi/index', $data);
    }

    public function create()
    {
        $siswaModel = new SiswaModel();

        // Tangkap user_id dari URL atau dari old input
        $userId = $this->request->getGet('user_id') ?? old('user_id');

        $data = [
            'title'      => 'Tambah Data Prestasi',
            'validation' => \Config\Services::validation()
        ]; // <--- ARRAY HARUS DITUTUP DI SINI DENGAN TITIK KOMA

        // Baru jalankan logika pengecekan setelah array ditutup
        if (!empty($userId)) {
            // Skenario 1: Tombol diklik dari halaman Detail Siswa
            $data['siswa_terpilih'] = $siswaModel->find($userId);
        } else {
            // Skenario 2: Tombol diklik dari halaman utama Prestasi
            $data['semua_siswa'] = $siswaModel->findAll();
        }

        // Catatan: Pastikan nama file view Anda benar 'prestasi/add', 
        // jika sebelumnya 'prestasi/create', ubah sesuai nama file Anda.
        return view('prestasi/add', $data);
    }

    public function store()
    {
        // 1. Aturan Validasi (Ubah validasi user_id menjadi nisn_siswa)
        $rules = [
            'nisn_siswa' => [
                'rules'  => (session()->get('role_id') == 1) ? 'required' : 'permit_empty',
                'errors' => ['required' => 'Silakan pilih nama siswa terlebih dahulu.']
            ],
            'judul_prestasi' => 'required|min_length[3]|max_length[255]',
            'kategori'       => 'required|in_list[Akademik,Non-Akademik]',
            'tingkat'        => 'required|in_list[Sekolah,Kabupaten/Kota,Provinsi,Nasional,Internasional]',
            'tahun'          => 'required|exact_length[4]|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan! Silakan periksa kembali isian Anda.');
        }

        // 2. LOGIKA MENCARI USER_ID BERDASARKAN NISN
        $roleId = session()->get('role_id');
        $userIdToSave = null;

        if ($roleId == 1) { // Jika yang input Admin
            $nisn = $this->request->getPost('nisn_siswa');

            // PERBAIKAN: Gunakan Query Builder agar tidak butuh UserModel
            $db = \Config\Database::connect();

            // CATATAN: Ganti 'username' di bawah ini dengan nama kolom di tabel users 
            // yang menampung data NISN (bisa 'username', 'nisn', atau 'email')
            $user = $db->table('users')->where('username', $nisn)->get()->getRowArray();

            // Jika admin memilih siswa tapi siswa tersebut belum dibuatkan akun login
            if (empty($user)) {
                return redirect()->back()->withInput()->with('error', 'Siswa dengan NISN ' . $nisn . ' belum memiliki akun login di sistem!');
            }

            $userIdToSave = $user['id']; // Dapatkan ID dari tabel users

        } else { // Jika yang input Siswa itu sendiri
            $userIdToSave = session()->get('user_id');
        }

        // 3. Simpan ke Database Prestasi
        $this->prestasiModel->save([
            'user_id'         => $userIdToSave, // Sekarang ini murni ID dari tabel users!
            'judul_prestasi'  => $this->request->getPost('judul_prestasi'),
            'kategori'        => $this->request->getPost('kategori'),
            'tingkat'         => $this->request->getPost('tingkat'),
            'tahun'           => $this->request->getPost('tahun'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'status_validasi' => 'Menunggu'
        ]);

        return redirect()->to('/prestasi')->with('success', 'Data prestasi berhasil ditambahkan!');
    }
    public function delete($id)
    {
        // Cek apakah data ada di database
        $prestasi = $this->prestasiModel->find($id);

        if (!$prestasi) {
            return redirect()->to('/prestasi')->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data dari database
        $this->prestasiModel->delete($id);

        return redirect()->to('/prestasi')->with('success', 'Data prestasi berhasil dihapus!');
    }
    public function edit($id)
    {
        $prestasi = $this->prestasiModel->find($id);

        // Validasi: Jika data tidak ditemukan
        if (!$prestasi) {
            return redirect()->to('/prestasi')->with('error', 'Data tidak ditemukan.');
        }

        // Keamanan: Siswa tidak boleh edit prestasi milik orang lain
        if (session()->get('role_id') == 2 && $prestasi['user_id'] != session()->get('user_id')) {
            return redirect()->to('/prestasi')->with('error', 'Anda tidak memiliki akses.');
        }

        $data = [
            'title'    => 'Edit Data Prestasi',
            'prestasi' => $prestasi,
            'validation' => \Config\Services::validation()
        ];

        return view('prestasi/edit', $data);
    }

    public function update($id)
    {
        // Aturan validasi (sama dengan store)
        $rules = [
            'judul_prestasi' => 'required|min_length[3]|max_length[255]',
            'kategori'       => 'required',
            'tingkat'        => 'required',
            'tahun'          => 'required|exact_length[4]|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui! Periksa kembali isian Anda.');
        }

        // Update data berdasarkan ID
        $this->prestasiModel->update($id, [
            'judul_prestasi'  => $this->request->getPost('judul_prestasi'),
            'kategori'        => $this->request->getPost('kategori'),
            'tingkat'         => $this->request->getPost('tingkat'),
            'tahun'           => $this->request->getPost('tahun'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            // Status kembali ke 'Menunggu' jika diedit agar admin bisa validasi ulang
            'status_validasi' => 'Menunggu'
        ]);

        return redirect()->to('/prestasi')->with('success', 'Data prestasi berhasil diperbarui!');
    }
    public function validateStatus($id, $status)
    {
        // Keamanan: Hanya Admin yang boleh akses
        if (session()->get('role_id') != 1) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        // PERBAIKAN: Gunakan in_array, bukan in_list
        $allowedStatus = ['Disetujui', 'Ditolak'];
        if (!in_array($status, $allowedStatus)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        // Update status_validasi ke database
        $this->prestasiModel->update($id, [
            'status_validasi' => $status
        ]);

        $pesan = ($status == 'Disetujui') ? 'Prestasi telah disetujui!' : 'Prestasi telah ditolak.';
        return redirect()->to('/prestasi')->with('success', $pesan);
    }
}
