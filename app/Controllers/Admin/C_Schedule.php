<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;

class C_Schedule extends BaseController
{
    private M_Tna $tna;
    private M_Approval $approval;

    private M_EvaluasiReaksi $reaksi;

    private M_TnaUnplanned $unplanned;

    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->approval = new M_Approval();
        $this->reaksi =  new M_EvaluasiReaksi();
        $this->unplanned = new M_TnaUnplanned();
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

    public function unplannedSchedule()
    {
        $schedule  = $this->unplanned->getSchedule();
        //dd($schedule);

        $data = [
            'tittle' => 'Schedule Unplanned Training',
            'schedule' => $schedule
        ];
        return view('admin/schedule', $data);
    }

    public function askForEvaluationUnplanned($id)
    {
        $true  = $this->approval->getIdApproval($id);
        // dd($true);
        $data = [
            'id_approval' => $true['id_approval'],
            'status_training' => true
        ];

        $this->approval->save($data);

        return redirect()->to('/schedule_unplanned');
    }

    public function NotImplemented()
    {
        $id = $this->request->getPost('id_tna');
        $reason = $this->request->getPost('alasan');
        $false  = $this->approval->getIdApproval($id);
        $status = $this->tna->getTrainingNotImplemented();
        $data = [
            'id_approval' => $false['id_approval'],
            'alasan' => $reason,
            'status_training' => false
        ];

        $this->approval->save($data);

        return redirect()->to('/schedule_unplanned');
    }
}