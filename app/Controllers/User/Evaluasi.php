<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\UserModel;

class Evaluasi extends BaseController
{

    private M_Tna $tna;
    private M_EvaluasiReaksi $evaluasiReaksi;
    private UserModel $user;
    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->evaluasiReaksi = new M_EvaluasiReaksi();
        $this->user = new UserModel();
    }
    public function index()
    {
        $id = session()->get('id');

        $evaluasi =  $this->tna->getEvaluasiReaksi($id);
        // dd($evaluasi);

        $data = [
            'tittle' => 'Evaluasi Reaksi Training',
            'evaluasi' => $evaluasi
        ];
        return view('user/daftarreaksi', $data);
    }

    public function EvaluasiForm($id)
    {
        $id = $this->tna->getDataForEvaluation($id);

        $data = [
            'tittle' => 'Evaluasi Reaksi',
            'data' => $id
        ];
        return view('user/evaluasireaksi', $data);
    }

    public function SendEvaluasiReaksi()
    {
        $id =  $this->request->getPost('id_tna');
        $training = $this->evaluasiReaksi->getIdReaksi($id);
        $data = [
            'id_reaksi' =>  $training['id_reaksi'],
            'id_tna' =>  $training['id_tna'],
            'program' => $this->request->getPost('program[0]'),
            'tampilan' => $this->request->getPost('tampilan[0]'),
            'program_training' => $this->request->getPost('program_training[0]'),
            'metode' => $this->request->getPost('metode[0]'),
            'penambahan_keterampilan' => $this->request->getPost('penambahan[0]'),
            'kelayakan' => $this->request->getPost('kelayakan[0]'),
            'kelayakan_akomodasi' => $this->request->getPost('kelayakan_akomodasi[0]'),
            'harapan' => $this->request->getPost('harapan'),
            'perbaikan_program' => $this->request->getPost('perbaikan_program'),
            'instruktur_1' => $this->request->getPost('instruktur1'),
            'instruktur_2' => $this->request->getPost('instruktur2'),
            'instruktur_3' => $this->request->getPost('instruktur3'),
            'instruktur_4' => $this->request->getPost('instruktur4'),
            'instruktur_5' => $this->request->getPost('instruktur5'),
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
            'kemampuan_menanggapi4' => $this->request->getPost('kemampuan_menanggapi4'),
            'kemampuan_menanggapi5' => $this->request->getPost('kemampuan_menanggapi5'),
            'kemampuan_mengendalikan1' => $this->request->getPost('kemampuan_mengendalikan1'),
            'kemampuan_mengendalikan2' => $this->request->getPost('kemampuan_mengendalikan2'),
            'kemampuan_mengendalikan3' => $this->request->getPost('kemampuan_mengendalikan3'),
            'kemampuan_mengendalikan4' => $this->request->getPost('kemampuan_mengendalikan4'),
            'kemampuan_mengendalikan5' => $this->request->getPost('kemampuan_mengendalikan5'),
            'harapan_instruktur' => $this->request->getPost('harapan_instruktur'),
            'peningkatan_instruktur' => $this->request->getPost('peningkatan_instruktur'),
            'wawasan' => $this->request->getPost('wawasan'),
            'skill' => (int) $this->request->getPost('skill[0]'),
            'rekomendasi' => $this->request->getPost('rekomendasi[0]'),
            'kebutuhan' => $this->request->getPost('kebutuhan'),
            'status_evaluasi' => true,
        ];
        //dd($data);
        $this->evaluasiReaksi->save($data);
        session()->setFlashdata('success', 'Data Berhasil Di Import');
        return redirect()->to('/evaluasi_reaksi');
    }

    // public function SendEvaluasiReaksiUnplanned()
    // {
    //     $id =  $this->request->getPost('id_tna');


    //     if (!$this->validate([
    //         'instruktur1' => 'required',
    //         'pengetahuan1' => 'required',
    //         'kemampuan1' => 'required',
    //         'wawasan' => 'required',
    //     ])) {
    //         $validation = \Config\Services::validation();
    //         return redirect()->to('/form_evaluasi/' . $id)->withInput()->with('validation', $validation);
    //     }
    //     $training = $this->evaluasiReaksi->getIdReaksi($id);

    //     $data = [
    //         'id_reaksi' =>  $training['id_reaksi'],
    //         'id_tna' =>  $training['id_tna'],
    //         'program' => $this->request->getPost('program[0]'),
    //         'tampilan' => $this->request->getPost('tampilan[0]'),
    //         'program_training' => $this->request->getPost('program_training[0]'),
    //         'metode' => $this->request->getPost('metode[0]'),
    //         'penambahan_keterampilan' => $this->request->getPost('penambahan[0]'),
    //         'kelayakan' => $this->request->getPost('kelayakan[0]'),
    //         'kelayakan_akomodasi' => $this->request->getPost('kelayakan_akomodasi[0]'),
    //         'harapan' => $this->request->getPost('harapan'),
    //         'perbaikan_program' => $this->request->getPost('perbaikan_program'),
    //         'instruktur_1' => $this->request->getPost('instruktur1'),
    //         'instruktur_2' => $this->request->getPost('instruktur2'),
    //         'instruktur_3' => $this->request->getPost('instruktur3'),
    //         'instruktur_4' => $this->request->getPost('instruktur4'),
    //         'instruktur_5' => $this->request->getPost('instruktur5'),
    //         'pengetahuan1' => $this->request->getPost('pengetahuan1'),
    //         'pengetahuan2' => $this->request->getPost('pengetahuan2'),
    //         'pengetahuan3' => $this->request->getPost('pengetahuan3'),
    //         'pengetahuan4' => $this->request->getPost('pengetahuan4'),
    //         'pengetahuan5' => $this->request->getPost('pengetahuan5'),
    //         'kemampuan1' => $this->request->getPost('kemampuan1'),
    //         'kemampuan2' => $this->request->getPost('kemampuan2'),
    //         'kemampuan3' => $this->request->getPost('kemampuan3'),
    //         'kemampuan4' => $this->request->getPost('kemampuan4'),
    //         'kemampuan5' => $this->request->getPost('kemampuan5'),
    //         'kemampuan_melibatkan1' => $this->request->getPost('kemampuan_melibatkan1'),
    //         'kemampuan_melibatkan2' => $this->request->getPost('kemampuan_melibatkan2'),
    //         'kemampuan_melibatkan3' => $this->request->getPost('kemampuan_melibatkan3'),
    //         'kemampuan_melibatkan4' => $this->request->getPost('kemampuan_melibatkan4'),
    //         'kemampuan_melibatkan5' => $this->request->getPost('kemampuan_melibatkan5'),
    //         'kemampuan_menanggapi1' => $this->request->getPost('kemampuan_menanggapi1'),
    //         'kemampuan_menanggapi2' => $this->request->getPost('kemampuan_menanggapi2'),
    //         'kemampuan_menanggapi3' => $this->request->getPost('kemampuan_menanggapi3'),
    //         'kemampuan_menanggapi4' => $this->request->getPost('kemampuan_menanggapi4'),
    //         'kemampuan_menanggapi5' => $this->request->getPost('kemampuan_menanggapi5'),
    //         'kemampuan_mengendalikan1' => $this->request->getPost('kemampuan_mengendalikan1'),
    //         'kemampuan_mengendalikan2' => $this->request->getPost('kemampuan_mengendalikan2'),
    //         'kemampuan_mengendalikan3' => $this->request->getPost('kemampuan_mengendalikan3'),
    //         'kemampuan_mengendalikan4' => $this->request->getPost('kemampuan_mengendalikan4'),
    //         'kemampuan_mengendalikan5' => $this->request->getPost('kemampuan_mengendalikan5'),
    //         'harapan_instruktur' => $this->request->getPost('harapan_instruktur'),
    //         'peningkatan_instruktur' => $this->request->getPost('peningkatan_instruktur'),
    //         'wawasan' => $this->request->getPost('wawasan'),
    //         'skill' => (int) $this->request->getPost('skill[0]'),
    //         'rekomendasi' => $this->request->getPost('rekomendasi[0]'),
    //         'kebutuhan' => $this->request->getPost('kebutuhan'),
    //         'status_evaluasi' => true,
    //     ];
    //     // dd($data);
    //     $this->evaluasiReaksi->save($data);
    //     session()->setFlashdata('success', 'Data Berhasil Di Import');
    //     return redirect()->to('/evaluasi_reaksi_unplanned');
    // }

    public function DetailEvaluasiReaksi($id)
    {

        $evaluasi  = $this->tna->getDetailEvaluasiReaksi($id);

        // $evaluasi = $this->tna->getDataForEvaluation($id);


        $data = [
            'tittle' => 'Evaluasi Reaksi',
            'data' => $evaluasi
        ];
        return view('user/detailevaluasireaksi', $data);
    }

    public function EvaluasiMember()
    {
        $id = session()->get('id');

        $user =  $this->user->filter($id);
        $person = [];
        for ($i = 0; $i < count($user); $i++) {
            $users = [
                'id' => $user[$i]->id_user,
                'nama' => $user[$i]->nama
            ];

            array_push($person, $users);
        }
        // dd($user);

        $data = [
            'tittle' => 'Evaluasi Reaksi',
            'user' => $person
        ];
        return view('user/evaluasireaksimember', $data);
    }

    public function detailEvaluasimember()
    {
        $id =  $this->request->getPost('evaluasi');
        $evaluasi =  $this->tna->getEvaluasiReaksi($id);
        // dd($evaluasi);

        $data = [
            'tittle' => 'Evaluasi Reaksi',
            'evaluasi' => $evaluasi
        ];
        return view('user/daftarreaksi', $data);
    }


    public function DataEvaluasi()
    {

        $id_training = $this->request->getPost('id_training');
        $evaluasi  = $this->tna->getDetailEvaluasiReaksi($id_training);
        echo json_encode($evaluasi);
    }
}