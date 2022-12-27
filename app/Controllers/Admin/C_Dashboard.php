<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\M_Contact;
use App\Models\M_ListTraining;
use App\Models\M_Tna;

class C_Dashboard extends BaseController
{
    public M_ListTraining $training;

    private M_Tna $tna;
    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->tna = new M_Tna();
    }

    public function index()
    {
        $data = [
            'tittle' => 'Dashboard',
            'Jenis_training' => $this->JenisTrainingDashboard(),
            'category' => $this->CategoryDashboard()
        ];
        return view('admin/dashboard', $data);
    }


    public function JenisTrainingDashboard()
    {
        $jenis = $this->tna->getJenisTraining();
        $JenisTrainings = [];

        foreach ($jenis as $Jenis) {
            $count = $this->tna->CountJenisTraining($Jenis->jenis_training, date('Y'));
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            $JenisTraining = [
                'name' => $Jenis->jenis_training,
                'y' => $count[0]->jenis_training,
                'color' => "rgb($r , $g , $b)"
            ];
            array_push($JenisTrainings, $JenisTraining);
        }
        return $JenisTrainings;
    }

    public function CategoryDashboard()
    {
        $categories = $this->tna->getCategory();
        $category = [];
        foreach ($categories as $Categories) {
            $count = $this->tna->CountCategory($Categories->kategori_training, date('Y'));
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            $categori = [
                'name' => $Categories->kategori_training,
                'y' => $count[0]->kategori_training,
                'color' => "rgb($r , $g , $b)"
            ];

            array_push($category, $categori);
        }
        return $category;
    }
}