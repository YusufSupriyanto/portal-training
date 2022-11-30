<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DetailTechnical extends Model
{
    protected $table      = 'detail_technical';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_detail_technical';
    protected $allowedFields = ['id_technical', 'id_training'];
}