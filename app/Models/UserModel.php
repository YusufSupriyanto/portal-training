<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    // protected $useAutoIncrement = true;
    protected $allowedFields = [
        'npk', 'nama', 'status', 'dic',
        'divisi', 'departemen', 'seksi', 'bagian', 'username', 'password',
        'level', 'profile', 'email', 'tgl_masuk', 'tahun', 'bulan', 'golongan', 'promosi_terakhir'
    ];

    function get_data_login($username)
    {
        $this->where('username', $username);
        $data = $this->get()->getRow();
        return $data;
    }


    public function getAllUser($id = false)
    {
        if ($id == false) {
            $this->select()->where('level', 'USER');
            return $this->get()->getResult();
        }

        return $this->where(['id_user' => $id])->first();
    }


    public function filter($id)
    {
        $data = $this->getAllUser($id);

        if ($data['bagian'] == "BOD") {
            $this->select()->where('bagian', 'KADIV')->where('dic', $data['dic']);
            return $this->get()->getResult();
        } elseif ($data['bagian'] == "KADIV") {
            $this->select()->where('bagian', 'KADEPT')->where('divisi', $data['divisi']);
            return $this->get()->getResult();
        } elseif ($data['bagian']  == "KADEPT") {
            $bagian = ['KASIE', 'STAFF 4UP', 'STAFF'];
            $this->select()->whereIn('bagian', $bagian)->where('departemen', $data['departemen'])->where('level', 'USER');
            return $this->get()->getResult();
        } else {
            $this->select()->where('id_user', $id);
            return $this->get()->getResult();
        }
    }


    public function getDataKadept($departemen)
    {
        $this->select()->where('bagian', 'KADEPT')->where('departemen', $departemen);
        return $this->get()->getResultArray();
    }

    public function getDataKadiv($divisi)
    {
        $this->select()->where('bagian', 'KADIV')->where('divisi', $divisi);
        return $this->get()->getResultArray();
    }
    public function getDataBod($dic)
    {
        $this->select()->where('bagian', 'BOD')->where('dic', $dic);
        return $this->get()->getResultArray();
    }

    public function DistinctSeksi()
    {
        $this->select('seksi')->distinct();
        return $this->get()->getResultArray();
    }
    public function DistinctDic()
    {
        $this->select('dic')->distinct();
        return $this->get()->getResultArray();
    }
    public function DistinctDivisi()
    {
        $this->select('divisi')->distinct();
        return $this->get()->getResultArray();
    }
    public function DistinctDepartemen()
    {
        $this->select('departemen')->distinct();
        return $this->get()->getResultArray();
    }
    public function getLastUser()
    {
        $this->select('id_user');
        return $this->get()->getLastRow();
    }
    public function getIdUser()
    {
        $this->select('id_user');
        return $this->get()->getResultArray();
    }



    public function getUserAstra()
    {
        $seksi = ['RESEARCH & DEVELOPMENT', 'EXPERT PROCESS'];
        $bagian = ['STAFF 4UP'];
        $this->select()->whereNotIn('bagian', $bagian)->whereNotIn('seksi', $seksi);
        return $this->get()->getResultArray();
    }
    public function getUserTechnical($departemen)
    {
        $bagian = ['STAFF 4UP'];
        $this->select()->whereNotIn('bagian', $bagian)->where('departement', $departemen);
        return $this->get()->getResultArray();
    }



    function M_test()
    {
        $data = $this->get();
        return $data;
    }
}