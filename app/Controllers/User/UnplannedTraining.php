<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiEfektifitas;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_ListTraining;
use App\Models\UserModel;
use App\Models\M_Approval;
use App\Models\M_History;
use App\Models\M_TnaUnplanned;

class UnplannedTraining extends BaseController
{
    private UserModel $user;
    private M_ListTraining $training;
    private M_Tna $tna;
    private M_Approval $approval;
    private M_EvaluasiReaksi $evaluasiReaksi;
    private M_EvaluasiEfektifitas $efektivitas;
    private M_History $history;

    private M_TnaUnplanned $unplanned;
    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->user = new UserModel();
        $this->tna = new M_Tna();
        $this->approval = new M_Approval();
        $this->evaluasiReaksi = new M_EvaluasiReaksi();
        $this->history = new M_History();
        $this->efektivitas = new M_EvaluasiEfektifitas();
        $this->unplanned = new M_TnaUnplanned();
    }
    public function index()
    {
        $id = session()->get('id');
        $user = $this->user->filter($id);
        $tna = $this->tna->getTnaFilterUnplanned($id);
        $data = [
            'tittle' => 'Data Member',
            'user' => $user,
            'tna' => $tna
        ];
        return view('user/datamemberunplanned', $data);
    }

    public function TnaUserUnplanned()
    {
        $id = $this->request->getPost('member');
        $user = $this->user->getAllUser($id);
        $trainings = $this->training->getAll();
        $tna = $this->tna->getUserTnaUnplanned($id);

        $data = [
            'tittle' => 'Unplanned Training',
            'user' => $user,
            'training' => $trainings,
            'tna' => $tna,
            'validation' => \Config\Services::validation(),
        ];
        return view('user/formtnaunplanned', $data);
    }


    public function requestUnplanned()
    {
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');

        if ($bagian == 'BOD') {
            $status = $this->unplanned->getRequestTnaUnplanned($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $status =  $this->unplanned->getRequestTnaUnplanned($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $status = $this->unplanned->getRequestTnaUnplanned($bagian, $departemen);
        } else {
            $status  =  array();
        }
        $data = [
            'tittle' => 'Request Tna',
            'status' => $status
        ];
        if (session()->get('bagian') == 'KADIV') {
            return view('user/requestuser', $data);
        }
        return view('user/requestuserbod', $data);
    }
}