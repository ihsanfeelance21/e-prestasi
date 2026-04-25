<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_siswa', 'kelas', 'nisn', 'email', 'no_hp', 'foto_siswa'];

    // Aktifkan timestamp otomatis (created_at, updated_at)
    protected $useTimestamps = true;
}
