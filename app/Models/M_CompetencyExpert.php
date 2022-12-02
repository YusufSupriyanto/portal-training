<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompetencyExpert extends Model
{
    protected $table      = 'competency_profile_expert';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_competency_expert';
    protected $allowedFields = ['id_user', 'id_expert', 'score_expert'];


    public function getIdExpert($id)
    {
        return $this->where(['id_user' => $id])->first();
    }

    public function getProfileExpertCompetency($id)
    {

        $this->select('expert_competency.expert,expert_competency.proficiency,competency_profile_expert.id_competency_expert,competency_profile_expert.score_expert')->where('competency_profile_expert.id_user', $id);
        $this->join('expert_competency', 'expert_competency.id_expert = competency_profile_expert.id_expert');
        return $this->get()->getResultArray();
    }

    public function getExpertByIdCompetency($id)
    {

        $this->select('expert_competency.expert,expert_competency.proficiency,competency_profile_expert.id_competency_expert,competency_profile_expert.score_expert')->where('competency_profile_expert.id_competency_expert', $id);
        $this->join('expert_competency', 'expert_competency.id_expert = competency_profile_expert.id_expert');
        return $this->get()->getResultArray();
    }
}