<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Menyuntikkan Data Role (Hak Akses)
        $roles = [
            ['name' => 'Admin', 'description' => 'Administrator Sistem Pendidikan'],
            ['name' => 'Siswa', 'description' => 'Siswa Penginput Prestasi'],
        ];
        $this->db->table('roles')->insertBatch($roles);

        // 2. Menyuntikkan Data Akun Admin Default
        // Default Login -> Username: admin | Password: admin123
        $user = [
            'username'      => 'admin',
            'email'         => 'admin@sekolah.edu',
            'password_hash' => password_hash('admin123', PASSWORD_BCRYPT), // Enkripsi tingkat tinggi
            'role_id'       => 1, // ID 1 mereferensikan 'Admin'
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];
        $this->db->table('users')->insert($user);
    }
}
