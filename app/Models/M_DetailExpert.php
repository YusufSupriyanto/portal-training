<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DetailExpert extends Model
{
    protected $table      = 'detail_expert';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_detail_expert';
    protected $allowedFields = ['id_expert', 'id_training'];

    public function getCheckIdTraining($id)
    {
        return $this->select()->where('id_training', $id)->first();
    }
}