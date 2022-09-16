<?php

namespace App\Models;

use CodeIgniter\Model;

class M_History extends Model
{
    protected $table      = 'history';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_history';
    protected $allowedFields = [
        'id_tna', 'materi_training', 'waktu', 'sertifikat', 'penyelenggara', 'tempat', 'keterangan'
    ];

    public function getIdHistory($id)
    {
        $this->select()->where(['id_tna' => $id]);
        return $this->get()->getResultArray();
    }
}