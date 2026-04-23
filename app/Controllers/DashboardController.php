<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // Mengambil data dari session untuk ditampilkan di view
        $data = [
            'title'    => 'Dashboard Utama',
            'username' => session()->get('username'),
            'role_id'  => session()->get('role_id') // 1 = Admin, 2 = Siswa
        ];

        return view('dashboard/index', $data);
    }
}
