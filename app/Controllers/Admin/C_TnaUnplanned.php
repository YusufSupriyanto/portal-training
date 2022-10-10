<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Tna;
use App\Models\UserModel;
use App\Models\M_TnaUnplanned;

class C_TnaUnplanned extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;

    private M_Approval $approval;

    private M_TnaUnplanned $unplanned;

    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->approval = new M_Approval();
        $this->unplanned = new M_TnaUnplanned();
    }

    public function index()
    {
        $tna = $this->unplanned->getStatusWaitAdminUnplanned();


        //dd($deadline['deadline']);
        $data = [
            'tittle' => 'Form TNA',
            'tna' => $tna,
        ];
        return view('admin/tnaunplanned', $data);
    }

    public function kadivStatusUnplanned()
    {
        $tna = $this->unplanned->getKadivStatusUnplanned();
        $data = [
            'tittle' => 'Kadiv Status Approval Unplanned Training',
            'tna' => $tna
        ];
        return view('admin/tnakadiv', $data);
    }

    public function unplannedMonthly()
    {
        // $date = '2022-09-30';
        $TrainingMonthly = $this->unplanned->getUnplannedMonthly();
        // dd($TrainingMonthly[0]);

        $data = [
            'tittle' => 'Training Monthly Unplanned',
            'training' => $TrainingMonthly
        ];
        return view('admin/trainingmonthly', $data);
    }

    public function kadivAccept($date)
    {

        $status = $this->unplanned->getKadivAccept($date);
        //dd($status);
        $data = [
            'tittle' => 'Training Yang Di ACC KADIV',
            'status' => $status
        ];
        return view('admin/kadivaccept', $data);
    }
}