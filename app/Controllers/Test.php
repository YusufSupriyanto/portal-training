<?php

namespace App\Controllers;

use App\Controllers\User\FormTna;
use App\Models\M_Categories;
use App\Models\M_CompetencyTechnical;
use App\Models\M_CompetencyTechnicalB;
use App\Models\M_ListTraining;
use App\Models\M_Technical;
use App\Models\M_Tna;
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

    private M_Technical $technical;

    private M_Tna $Tna;



    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->training = new M_ListTraining();
        $this->category = new M_Categories();
        $this->tna = new FormTna();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->user = new UserModel();
        $this->competencyTechnicalB = new M_CompetencyTechnicalB();
        $this->technical = new M_Technical();

        $this->Tna = new M_Tna();
    }
    public function test()
    {
        // $value = $this->userModel->M_test();
        $id = 11754;
        $dept  = $this->competencyTechnical->getProfileTechnicalCompetency($id);
        //  $dept = $this->competencyTechnicalB->getProfileTechnicalCompetencyBDistinct($id);
        //  $department = $this->competencyTechnical->getProfileTechnicalCompetency($id);

        $department = $this->technical->getDataTechnicalDepartemen('PRODUCT ENGINEERING');

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
                        'id_technical' => $department[$i]['id_technical'],
                        'id_user' => $id,
                        'technical' => $values['technical'],
                        'proficiency' => $department[$i]['proficiency'],
                        'score_technical' => $values['score_technical']
                    ];
                    array_push($data, $value);
                }
            }
        }

        // $arraySelf = [
        //     array(1, 2, 3, 4),
        //     array(5, 6, 7, 8),
        // ];

        // $array1 = [
        //     array(1, 10, 11, 12),
        //     array(3, 14, 15, 16),
        // ];
        // $array2 = [
        //     array(1, 17, 18, 19),
        //     array(20, 21, 22, 23),
        // ];
        // $arrayFix = array_merge($array1, $array2);

        // foreach ($arrayFix as $number) {
        //     d($number[0]);
        // }
        // for ($i = 0; $i < count($arrayFix); $i++) {
        //     foreach ($arraySelf as $key => $values) {
        //         if (in_array($values[0], $arrayFix[$i])) {
        //             $value[] = [
        //                 $arraySelf[$key],
        //             ];
        //         }
        //     }
        // }
        $try = array_map("unserialize", array_unique(array_map("serialize", $value)));
        //  $try = $value;

        // foreach ($try as $key => $value) {
        //     foreach ($value as $values) {
        //         d($values);
        //     }
        // }


        dd($data);
    }



    public function test1()
    {
        $jenis = $this->Tna->getJenisTraining();
        $JenisTrainings = [];
        foreach ($jenis as $Jenis) {
            $count = $this->Tna->CountJenisTraining($Jenis->jenis_training, date('Y'));

            $JenisTraining = [
                'name' => $Jenis->jenis_training,
                'y' => $count[0]->jenis_training
            ];

            array_push($JenisTrainings, $JenisTraining);
        }
        dd($JenisTrainings);
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