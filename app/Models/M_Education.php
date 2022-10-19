<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Education extends Model
{
    protected $table      = 'education';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_education';
    protected $allowedFields = ['id_user', 'grade', 'year', 'institution', 'major'];

    public function getIdEducation($id)
    {
        return $this->where(['id_education' => $id])->first();
    }

    public function getDataEducation($id)
    {
        $this->select()->where('id_user', $id);
        return $this->get()->getResultArray();
    }
}