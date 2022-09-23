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

class UnplannedTraining extends BaseController
{
    private UserModel $user;
    private M_ListTraining $training;
    private M_Tna $tna;
    private M_Approval $approval;
    private M_EvaluasiReaksi $evaluasiReaksi;
    private M_EvaluasiEfektifitas $efektivitas;
    private M_History $history;
    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->user = new UserModel();
        $this->tna = new M_Tna();
        $this->approval = new M_Approval();
        $this->evaluasiReaksi = new M_EvaluasiReaksi();
        $this->history = new M_History();
        $this->efektivitas = new M_EvaluasiEfektifitas();
    }
    public function index()
    {
        $id = session()->get('id');
        $user = $this->user->filter($id);
        $tna = $this->tna->getTnaFilter($id);
        $data = [
            'tittle' => 'Data Member',
            'user' => $user,
            'tna' => $tna
        ];
        return view('user/datamemberunplanned', $data);
    }
}