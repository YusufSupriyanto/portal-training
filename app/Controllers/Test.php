<?php

namespace App\Controllers;

use App\Models\M_Categories;
use App\Models\M_ListTraining;
use App\Models\UserModel;


class Test extends BaseController
{
    private UserModel $userModel;
    private M_ListTraining $training;

    private M_Categories $category;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->training = new M_ListTraining();
        $this->category = new M_Categories();
    }
    public function test()
    {
        $value = $this->userModel->M_test();
        var_dump($value);
    }

    public function testGetListTraining($category = 'Cultural Training')
    {
        $data = $this->training->getList($category);
        dd($data);
    }

    public function getCategories()
    {
        $data = $this->category->getAllCategory();
        dd($data);
    }


    public function alls()
    {
        // $data =  $this->training->
    }
}