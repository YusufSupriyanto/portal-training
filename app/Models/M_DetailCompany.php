<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DetailCompany extends Model
{
    protected $table      = 'detail_company';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_detail_company';
    protected $allowedFields = ['id_company', 'id_training'];
}