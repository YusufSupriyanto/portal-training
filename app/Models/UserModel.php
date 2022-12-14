<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPSQLParser\Test\Creator\functionTest;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    // protected $useAutoIncrement = true;
    protected $allowedFields = [
        'npk', 'nama', 'status', 'dic',
        'divisi', 'departemen', 'seksi', 'bagian', 'nama_jabatan', 'type_golongan', 'username', 'password',
        'level', 'profile', 'email', 'tgl_masuk', 'tahun', 'bulan', 'golongan', 'promosi_terakhir', 'type_user'
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
        } elseif ($data['bagian']  == "KASIE" || $data['bagian']  == "STAFF 4UP") {
            $bagian = ['STAFF 4UP', 'KASIE'];
            $this->select()->where('seksi', $data['seksi'])->where('level', 'USER')->whereNotIn('bagian', $bagian);
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
    public function DistinctJabatan()
    {
        $this->select('nama_jabatan')->distinct();
        return $this->get()->getResultArray();
    }
    public function DistinctBagian()
    {
        $this->select('bagian')->distinct();
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
        $bagian = ['BOD', 'KADIV', 'KADEPT', 'KASIE', 'STAFF 4UP'];
        $this->select('nama,id_user')->whereIn('bagian', $bagian)->where('type_user', 'REGULAR')->where('type_golongan', 'A         ')->where('level', 'USER');
        $this->orderBy('nama', 'ASC');
        return $this->get()->getResultArray();
    }


    public function getUserExpert()
    {
        $this->select('nama,id_user')->where('type_user', 'EXPERT')->where('bagian', 'STAFF 4UP')->where('type_golongan', 'A         ')->where('level', 'USER');
        return $this->get()->getResultArray();
    }
    public function getUserTechnicalA($departemen)
    {
        $this->select('nama,id_user')->where('departemen', $departemen)->where('level', 'USER')->where('type_golongan', 'A         ');
        return $this->get()->getResultArray();
    }

    public function getUserTechnicalB($jabatan, $departemen)
    {
        $this->select('nama,id_user')->where('nama_jabatan', $jabatan)->where('departemen', $departemen)->where('level', 'USER')->where('type_golongan', 'B');
        return $this->get()->getResultArray();
    }


    public function getGroupB()
    {
        $this->select()->where('type_golongan', 'B        ');
        return $this->get()->getResultArray();
    }

    public function getUserDivisi($divisi)
    {
        $this->select('nama,id_user')->where('divisi', $divisi)->where('level', 'USER')->where('type_golongan', 'B        ');
        return $this->get()->getResultArray();
    }

    public function getUserBagian()
    {
        $this->select('bagian')->distinct();
        return $this->get()->getResultArray();
    }

    public function getUserJabatan()
    {
        $this->select('nama_jabatan')->distinct();
        return $this->get()->getResultArray();
    }


    public function getJabatanInUser($department)
    {
        $this->select('nama_jabatan')->where('departemen', $department)->where('type_golongan', 'B')->distinct();
        return $this->get()->getResultArray();
    }

    public function getUserByDepartment($department)
    {
        $this->select()->where('departemen', $department)->where('type_golongan', 'B');
        return $this->get()->getResultArray();
    }


    function M_test()
    {
        $data = $this->get();
        return $data;
    }
    public function getDataByDic($dic)
    {
        $this->select('id_user,npk,nama,dic')->where('dic', $dic);
        return $this->get()->getResultArray();
    }
    public function getDataByDivisi($divisi)
    {
        $this->select('id_user,npk,nama,divisi')->where('divisi', $divisi);
        return $this->get()->getResultArray();
    }
    public function getDataByDepartment($department)
    {
        $this->select('id_user,npk,nama,departemen')->where('departemen', $department);
        return $this->get()->getResultArray();
    }
    public function getDataBySeksi($seksi)
    {
        $this->select('id_user,npk,nama,seksi')->where('seksi', $seksi);
        return $this->get()->getResultArray();
    }
}