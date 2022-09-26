<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Tna;

class Home extends BaseController
{

    private M_Tna $tna;
    public function __construct()
    {
        $this->tna = new M_Tna();
    }
    public function index()
    {

        $data = [
            'tittle' => 'Portal Training & Development'
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
                    'start' => $row['rencana_training'],
                    'end' => $row['rencana_training'],
                    'color' => '#FFD700',
                    'url' => base_url('/jadwal/' . $row['rencana_training'])
                ];
                array_push($json, $data);
            } else {
                $data = [
                    'title' => $row['kategori_training'],
                    'start' => $row['rencana_training'],
                    'end' => $row['rencana_training'],
                    'color' => 'green',
                    'url' => base_url('/jadwal/' . $row['rencana_training'])
                ];
                array_push($json, $data);
            }
        }
        echo json_encode($json);
    }

    public function JadwalHome($date)
    {
        $dataFix = [];
        $jadwal = $this->tna->getDataJadwalHome($date);
        foreach ($jadwal as $jadwals) {
            $kategori = $this->tna->getJadwalHomeVer($jadwals['Training'], $date);
            // dd($kategori);
            $data = [
                'training' => $jadwals['Training'],
                'pendaftar' => $jadwals['Pendaftar'],
                'tanggal' => $date,
                'kategori' => $kategori[0]['kategori_training'],
            ];

            array_push($dataFix, $data);
        }

        $newDate = date('F d, Y', strtotime($date));
        $data = [
            'tittle' => 'Jadwal Training',
            'date' => $newDate,
            'jadwal' => $dataFix
        ];
        return view('user/jadwalhome', $data);
    }
}