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
        // dd($home);
        $json = [];
        foreach ($home as $row) {
            if ($row['rencana_training'] >= date('dd-mm-yy')) {
                $data = [
                    'title' => $row['kategori_training'],
                    'start' => $row['rencana_training'],
                    'end' => $row['rencana_training'],
                    'color' => '#FFD700',
                    'url' => base_url('/jadwal/' . $row['rencana_training'])
                ];
            } else {
                $data = [
                    'title' => $row['kategori_training'],
                    'start' => $row['rencana_training'],
                    'end' => $row['rencana_training'],
                    'color' => 'green',
                    'url' => base_url('/jadwal/' . $row['rencana_training'])
                ];
            }


            // var_dump($data);
            array_push($json, $data);
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