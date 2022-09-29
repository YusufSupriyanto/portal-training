<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\UserModel;


class ContacUs extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {

        $data = [
            'tittle' => 'Contac Us',
        ];
        return view('user/contacususer', $data);
    }
}