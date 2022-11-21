<?php

namespace App\Models;

use CodeIgniter\Model;

class M_TechnicalB extends Model
{
    protected $table      = 'competency_technicalB';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_technicalB';
    protected $allowedFields = [
        'kepala_sub_seksi', 'kepala_regu', 'staff', 'data_entry', 'operator',
        'security', 'supply_man', 'supporting_assembly_a', 'supporting_assembly_b', 'driver_forklift', 'driver', 'technicalB', 'department'
    ];

    public function getDataTechnical()
    {
        $this->select();
        return $this->get()->getResultArray();
    }

    public function getDataTechnicalBDepartemen($departemen)
    {
        $this->select()->where('department', $departemen);
        return $this->get()->getResultArray();
    }

    public function DepartmentB()
    {
        $this->select('department');
        return $this->get()->getResultArray();
    }

    public function getTechnicalBLastRow()
    {
        $this->select('id_technicalB');
        return $this->get()->getLastRow();
    }
}