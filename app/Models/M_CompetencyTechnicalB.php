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
        $this->select()->where('competency_profile_technicalB.id_user', $id);
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB');
        return $this->get()->getResultArray();
    }

    public function getProfileTechnicalCompetencyBValue($id, $technical)
    {
        $this->select()->where('competency_profile_technicalB.id_user', $id);
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB')->where('competency_technicalB.technicalB', $technical);
        return $this->get()->getResultArray();
    }

    public function getProfileTechnicalCompetencyBWithDepartment($id, $department)
    {
        $this->select()->where('id_user', $id)->where('department', $department);
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB');
        return $this->get()->getResultArray();
    }

    public function getTechnicalByIdCompetencyB($id)
    {
        $this->select()->where('id_competency_technicalB', $id);
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB');
        return $this->get()->getResultArray();
    }

    public function getTechnicalByIdCompetencyBValue($id, $technical)
    {
        $this->select()->where('id_competency_technicalB', $id);
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB')->where('technical', $technical);
        return $this->get()->getResultArray();
    }

    public function getProfileTechnicalCompetencyBDistinct($id)
    {
        $this->select('competency_technicalB.department')->where('id_user', $id)->distinct();
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB');
        return $this->get()->getResultArray();
    }
    public function getProfileTechnicalCompetencyBDepartment($id, $department)
    {
        $this->select()->where('id_user', $id)->where('competency_technicalB.department', $department);
        $this->join('competency_technicalB', 'competency_technicalB.id_technicalB =competency_profile_technicalB.id_technicalB');
        return $this->get()->getResultArray();
    }
}