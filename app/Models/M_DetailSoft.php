<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DetailSoft extends Model
{
    protected $table      = 'detail_soft';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_detail_soft';
    protected $allowedFields = ['id_soft', 'id_training'];
}