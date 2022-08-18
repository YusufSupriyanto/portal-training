<?php

namespace App\Controllers;

use App\Models\M_ListTraining;
use App\Models\UserModel;


class Test extends BaseController
{
    private UserModel $userModel;
    private M_ListTraining $training;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->training = new M_ListTraining();
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
        $data = $this->training->getCategory();
        dd($data);
    }
}