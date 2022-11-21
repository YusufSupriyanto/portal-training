<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CompetencyTechnicalB extends Model
{
    protected $table      = 'competency_profile_technicalB';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_competency_technicalB';
    protected $allowedFields = ['id_user', 'id_technicalB', 'score'];
}