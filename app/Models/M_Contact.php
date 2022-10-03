<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Contact extends Model
{
    protected $table      = 'contact';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_contact';
    protected $allowedFields = ['nama', 'email', 'pesan'];


    public function getDataContact()
    {
        $this->select();
        $query = $this->get()->getResultArray();
        return $query;
    }
}