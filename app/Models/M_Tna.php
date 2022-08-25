<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Tna extends Model
{
    protected $table      = 'tna';
    protected $primaryKey = 'id_tna';
    // protected $useAutoIncrement = true;
    protected $allowedFields = ['id_user', 'id_training', 'divisi', 'departemen', 'nama', 'jabatan', 'golongan', 'seksi', 'jenis_training', 'kategori_training', 'trainig', 'metode_training', 'rencana_training', 'tujuan_training', 'notes', 'biaya', 'status'];
}