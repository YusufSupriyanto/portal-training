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
        $this->tna = new M_Tna();
    }

    public function index()
    {
        $id = session()->get('id');
        $history = $this->tna->getDetailHistory($id);
        $data = [
            'tittle' => 'Personal History Training',
            'history' => $history
        ];
        return view('user/historypersonal', $data);
    }

    public function memberHistory()
    {
        $data = [
            'tittle' => 'Member History Training',
        ];
        return view('user/memberhistory', $data);
    }

    public function download()
    {
        header('X-Frame-Options: GOFORIT');
        $id = $_POST['input'];
        $sertifikat = $this->tna->getDataHistory($id[0]);
        // dd($sertifikat[0]['sertifikat']);
        // header('Content-type: application/pdf');
        // header('Content-Transfer-Encoding: binary');
        // header('Accept-Ranges: bytes');
        // readfile($sertifikat[0]['sertifikat']);

        // var_dump($sertifikat[0]['sertifikat']);
        $data = [
            'tittle' => 'Sertifikat View',
            'sertifikat' => $sertifikat[0]['sertifikat']
        ];
        return view('user/viewsertifikat', $data);
    }
}