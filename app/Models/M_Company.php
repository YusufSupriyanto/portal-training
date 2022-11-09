<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Company extends Model
{
    protected $table      = 'company_competency';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_company';
    protected $allowedFields = ['proficiency', 'company', 'divisi'];

    public function getDataCompany()
    {
        $this->select();
        return $this->get()->getResultArray();
    }

    public function getDataCompanyDivisi($divisi)
    {
        $this->select()->where('divisi', $divisi);
        return $this->get()->getResultArray();
    }

    public function getCompanyLastRow()
    {
        $this->select('id_company');
        return $this->get()->getLastRow();
    }
}