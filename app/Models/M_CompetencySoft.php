<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompetencySoft extends Model
{
    protected $table      = 'competency_profile_soft';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_competency_soft';
    protected $allowedFields = ['id_user', 'id_soft', 'score_soft'];


    public function getIdSoft($id)
    {
        return $this->where(['id_soft' => $id])->first();
    }

    public function getProfileSoftCompetency($id)
    {

        $this->select('soft_competency.soft,soft_competency.proficiency,competency_profile_soft.id_competency_soft,competency_profile_soft.score_soft')->where('competency_profile_soft.id_user', $id);
        $this->join('soft_competency', 'soft_competency.id_soft = competency_profile_soft.id_soft');
        return $this->get()->getResultArray();
    }
}