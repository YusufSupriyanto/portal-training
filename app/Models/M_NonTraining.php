<?php

namespace App\Models;

use CodeIgniter\Model;

class M_NonTraining extends Model
{
    protected $table      = 'non_training';
    protected $primaryKey = 'id_nontraining';
    // protected $useAutoIncrement = true;
    protected $allowedFields = ['category', 'method', 'description', 'evaluasi'];


    public function getCategory()
    {
        $this->select('category,description')->distinct();
        return $this->get()->getResult();
    }


    public  function getList($category)
    {
        $list =  $this->select()->where('category', $category)->get();
        return $list->getResult();
    }
}