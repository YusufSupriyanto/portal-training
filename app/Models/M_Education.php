<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Education extends Model
{
    protected $table      = 'education';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_education';
    protected $allowedFields = ['id_user', 'grade', 'year', 'institution', 'major'];
}