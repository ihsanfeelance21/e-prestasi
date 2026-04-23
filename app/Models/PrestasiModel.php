<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestasiModel extends Model
{
    protected $table            = 'prestasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id',
        'judul_prestasi',
        'kategori',
        'tingkat',
        'tahun',
        'deskripsi',
        'status_validasi'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengambil data prestasi beserta nama usernya (Join)
     */
    public function getPrestasiWithUser($userId = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('prestasi.*, users.username');
        $builder->join('users', 'users.id = prestasi.user_id');

        // Jika bukan admin, hanya tampilkan milik sendiri
        if ($userId !== null) {
            $builder->where('prestasi.user_id', $userId);
        }

        $builder->orderBy('prestasi.created_at', 'DESC');
        return $builder->get()->getResultArray();
    }
}
