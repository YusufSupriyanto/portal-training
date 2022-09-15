<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;

class C_Schedule extends BaseController
{
    private M_Tna $tna;
    private M_Approval $approval;

    private M_EvaluasiReaksi $reaksi;

    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->approval = new M_Approval();
        $this->reaksi =  new M_EvaluasiReaksi();
    }
    public function index()
    {
        $schedule  = $this->tna->getSchedule();

        $data = [
            'tittle' => 'Schedule Training',
            'schedule' => $schedule
        ];
        return view('admin/schedule', $data);
    }

    public function askForEvaluation($id)
    {
        $true  = $this->approval->getIdApproval($id);
        // dd($true);
        $data = [
            'id_approval' => $true['id_approval'],
            'status_training' => true
        ];

        $this->approval->save($data);

        return redirect()->to('/schedule_training');
    }
}