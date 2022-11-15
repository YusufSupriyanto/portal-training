<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Budget;
use App\Models\M_Tna;
use App\Models\UserModel;
use App\Models\M_TnaUnplanned;

class C_TnaUnplanned extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;

    private M_Approval $approval;

    private M_TnaUnplanned $unplanned;

    private M_Budget $budget;

    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->approval = new M_Approval();
        $this->unplanned = new M_TnaUnplanned();
        $this->budget = new M_Budget();
    }

    public function index()
    {
        $departemen = $this->unplanned->getStatusWaitAdminUnplannedDistinct();

        // dd($tna);
        $data = [
            'tittle' => 'Form TNA',
            'dept' => $departemen,
            'tna' => $this->unplanned,
            'budget' => $this->budget,


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

        $departemen = $this->unplanned->getKadivAcceptDistinct($date);

        $data = [
            'tittle' => 'KADIV Training Accepted',
            'departemen' => $departemen,
            'stat' => $this->unplanned,
            'date' => $date,
            'budget' => $this->budget
        ];
        return view('admin/kadivaccept', $data);
    }
}