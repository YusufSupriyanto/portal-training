<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_ListTraining;
use App\Models\M_Tna;
use App\Models\UserModel;

class OurSchedule extends BaseController
{
    private UserModel $user;
    private M_ListTraining $training;
    private M_Tna $tna;

    private M_Approval $approval;

    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->user = new UserModel();
        $this->tna = new M_Tna();
        $this->approval = new M_Approval();
    }

    public function personal()
    {
        $id  = session()->get('id');
        $schedule = $this->tna->getPersonalSchedule($id);
        $data = [
            'tittle' => 'Jadwal Training Personal',
            'schedule' => $schedule
        ];
        return view('user/memberschedule', $data);
    }
    public function member()
    {
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');

        if ($bagian == 'BOD') {
            $schedule =  $this->tna->getMemberSchedule($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $schedule =  $this->tna->getMemberSchedule($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $schedule = $this->tna->getMemberSchedule($bagian, $departemen);
        } else {
            $schedule  =  array();
        }

        $data = [
            'tittle' => 'Jadwal Training Member',
            'schedule' => $schedule
        ];
        return view('user/memberschedule', $data);
    }
}