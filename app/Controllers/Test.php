<?php

namespace App\Controllers;

use App\Controllers\User\FormTna;
use App\Models\M_Categories;
use App\Models\M_CompetencyTechnical;
use App\Models\M_CompetencyTechnicalB;
use App\Models\M_ListTraining;
use App\Models\UserModel;


class Test extends BaseController
{
    private UserModel $userModel;
    private M_ListTraining $training;

    private M_Categories $category;

    private FormTna $tna;

    private M_CompetencyTechnical $competencyTechnical;

    private M_CompetencyTechnicalB $competencyTechnicalB;

    private UserModel $user;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->training = new M_ListTraining();
        $this->category = new M_Categories();
        $this->tna = new FormTna();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->user = new UserModel();
        $this->competencyTechnicalB = new M_CompetencyTechnicalB();
    }
    public function test()
    {
        // $value = $this->userModel->M_test();
        $id = 11754;
        $dept  = $this->competencyTechnical->getProfileTechnicalCompetency($id);
        //  $dept = $this->competencyTechnicalB->getProfileTechnicalCompetencyBDistinct($id);
        $department = $this->competencyTechnical->getProfileTechnicalCompetency($id);

        // foreach ($comp0 as $comp1) {

        //     $data1[] = $comp1['technical'];
        // }

        // foreach ($comp2 as $comp3) {
        //     $data2[] = $comp3['technical'];
        // }

        // $data = array_intersect($data1, $data2);
        //$user = $this->user->getAllUser($id);
        // $department = [];
        // $test = [
        //     'departemen' => $user['departemen']
        // ];
        // array_push($department, $test);
        $data = [];
        for ($i = 0; $i < count($department); $i++) {
            foreach ($dept as  $values) {
                if (in_array($values['technical'], $department[$i])) {
                    $value = [
                        'technica' => $values['technical']
                    ];
                    array_push($data, $value);
                }
            }
        }

        dd($data);
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