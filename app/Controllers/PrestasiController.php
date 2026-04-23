<?php

namespace App\Controllers;

use App\Models\PrestasiModel;

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
        $data = [
            'title'      => 'Tambah Data Prestasi',
            'validation' => \Config\Services::validation() // Untuk menangani pesan error validasi
        ];

        return view('prestasi/add', $data);
    }

    public function store()
    {
        // 1. Aturan Validasi
        $rules = [
            'judul_prestasi' => [
                'rules'  => 'required|min_length[3]|max_length[255]',
                'errors' => ['required' => 'Judul prestasi wajib diisi.']
            ],
            'kategori' => [
                'rules'  => 'required|in_list[Akademik,Non-Akademik]',
                'errors' => ['required' => 'Pilih salah satu kategori.']
            ],
            'tingkat' => [
                'rules'  => 'required|in_list[Sekolah,Kabupaten/Kota,Provinsi,Nasional,Internasional]',
                'errors' => ['required' => 'Pilih tingkat pencapaian.']
            ],
            'tahun' => [
                'rules'  => 'required|exact_length[4]|numeric',
                'errors' => ['required' => 'Tahun wajib diisi (contoh: 2023).']
            ]
        ];

        // 2. Jalankan Validasi
        if (!$this->validate($rules)) {
            // Jika gagal, kembalikan ke form beserta pesan error dan input sebelumnya
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan! Silakan periksa kembali isian Anda.');
        }

        // 3. Simpan ke Database
        $this->prestasiModel->save([
            'user_id'         => session()->get('user_id'), // Ambil ID user yang sedang login
            'judul_prestasi'  => $this->request->getPost('judul_prestasi'),
            'kategori'        => $this->request->getPost('kategori'),
            'tingkat'         => $this->request->getPost('tingkat'),
            'tahun'           => $this->request->getPost('tahun'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'status_validasi' => 'Menunggu' // Default selalu "Menunggu" saat pertama input
        ]);

        // 4. Redirect ke halaman utama dengan pesan sukses
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
}
