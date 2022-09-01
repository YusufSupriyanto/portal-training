<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Approval extends Model
{
    protected $table      = 'approval';
    // protected $useAutoIncrement = true;
    protected $allowedFields = ['id_tna', 'id_user', 'status_approval_1', 'status_approval_2', 'status_approval_3', 'alasan', 'tanggal', 'approve_1', 'approve_2', 'approval_3'];
}