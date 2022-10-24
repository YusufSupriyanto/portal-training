<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Career extends Model
{
    protected $table      = 'career';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_career';
    protected $allowedFields = ['id_user', 'year_start', 'year_end', 'position', 'departement', 'division', 'company'];
    public function getIdCareer($id)
    {
        return $this->where(['id_user' => $id])->first();
    }
    public function getDataCareer($id)
    {
        $this->select()->where('id_user', $id);
        return $this->get()->getResultArray();
    }
}