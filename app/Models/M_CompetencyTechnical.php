<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompetencyTechnical extends Model
{
    protected $table      = 'competency_profile_technical';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_competency_technical';
    protected $allowedFields = ['id_user', 'id_technical', 'score_technical'];


    public function getIdAstra($id)
    {
        return $this->where(['id_tna' => $id])->first();
    }

    public function getProfileTechnicalCompetency($id)
    {
        $this->select('technical_competency.technical,technical_competency.proficiency,competency_profile_technical.id_competency_technical,competency_profile_technical.score_technical')->where('competency_profile_technical.id_user', $id);
        $this->join('technical_competency', 'technical_competency.id_technical = competency_profile_technical.id_technical');
        return $this->get()->getResultArray();
    }


    public function getDataDepertemenA()
    {
        $this->select('technical_competency.departemen,technical_competency.golongan')->distinct();
        $this->join('technical_competency', 'technical_competency.id_technical = competency_profile_technical.id_technical');
        return $this->get()->getResultArray();
    }
    public function getDataDepertemenB()
    {
        $this->select('technical_competency.departemen,technical_competency.golongan')->distinct();
        $this->join('technical_competency', 'technical_competency.id_technical = competency_profile_technical.id_technical')->where('technical_competency.golongan', 'B');
        return $this->get()->getResultArray();
    }
}