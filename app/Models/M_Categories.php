<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Categories extends Model
{
    protected $table      = 'Categories';
    protected $primaryKey = 'id_categories';
    // protected $useAutoIncrement = true;
    protected $allowedFields = ['list', 'category', 'deskripsi', 'path'];


    public function getIdCategories($id)
    {
        return $this->where(['id_categories' => $id])->first();
    }

    public function getTrainingCategory()
    {
        $data = $this->select('id_categories,category,deskripsi,path')->where('list', 'Training')->get();
        return $data->getResult();
    }

    public function getNonTrainingCategory()
    {
        $data = $this->select('id_categories,category,deskripsi,path')->where('list', 'Non Training')->get();
        return $data->getResult();
    }

    public function getEditCategory($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_categories' => $id])->first();
    }
}