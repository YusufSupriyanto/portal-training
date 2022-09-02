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
            $this->select();
            return $this->get()->getResult();
        }
        return $this->where(['id_tna' => $id])->get()->getResult();
    }
    public function getAllSave($id = false)
    {
        if ($id == false) {
            $this->select()->where('status', 'save');
            return $this->get()->getResult();
        }
        return $this->where(['id_tna' => $id])->get()->getResult();
    }

    public function getUserTna($id)
    {
        $this->select()->where(['id_user' => $id]);
        return $this->get()->getResult();
    }

    public function getTnaFilter($id)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select()->where('departemen', $user['departemen'])->where('status', 'save');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select()->where('departemen', $user['departemen'])->where('status', 'save');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $this->select()->where('departemen', $user['departemen'])->where('status', 'save');
            return $this->get()->getResult();
        } else {
            $this->select()->where('id_user', $user['id_user'])->where('status', 'save');
            return $this->get()->getResult();
        }
    }


    public function getStatusWaitAdmin()
    {
        $this->select()->where('status', 'wait');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        return $this->get()->getResult();
    }

    public function getStatusWaitUser($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $status = ['wait', 'accept'];
            $this->select()->where('dic', $member)->whereIn('status', $status);
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $status = ['wait', 'accept'];
            $this->select()->where('divisi', $member)->whereIn('status', $status);
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $status = ['wait', 'accept'];
            $this->select()->where('departemen', $member)->whereIn('status', $status);
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }

        // $status = ['wait', 'accept'];
        // $this->select()->whereIn('status', $status);
        // return $this->get()->getResultArray();
    }


    //function untuk menampilkan data tna yang sudah di accept
    public function getKadivStatus()
    {
        $this->select()->where('status', 'accept');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', null)->orWhere('status_approval_1', 'reject');
        return $this->get()->getResultArray();
    }


    //function get Request Tna
    public function getRequestTna($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $status = ['wait', 'accept'];
            $this->select()->where('dic', $member)->whereIn('status', $status);
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $status = [null, 'reject'];
            $this->select()->where('divisi', $member)->where('status', 'accept');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', null);
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $status = [null, 'reject'];
            $this->select()->where('departemen', $member)->where('status', 'accept')->whereIn('status_approval_1', $status);
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }
    }



    public function getIdTna()
    {
        $this->select();
        return $this->get()->getLastRow();
    }

    // public function sendAdmin($id)
    // {
    //     for ($i = 0; $i > count($id); $i++) {
    //     }
    //     $this->getAllTna($id);
    // }
}