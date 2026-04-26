<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordAwalToSiswa extends Migration
{
    public function up()
    {
        $this->forge->addColumn('siswa', [
            'password_awal' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true, // Boleh kosong
                'after'      => 'nisn' // Menempatkan kolom setelah nisn (opsional)
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('siswa', 'password_awal');
    }
}
