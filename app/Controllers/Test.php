<?php

namespace App\Controllers;

use App\Controllers\User\FormTna;
use App\Models\M_Categories;
use App\Models\M_CompetencyTechnical;
use App\Models\M_ListTraining;
use App\Models\UserModel;


class Test extends BaseController
{
    private UserModel $userModel;
    private M_ListTraining $training;

    private M_Categories $category;

    private FormTna $tna;

    private M_CompetencyTechnical $competencyTechnical;

    private UserModel $user;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->training = new M_ListTraining();
        $this->category = new M_Categories();
        $this->tna = new FormTna();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->user = new UserModel();
    }
    public function test()
    {
        // $value = $this->userModel->M_test();
        $id = 11754;
        // $dept = $this->competencyTechnical->getProfileTechnicalCompetencyDepartment($id);

        $dept = $this->competencyTechnical->getProfileTechnicalCompetencyDepartment($id);
        $user = $this->user->getAllUser($id);
        $department = [];
        $test = [
            'departemen' => $user['departemen']
        ];
        array_push($department, $test);
        for ($i = 0; $i < count($department); $i++) {
            foreach ($dept as $key => $values) {
                if (in_array($values['departemen'], $department[$i])) {
                    unset($dept[$key]);
                }
            }
        }

        dd($dept);
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


    // public function testAjaxTna()
    // {
    //     $this

    // }
}