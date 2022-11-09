<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Technical extends Model
{
    protected $table      = 'technical_competency';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_technical';
    protected $allowedFields = ['proficiency', '', 'technical', 'departemen', 'golongan'];

    public function getDataTechnical()
    {
        $this->select();
        return $this->get()->getResultArray();
    }

    public function getDataTechnicalDepartemen($departemen, $group)
    {
        $this->select()->where('departemen', $departemen)->where('golongan', $group);
        return $this->get()->getResultArray();
    }

    public function getTechnicalLastRow()
    {
        $this->select('id_technical');
        return $this->get()->getLastRow();
    }
}