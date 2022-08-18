<?php

namespace App\Models;

use CodeIgniter\Model;

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

    function M_test()
    {
        $data = $this->get();
        return $data;
    }
}