<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\UserModel;

class History extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;


    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
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
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');


        if ($bagian == 'BOD') {
            $status =  $this->tna->getMemberSchedule($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $status =  $this->tna->getMemberSchedule($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $status = $this->tna->getMemberSchedule($bagian, $departemen);
        } else {
            $status  =  array();
        }

        // dd($status[0]);
        // $user = $this->user->getAllUser();
        $DataHistory = [];
        // for ($i = 0; $i < count($status); $i++) {
        foreach ($status as $users) {
            $training = $this->tna->getTnaUser($users['id_user']);
            $history = [
                'id' => $users['id_user'],
                'nama' => $users['nama'],
                'jumlah_training' => $training[0]['id_user']
            ];
            array_push($DataHistory, $history);
        }
        // }

        // dd($DataHistory);

        $data = [
            'tittle' => 'Member History Training',
            'user' => $DataHistory,
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


    public function detailHistoryMember()
    {
        $id = $_POST['history'];
        $history = $this->tna->getDetailHistory($id);
        $data = [
            'tittle' => 'Personal History Training',
            'history' => $history
        ];
        return view('user/historypersonal', $data);
    }
}