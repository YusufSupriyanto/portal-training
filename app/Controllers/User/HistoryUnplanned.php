<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class HistoryUnplanned extends BaseController
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

    public function download($id)
    {
        // dd($id);
        //$sertifikat = $this->tna->getDataHistory($id);
        // dd($sertifikat[0]['sertifikat']);
        header('Content-type: application/pdf');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
    }


    public function detailHistoryMember()
    {
        $id = $_POST['history'];
        $history = $this->unplanned->getDetailHistory($id);
        $data = [
            'tittle' => 'Personal History Unplanned Training',
            'history' => $history
        ];
        return view('user/historypersonal', $data);
    }
}