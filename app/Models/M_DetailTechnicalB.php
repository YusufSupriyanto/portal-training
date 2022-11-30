<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DetailTechnicalB extends Model
{
    protected $table      = 'detail_technicalB';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_detail_technicalB';
    protected $allowedFields = ['id_technicalB', 'id_training'];
}