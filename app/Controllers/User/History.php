<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class History extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;
    private M_TnaUnplanned $unplanned;


    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->unplanned = new M_TnaUnplanned();
    }

    public function index()
    {
        $id = session()->get('id');

        $page  = basename($_SERVER['PHP_SELF']);
        if ($page == 'personal_history') {
            $history = $this->tna->getDetailHistory($id);
            $tittle = 'Personal History Training';
        } else {
            $history = $this->unplanned->getDetailHistory($id);
            $tittle = 'Personal History Training Unplanned';
        }
        $data = [
            'tittle' => $tittle,
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

        $page = basename($_SERVER['PHP_SELF']);
        if ($page == 'member_history') {
            if ($bagian == 'BOD') {
                $status =  $this->tna->getMemberSchedule($bagian, $dic);
            } elseif ($bagian == 'KADIV') {
                $status =  $this->tna->getMemberSchedule($bagian, $divisi);
            } elseif ($bagian == 'KADEPT') {
                $status = $this->tna->getMemberSchedule($bagian, $departemen);
            } else {
                $status  =  array();
            }
        } else {
            if ($bagian == 'BOD') {
                $status =  $this->unplanned->getMemberSchedule($bagian, $dic);
            } elseif ($bagian == 'KADIV') {
                $status =  $this->unplanned->getMemberSchedule($bagian, $divisi);
            } elseif ($bagian == 'KADEPT') {
                $status = $this->unplanned->getMemberSchedule($bagian, $departemen);
            } else {
                $status  =  array();
            }
        }

        // dd($status[0]);
        // $user = $this->user->getAllUser();
        $DataHistory = [];

        if (empty($status[0]['id_user'])) {
            $history = [
                'id' => '',
                'nama' => '',
                'jumlah_training' => ''
            ];
        } else {
            if ($page == 'member_history') {
                $training = $this->tna->getTnaUser($status[0]['id_user']);
            } else {
                $training = $this->unplanned->getTnaUser($status[0]['id_user']);
            }
            $history = [
                'id' => $status[0]['id_user'],
                'nama' => $status[0]['nama'],
                'jumlah_training' => $training[0]['id_user']
            ];
        }

        array_push($DataHistory, $history);


        $data = [
            'tittle' => 'Member History Training',
            'user' => $DataHistory,
        ];
        return view('user/memberhistory', $data);
    }

    public function download($id)
    {
        dd($id);
        //$sertifikat = $this->tna->getDataHistory($id);
        // dd($sertifikat[0]['sertifikat']);
        header('Content-type: application/pdf');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        // readfile(base_url() . "\public" . "$sertifikat[0]['sertifikat']");

        // var_dump($sertifikat[0]['sertifikat']);
        // $data = [
        //     'tittle' => 'Sertifikat View',
        //     'sertifikat' => $sertifikat[0]['sertifikat']
        // ];
        // return view('user/viewsertifikat', $data);
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