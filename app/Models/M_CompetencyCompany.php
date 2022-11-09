<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompetencyCompany extends Model
{
    protected $table      = 'competency_profile_company';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_competency_company';
    protected $allowedFields = ['id_user', 'id_company', 'score_company'];


    public function getIdCompany($id)
    {
        return $this->where(['id_company' => $id])->first();
    }

    public function getProfileCompanyCompetency($id)
    {

        $this->select('company_competency.company,company_competency.proficiency,competency_profile_company.id_competency_company,competency_profile_company.score_company')->where('competency_profile_company.id_user', $id);
        $this->join('company_competency', 'company_competency.id_company = competency_profile_company.id_company');
        return $this->get()->getResultArray();
    }

    public function getDataDivisi()
    {
        $this->select('company_competency.divisi')->distinct();
        $this->join('company_competency', 'company_competency.id_company = competency_profile_company.id_company');
        return $this->get()->getResultArray();
    }
}