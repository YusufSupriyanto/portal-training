<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Tna;

class Home extends BaseController
{

    private M_Tna $tna;
    public function __construct()
    {
        $this->tna = new M_Tna();
    }
    public function index()
    {

        $data = [
            'tittle' => 'Portal Training & Development'
        ];
        return view('user/homeuser', $data);
    }

    public function DataHome()
    {

        $home =  $this->tna->getDataHome();
        foreach ($home as $row) {
            $data = [
                'tittle' => $row['training'],
                'start' => $row['rencana_training'],
                'end' => $row['rencana_training']
            ];
        }
        echo json_encode($data);
    }
}