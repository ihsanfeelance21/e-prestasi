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
            return redirect()->back()->withInput();
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
}
