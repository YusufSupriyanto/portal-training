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

    public function getDataTechnicalBDepartemenAdmin($departemen)
    {
        $this->select('technicalB')->where('department', $departemen)->Distinct();
        return $this->get()->getResultArray();
    }

    public function getDataTechnicalBDepartemen($departemen, $jabatan)
    {
        $this->select()->where('department', $departemen)->where('nama_jabatan', $jabatan)->Distinct();
        return $this->get()->getResultArray();
    }
    public function getDataTechnicalBJabatan($departemen)
    {
        $this->select('nama_jabatan')->where('department', $departemen)->Distinct();
        return $this->get()->getResultArray();
    }

    public function getDataValue($jabatan, $technical, $department)
    {
        return  $this->select()->where('nama_jabatan', $jabatan)->where('technicalB', $technical)->where('department', $department)->first();
    }

    public function getDataTechnicalByName($technicalB)
    {
        $this->select()->where('technicalB', $technicalB);
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

    public function getDataByDepartment($department)
    {
        $this->select()->where('department', $department);
        return $this->get()->getResultArray();
    }

    public function getDataByDepartmentSeksi($jabatan, $department)
    {
        $this->select()->where('department', $department)->where('nama_jabatan', $jabatan);
        return $this->get()->getResultArray();
    }
}