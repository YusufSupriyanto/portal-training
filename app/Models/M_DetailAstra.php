<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DetailAstra extends Model
{
    protected $table      = 'detail_astra';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_detail_astra';
    protected $allowedFields = ['id_astra', 'id_training'];


    public function getCheckIdTraining($id_training, $id_astra)
    {
        return $this->select()->where('id_training', $id_training)->where('id_astra', $id_astra)->first();
    }
}