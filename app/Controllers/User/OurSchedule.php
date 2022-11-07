<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_ListTraining;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class OurSchedule extends BaseController
{
    private UserModel $user;
    private M_ListTraining $training;
    private M_Tna $tna;

    private M_Approval $approval;

    private M_TnaUnplanned $unplanned;

    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->user = new UserModel();
        $this->tna = new M_Tna();
        $this->approval = new M_Approval();
        $this->unplanned = new M_TnaUnplanned();
    }

    public function personal()
    {
        $id  = session()->get('id');
        $page = basename($_SERVER['PHP_SELF']);
        if ($page == 'personal_schedule') {
            $schedule = $this->tna->getPersonalSchedule($id);
        } else {
            $schedule = $this->unplanned->getPersonalSchedule($id);
        }
        // dd($schedule);
        $data = [
            'tittle' => 'Jadwal Training Personal',
            'schedule' => $schedule
        ];
        return view('user/personalschedule', $data);
    }
    public function member()
    {
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');
        $seksi = session()->get('seksi');
        $page = basename($_SERVER['PHP_SELF']);
        if ($page == 'member_schedule') {
            if ($bagian == 'BOD') {
                $schedule =  $this->tna->getMemberSchedule($bagian, $dic);
            } elseif ($bagian == 'KADIV') {
                $schedule =  $this->tna->getMemberSchedule($bagian, $divisi);
            } elseif ($bagian == 'KADEPT') {
                $schedule = $this->tna->getMemberSchedule($bagian, $departemen);
            } else {
                $schedule =  $this->tna->getMemberSchedule($bagian, $seksi);
            }
        } else {
            if ($bagian == 'BOD') {
                $schedule =  $this->unplanned->getMemberSchedule($bagian, $dic);
            } elseif ($bagian == 'KADIV') {
                $schedule =  $this->unplanned->getMemberSchedule($bagian, $divisi);
            } elseif ($bagian == 'KADEPT') {
                $schedule = $this->unplanned->getMemberSchedule($bagian, $departemen);
            } else {
                $schedule =  $this->unplanned->getMemberSchedule($bagian, $seksi);
            }
        }
        //dd($schedule);

        $data = [
            'tittle' => 'Jadwal Training Member',
            'schedule' => $schedule
        ];
        return view('user/memberschedule', $data);
    }
}