<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Stmt\Return_;

class UserModel extends Model
{

    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    // protected $useAutoIncrement = true;
    protected $allowedFields = ['npk', 'nama', 'status', 'divisi', 'departemen', 'seksi', 'bagian', 'username', 'password', 'level'];

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


    public function filter($bagian, $departemen = false)
    {
        if ($bagian == "BOD") {
            $this->select()->where('bagian', 'KADEPT');
            return $this->get()->getResult();
        }
    }

    function M_test()
    {
        $data = $this->get();
        return $data;
    }
}