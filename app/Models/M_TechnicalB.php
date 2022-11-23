<?php

namespace App\Models;

use CodeIgniter\Model;

class M_TechnicalB extends Model
{
    protected $table      = 'competency_technicalB';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_technicalB';
    protected $allowedFields = ['technicalB', 'proficiency', 'department', 'nama_jabatan'];

    public function getDataTechnical()
    {
        $this->select();
        return $this->get()->getResultArray();
    }

    public function getDataTechnicalBDepartemen($departemen)
    {
        $this->select()->groupStart()
            ->where('department', $departemen)
            ->groupEnd();
        return $this->get()->getResultArray();
    }

    public function DepartmentB()
    {
        $this->select('department')->Distinct();
        return $this->get()->getResultArray();
    }

    public function getTechnicalBLastRow()
    {
        $this->select('id_technicalB');
        return $this->get()->getLastRow();
    }
}