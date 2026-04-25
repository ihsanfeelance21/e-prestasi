<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $roleId = session()->get('role_id');
        $userId = session()->get('user_id');

        // Hitung statistik
        $builder = $db->table('prestasi');

        // Jika siswa, hanya hitung miliknya
        if ($roleId == 2) {
            $builder->where('user_id', $userId);
        }

        $totalPrestasi = (clone $builder)->countAllResults();
        $menunggu      = (clone $builder)->where('status_validasi', 'Menunggu')->countAllResults();
        $disetujui     = (clone $builder)->where('status_validasi', 'Disetujui')->countAllResults();

        $data = [
            'title'    => 'Dashboard',
            'total'    => $totalPrestasi,
            'pending'  => $menunggu,
            'approved' => $disetujui
        ];

        return view('dashboard/index', $data);
    }
}
