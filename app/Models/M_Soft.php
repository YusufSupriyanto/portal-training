<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Soft extends Model
{
    protected $table      = 'soft_competency';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_soft';
    protected $allowedFields = ['proficiency', '', 'soft'];

    public function getDataSoft()
    {
        $this->select();
        return $this->get()->getResultArray();
    }

    // public function getDataSoftDepartemen($departemen, $group)
    // {
    //     $this->select()->where('departemen', $departemen)->where('golongan', $group);
    //     return $this->get()->getResultArray();
    // }

    public function getSoftLastRow()
    {
        $this->select('id_soft');
        return $this->get()->getLastRow();
    }

    public function getAllIdSoft()
    {
        $this->select('id_soft');
        return $this->get()->getResultArray();
    }
}