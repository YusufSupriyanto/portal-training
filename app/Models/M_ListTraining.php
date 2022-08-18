<?php

namespace App\Models;

use CodeIgniter\Model;

class M_ListTraining extends Model
{

    protected $table      = 'training';
    protected $primaryKey = 'id_training';
    // protected $useAutoIncrement = true;
    protected $allowedFields = ['judul_training', 'jenis_training', 'deskripsi', 'vendor', 'biaya'];

    function M_test()
    {
        $data = $this->get();
        return $data;
    }


    public function getCategory()
    {
        $this->select('jenis_training')->distinct();
        $query =  $this->get()->getResult();
        return $query;
    }

    public  function getList($category)
    {
        $list =  $this->select()->where('jenis_training', $category);
        return $list->get()->getResult();
    }
}