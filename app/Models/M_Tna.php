<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPSQLParser\Test\Creator\count_distinctTest;

class M_Tna extends Model
{
    protected $table      = 'tna';
    protected $primaryKey = 'id_tna';
    // protected $useAutoIncrement = true;
    protected $allowedFields = ['id_user', 'id_training', 'dic', 'divisi', 'departemen', 'nama', 'jabatan', 'golongan', 'seksi', 'jenis_training', 'kategori_training', 'training', 'metode_training', 'rencana_training', 'tujuan_training', 'notes', 'biaya', 'biaya_actual', 'status'];


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
        return $this->where('id_tna', $id)->get()->getResult();
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
            $this->select()->where('dic', $user['dic'])->where('status', 'save');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select()->where('divisi', $user['divisi'])->where('status', 'save');
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
            $this->select('tna.*,approval.*,user.bagian')->where('tna.dic', $member)->whereIn('tna.status', $status);
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $jabatan = ['KADIV'];
            $status = ['wait', 'accept'];
            $this->select('tna.*,approval.*,user.bagian')->where('tna.divisi', $member)->whereIn('tna.status', $status);
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $status = ['wait', 'accept'];
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('tna.departemen', $member)->whereIn('tna.status', $status);
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }
    }


    //function untuk menampilkan data tna yang sudah di accept
    public function getKadivStatus()
    {
        $this->select()->where('status', 'accept');
        $this->join('approval', 'approval.id_tna = tna.id_tna'); //->where('status_approval_1', null)->orWhere('status_approval_1', 'reject')
        return $this->get()->getResultArray();
    }


    //function get Request Tna
    public function getRequestTna($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select()->where('dic', $member)->where('status', 'accept')->where('status_approval_1', 'accept')->where('status_approval_2', 'accept')->where('status_approval_3', null);
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


    public function getKadivAccept($date)
    {
        $this->select()->where('status', 'accept')->where('rencana_training', $date);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'accept');
        return $this->get()->getResultArray();
    }

    public function getIdTna()
    {
        $this->select();
        return $this->get()->getLastRow();
    }

    public function getDetailReject($id)
    {
        $this->select('tna.*,approval.*,user.bagian')->where('tna.id_tna', $id);
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getDateTraining()
    {
        $this->select('tna.rencana_training,tna.training,approval.status_approval_1,approval.status_approval_2,approval.status_approval_3')->distinct();
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        return $this->get()->getResult();
    }


    // public function getDateTraining()
    // {
    //     $this->select('rencana_training, Count(training) as jumlah')->distinct();
    //     $this->join('approval', 'approval.id_tna = tna.id_tna');
    //     return $this->get()->getResult();
    // }

    // S

    // public function getJumlahTraining($date)
    // {
    //     $this->selectCount('training')->distinct()->where('rencana_training', $date);
    //     $this->join('approval', 'approval.id_tna = tna.id_tna');
    //     return $this->get()->getResult();
    // }


    public function getJumlahTraining($date)
    {
        $this->select('training')->distinct('training')->where('rencana_training', $date);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'accept');
        return $this->get()->getResultArray();
    }

    public function getTrainingDitolak()
    {
        $this->select();
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'reject')->orWhere('status_approval_2', 'reject')->orWhere('status_approval_3', 'reject');
        return $this->get()->getResultArray();
    }
}