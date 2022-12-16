<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompetencyAstra extends Model
{
    protected $table      = 'competency_profile_astra';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_competency_astra';
    protected $allowedFields = ['id_user', 'id_astra', 'score_astra'];


    public function getIdAstra($id)
    {
        return $this->where(['id_tna' => $id])->first();
    }

    public function getProfileAstraCompetency($id)
    {

        $this->select('astra_competency.astra,astra_competency.proficiency,competency_profile_astra.id_competency_astra,competency_profile_astra.score_astra')->where('competency_profile_astra.id_user', $id);
        $this->join('astra_competency', 'astra_competency.id_astra = competency_profile_astra.id_astra');
        return $this->get()->getResultArray();
    }
    public function getAstraByIdCompetency($id)
    {
        $this->select('astra_competency.astra,astra_competency.proficiency,competency_profile_astra.id_competency_astra,competency_profile_astra.score_astra')->where('competency_profile_astra.id_competency_astra', $id);
        $this->join('astra_competency', 'astra_competency.id_astra = competency_profile_astra.id_astra');
        return $this->get()->getResultArray();
    }
    public function getAstraIdCompetency($id)
    {
        $this->select('competency_profile_astra.id_astra')->where('competency_profile_astra.id_user', $id);
        $this->join('astra_competency', 'astra_competency.id_astra = competency_profile_astra.id_astra');
        return $this->get()->getResultArray();
    }
}