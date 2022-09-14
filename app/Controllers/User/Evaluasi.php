<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;

class Evaluasi extends BaseController
{

    private M_Tna $tna;
    private M_EvaluasiReaksi $evaluasiReaksi;
    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->evaluasiReaksi = new M_EvaluasiReaksi();
    }
    public function index()
    {
        $nama = session()->get('nama');
        $bagian = session()->get('bagian');
        $npk = session()->get('npk');


        $data = [
            'tittle' => 'Portal Training & Development',
            'nama' => $nama,
            'npk' => $npk,
            'bagian' => $bagian
        ];
        return view('user/evaluasireaksi', $data);
    }

    public function SendEvaluasiReaksi()
    {


        // $training = $this->evaluasiReaksi->getIdReaksi($id = 'Kosong');

        $data = [
            'id_reaksi' =>  1234,
            'id_tna' => 321,
            'program' => $this->request->getPost('program[0]'),
            'tampilan' => $this->request->getPost('tampilan[]'),
            'program_training' => $this->request->getPost('program_training[]'),
            'metode' => $this->request->getPost('metode[]'),
            'penambahan_keterampilan' => $this->request->getPost('penambahan[]'),
            'kelayakan' => $this->request->getPost('kelayakan[]'),
            'kelayakan_akomodasi' => $this->request->getPost('kelayakan_akomodasi[]'),
            'harapan' => $this->request->getPost('harapan'),
            'perbaikan_program' => $this->request->getPost('perbaikan_program'),
            'instruktur1' => $this->request->getPost('instruktur1'),
            'instruktur2' => $this->request->getPost('instruktur2'),
            'instruktur3' => $this->request->getPost('instruktur3'),
            'instruktur4' => $this->request->getPost('instruktur4'),
            'instruktur5' => $this->request->getPost('instruktur5'),
            'pengetahuan1' => $this->request->getPost('pengetahuan1'),
            'pengetahuan2' => $this->request->getPost('pengetahuan2'),
            'pengetahuan3' => $this->request->getPost('pengetahuan3'),
            'pengetahuan4' => $this->request->getPost('pengetahuan4'),
            'pengetahuan5' => $this->request->getPost('pengetahuan5'),
            'kemampuan1' => $this->request->getPost('kemampuan1'),
            'kemampuan2' => $this->request->getPost('kemampuan2'),
            'kemampuan3' => $this->request->getPost('kemampuan3'),
            'kemampuan4' => $this->request->getPost('kemampuan4'),
            'kemampuan5' => $this->request->getPost('kemampuan5'),
            'kemampuan_melibatkan1' => $this->request->getPost('kemampuan_melibatkan1'),
            'kemampuan_melibatkan2' => $this->request->getPost('kemampuan_melibatkan2'),
            'kemampuan_melibatkan3' => $this->request->getPost('kemampuan_melibatkan3'),
            'kemampuan_melibatkan4' => $this->request->getPost('kemampuan_melibatkan4'),
            'kemampuan_melibatkan5' => $this->request->getPost('kemampuan_melibatkan5'),
            'kemampuan_menanggapi1' => $this->request->getPost('kemampuan_menanggapi1'),
            'kemampuan_menanggapi2' => $this->request->getPost('kemampuan_menanggapi2'),
            'kemampuan_menanggapi3' => $this->request->getPost('kemampuan_menanggapi3'),
            'kemampuan_menanggapi4 ' => $this->request->getPost('kemampuan_menanggapi4'),
            'kemampuan_menanggapi5' => $this->request->getPost('kemampuan_menanggapi5'),
            'kemampuan_mengendalikan1' => $this->request->getPost('kemampuan_mengendalikan1'),
            'kemampuan_mengendalikan2 ' => $this->request->getPost('kemampuan_mengendalikan2'),
            'kemampuan_mengendalikan3 ' => $this->request->getPost('kemampuan_mengendalikan3'),
            'kemampuan_mengendalikan4 ' => $this->request->getPost('kemampuan_mengendalikan4'),
            'kemampuan_mengendalikan5' => $this->request->getPost('kemampuan_mengendalikan5'),
            'harapan_instruktur' => $this->request->getPost('harapan_instruktur'),
            'wawasan' => $this->request->getPost('wawasan'),
            'skill' => $this->request->getPost('skill[]'),
            'rekomendasi' => $this->request->getPost('rekomendasi[]'),
            'kebutuhan' => $this->request->getPost('kebutuhan'),
            'status_evaluasi' => true,
        ];
        dd($data);
    }
}