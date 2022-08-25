<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Categories;
use App\Models\M_ListTraining;

class ListTraining extends BaseController
{

    private M_Categories $category;
    private M_ListTraining $training;

    public function __construct()
    {
        $this->category = new M_Categories();
        $this->training = new M_ListTraining();
    }
    public function index()
    {
        $get = $this->category->getTrainingCategory();

        $data = [
            'tittle' => 'List Training',
            'jenis' => $get,
        ];
        return view('user/listtraininguser', $data);
    }

    public function nonTrainingUser()
    {
        $get =  $this->category->getNonTrainingCategory();
        $data = [
            'tittle' => 'Non Training',
            'jenis' => $get,
        ];
        return view('user/nontraininguser', $data);
    }

    public function detail($category)
    {
        $categories = $this->training->getList($category);
        $data = [
            'tittle' => 'List Training',
            'jenis' => $categories,
        ];
        return view('user/detailtraininguser', $data);
    }
}