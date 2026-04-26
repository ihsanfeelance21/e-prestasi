<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLockoutColumnsToUsers extends Migration
{
    public function up()
    {
        // Mendefinisikan kolom baru yang akan ditambahkan
        $fields = [
            'login_attempts' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => false,
            ],
            'locked_until' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null,
            ],
        ];

        // Menambahkan kolom ke tabel 'users'
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        // Menghapus kolom jika kita melakukan rollback migration
        $this->forge->dropColumn('users', ['login_attempts', 'locked_until']);
    }
}
