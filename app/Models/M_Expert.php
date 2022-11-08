<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Expert extends Model
{
    protected $table      = 'expert_competency';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_expert';
    protected $allowedFields = ['proficiency', 'expert'];


    public function getIdExpert($id)
    {
        return $this->where(['id_user' => $id])->first();
    }

    public function getDataExpert()
    {
        $this->select();
        return $this->get()->getResultArray();
    }
    public function getAllIdExpert()
    {
        $this->select('id_expert');
        return $this->get()->getResultArray();
    }


    public function getExpertLastRow()
    {
        $this->select('id_expert');
        return $this->get()->getLastRow();
    }
}