<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Tna extends Model
{
    protected $table      = 'tna';
    protected $primaryKey = 'id_tna';
    // protected $useAutoIncrement = true;
    protected $allowedFields = ['id_user', 'id_training', 'divisi', 'departemen', 'nama', 'jabatan', 'golongan', 'seksi', 'jenis_training', 'kategori_training', 'training', 'metode_training', 'rencana_training', 'tujuan_training', 'notes', 'biaya', 'status'];


    private UserModel $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function getAllTna($id = false)
    {
        if ($id == false) {
            $this->select()->where('status', 'save');
            return $this->get()->getResult();
        }
        return $this->where(['id_user' => $id])->get()->getResult();
    }

    public function getTnaFilter($id)
    {
        $user = $this->getAllTna($id);
        return $user;


        // if ($user['bagian'] == 'BOD') {
        // }
    }


    public function sendAdmin($id)
    {
        for ($i = 0; $i > count($id); $i++) {
        }
        $this->getAllTna($id);
    }
}