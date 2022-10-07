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
        $this->select('jenis_training,deskripsi')->distinct();
        return $this->get()->getResult();
    }


    public  function getList($category)
    {
        $list =  $this->select()->where('jenis_training', $category)->get();
        return $list->getResult();
    }


    public function getAll()
    {
        $data = $this->select('*')->get();
        return $data->getResult();
    }


    public function getTna($judul_training)
    {
        $this->select()->where('judul_training', $judul_training);
        return $this->get()->getResult();
    }

    public function getIdTraining($id = false)
    {

        return $this->where(['id_training' => $id])->first();
    }

    // public function getDataIdTraining($training)
    // {
    //     $this->select('id_training')->like('judul_training', urlDecode($training));
    //     $this->get()->getResultArray();
    // }
}