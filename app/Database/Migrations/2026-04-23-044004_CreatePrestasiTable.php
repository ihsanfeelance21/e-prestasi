<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrestasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'judul_prestasi'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'kategori'         => ['type' => 'ENUM', 'constraint' => ['Akademik', 'Non-Akademik']],
            'tingkat'          => ['type' => 'ENUM', 'constraint' => ['Sekolah', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional']],
            'tahun'            => ['type' => 'YEAR', 'constraint' => 4],
            'deskripsi'        => ['type' => 'TEXT', 'null' => true],
            'status_validasi'  => ['type' => 'ENUM', 'constraint' => ['Menunggu', 'Disetujui', 'Ditolak'], 'default' => 'Menunggu'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        // Relasi ke tabel users (siapa yang memiliki prestasi ini)
        // Jika user dihapus, data prestasinya otomatis ikut terhapus (CASCADE)
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('prestasi');
    }

    public function down()
    {
        $this->forge->dropTable('prestasi');
    }
}
