<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Technical extends Model
{
    protected $table      = 'technical_competency';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_technical';
    protected $allowedFields = ['proficiency', '', 'technical', 'departemen'];

    public function getDataTechnical()
    {
        $this->select();
        return $this->get()->getResultArray();
    }

    public function getDataTechnicalDepartemen($departemen)
    {
        $this->select()->where('departemen', $departemen);
        return $this->get()->getResultArray();
    }
}