<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Astra extends Model
{
    protected $table      = 'astra_competency';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_astra';
    protected $allowedFields = ['proficiency', '', 'astra'];


    public function getIdAstra($id)
    {
        return $this->where(['id_tna' => $id])->first();
    }

    public function getDataAstra()
    {
        $this->select();
        return $this->get()->getResultArray();
    }
    public function getAllIdAstra()
    {
        $this->select('id_astra');
        return $this->get()->getResultArray();
    }


    public function getAstraLastRow()
    {
        $this->select('id_astra');
        return $this->get()->getLastRow();
    }
}