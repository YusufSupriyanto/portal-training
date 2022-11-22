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

    public function getDataTechnicalDepartemen($departemen)
    {
        $this->select()->where('departemen', $departemen);
        return $this->get()->getResultArray();
    }

    public function getTechnicalLastRow()
    {
        $this->select('id_technical');
        return $this->get()->getLastRow();
    }

    public function getCompetencyTechnicalDepartment()
    {
        $this->select('departemen')->distinct();
        return $this->get()->getResultArray();
    }
}