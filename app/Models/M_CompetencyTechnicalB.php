<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompetencyTechnicalB extends Model
{
    protected $table      = 'competency_profile_technicalB';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_competency_technicalB';
    protected $allowedFields = ['id_user', 'id_technicalB', 'score'];

    public function getProfileTechnicalCompetencyB($id)
    {
        $this->select()->where('id_user', $id);
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB');
        return $this->get()->getResultArray();
    }

    public function getTechnicalByIdCompetencyB($id)
    {
        $this->select()->where('id_competency_technicalB', $id);
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB');
        return $this->get()->getResultArray();
    }
}