<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;

class History extends BaseController
{
    private M_Tna $tna;


    public function __construct()
    {
    }

    public function index()
    {
        // $id = session()->get('id');
        $data = [
            'tittle' => 'History Personal',
            // 'evaluasi' => $evaluasi
        ];
        return view('user/historypersonal', $data);
    }
}