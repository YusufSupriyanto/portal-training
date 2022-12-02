<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Nilai extends Model
{
    protected $table      = 'nilai';
    protected $primaryKey = 'id_nilai';
    // protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_competency1', 'type_competency1', 'id_competency2', 'type_competency2',
        'id_competency3', 'type_competency3', 'id_competency4', 'type_competency4',
        'id_competency5', 'type_competency5', 'id_tna'
    ];

    public function getDataNilai($id)
    {
        $this->select()->where('nilai.id_tna', $id);
        $this->join('tna', 'tna.id_tna = nilai.id_tna');
        return $this->get()->getResultArray();
    }
}