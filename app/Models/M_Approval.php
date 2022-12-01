<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Approval extends Model
{
    protected $table      = 'approval';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_approval';
    protected $allowedFields = ['id_tna', 'id_user', 'status_approval_0', 'status_approval_1', 'status_approval_2', 'status_approval_3', 'alasan', 'tanggal', 'status_training'];


    public function getIdApproval($id)
    {
        return $this->where(['id_tna' => $id])->first();
    }

    public function getTrainingNotImplemented()
    {
        $this->select()->where('status_training', 0);
        $this->join('tna', 'tna.id_tna = approval.id_tna');
        return $this->get()->getResultArray();
    }
}