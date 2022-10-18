<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Career extends Model
{
    protected $table      = 'career';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_career';
    protected $allowedFields = ['id_user', 'year_start', 'year_end', 'position', 'departemen', 'division', 'company'];
}