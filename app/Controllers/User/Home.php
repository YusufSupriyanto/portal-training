<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Tna;
use App\Models\UserModel;

class Home extends BaseController
{

    private M_Tna $tna;
    private UserModel $user;
    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
    }
    public function index()
    {
        $id = session()->get('id');
        $user = $this->user->filter($id);
        $data = [
            'tittle' => 'Portal Training & Development',
            'user' => $user
        ];
        return view('user/homeuser', $data);
    }

    public function DataHome()
    {

        $home =  $this->tna->getDataHome();
        // var_dump($home);
        $json = [];
        foreach ($home as $row) {
            $date = date('Y-m-d');
            $dateTraining = $row['rencana_training'];
            if (strtotime($dateTraining) > strtotime($date)) {
                $data = [
                    'title' => $row['kategori_training'],
                    'start' => $row['mulai_training'],
                    'end' => date('Y-m-d', strtotime('+1 days', strtotime($row['rencana_training']))),
                    'color' => '#FFD700',
                    // 'url' => base_url('/jadwal/' . $row['rencana_training'])
                ];
                array_push($json, $data);
            } else {
                $data = [
                    'title' => $row['kategori_training'],
                    'start' => $row['mulai_training'],
                    'end' => date('Y-m-d', strtotime('+1 days', strtotime($row['rencana_training']))),
                    'color' => 'green',
                    // 'url' => base_url('/jadwal/' . $row['rencana_training'])
                ];
                array_push($json, $data);
            }
        }
        echo json_encode($json);
    }

    public function JadwalHome()
    {
        $date = $this->request->getPost('start');
        $time = strtotime(current(explode("(", $date)));
        $dates = date('Y-m-d', $time);
        $dataFix = [];
        $jadwal = $this->tna->getDataJadwalHome($dates);

        // foreach ($jadwal as $jadwals) {
        //     $data = [
        //         'id_training' => $jadwals['id_training'],
        //         'training' => $jadwals['Training'],
        //         'pendaftar' => $jadwals['Pendaftar'],
        //         'tanggal_start' => $dates,
        //         'tanggal_ahir' => $jadwals['rencana_training'],
        //         'kategori' => $jadwals['kategori_training'],
        //     ];

        //     array_push($dataFix, $data);
        // }

        echo json_encode($jadwal);
    }


    // public function MemberModal()
    // {
    //     //$training = $this->request->getPost('training');
    //     $id = session()->get('id');
    //     $users = $this->user->Filter($id);
    //     echo json_encode($users);
    // }
}