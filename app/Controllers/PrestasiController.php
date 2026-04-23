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
}
