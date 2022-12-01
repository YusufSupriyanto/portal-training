<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiEfektifitas;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;

class EvaluasiEfektivitasUnplanned extends BaseController
{
    private M_Tna $tna;
    private M_EvaluasiEfektifitas $efektivitas;

    private M_TnaUnplanned $unplanned;
    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->efektivitas = new M_EvaluasiEfektifitas();
        $this->unplanned = new M_TnaUnplanned();
    }

    public function index()
    {
        $id = session()->get('id');
        $efektifitas = $this->unplanned->getDataEfektivitas($id);
        $dataEvaluasifixed = [];
        foreach ($efektifitas as $efektif) {

            $date_training = date_create($efektif['rencana_training']);
            $date_now = date_create(date('Y-m-d'));
            $compare = date_diff($date_training, $date_now);
            $due_date = (int)$compare->format('%a');
            if ($due_date >= 90) {
                $dataEvaluasiProcess = [
                    'id_tna' => $efektif['id_tna'],
                    'nama' => $efektif['nama'],
                    'judul' => $efektif['training'],
                    'jenis' => $efektif['jenis_training'],
                    'tanggal' => $efektif['rencana_training'],
                    'status' =>  $efektif['status_efektivitas']
                ];
                array_push($dataEvaluasifixed, $dataEvaluasiProcess);
            }
        }
        $data = [
            'tittle' => 'Evaluasi Efektivitas Unplanned Training',
            'evaluasi' => $dataEvaluasifixed
        ];
        //dd($data);
        return view('user/evaluasiefektifitasunplanned', $data);
    }

    public function formEvaluasi($id)
    {
        $evaluation  = $this->tna->getDataForEvaluation($id);
        //dd($evaluation);
        $data = [
            'tittle' => 'Form Evaluasi Efektifitas',
            'evaluasi' => $evaluation
        ];
        return view('user/formefektivitasunplanned', $data);
    }


    public function saveEfektivitas()
    {
        $id = $this->request->getPost('id_tna');
        // dd($id);
        $id_efektivitas =  $this->efektivitas->getIdEfektivitas($id);
        // dd($id_efektivitas);
        $pengetahuan = $_POST['pengetahuan'];
        $keteranpilan = $_POST['keterampilan'];
        $data = [
            'id_efektivitas' => $id_efektivitas[0]['id_efektivitas'],
            'pengetahuan' => $pengetahuan[0],
            'keterampilan' =>  $keteranpilan[0],
            'performance' => $_POST['performance'],
            'perubahan' => $_POST['perubahan'],
            'pelatihan' => $_POST['pelatihan'],
            'note1' => $this->request->getVar('note1'),
            'note2' => $this->request->getVar('note2'),
            'note3' => $this->request->getVar('note3'),
            'note4' => $this->request->getVar('note4'),
            'note5' => $this->request->getVar('note5'),
            'kompetensi1' => $this->request->getVar('kompetensi1'),
            'kompetensi2' => $this->request->getVar('kompetensi2'),
            'kompetensi3' => $this->request->getVar('kompetensi3'),
            'kompetensi4' => $this->request->getVar('kompetensi4'),
            'kompetensi5' => $this->request->getVar('kompetensi5'),
            'perubahan1' => $this->request->getVar('perubahan1'),
            'perubahan2' => $this->request->getVar('perubahan2'),
            'perubahan3' => $this->request->getVar('perubahan3'),
            'perubahan4' => $this->request->getVar('perubahan4'),
            'perubahan5' => $this->request->getVar('perubahan5'),
            'keterangan1' => $this->request->getVar('keterangan1'),
            'keterangan2' => $this->request->getVar('keterangan2'),
            'keterangan3' => $this->request->getVar('keterangan3'),
            'keterangan4' => $this->request->getVar('keterangan4'),
            'keterangan5' => $this->request->getVar('keterangan5'),
            'status_efektivitas' => 1
        ];

        //dd($data);
        $this->efektivitas->save($data);
        return redirect()->to('/evaluasi_efektifitas_unplanned');
    }

    public function DetailEfektivitas($id)
    {
        $evaluation  = $this->tna->getDataForEvaluation($id);
        $data = [
            'tittle' => 'View Data Efektivitas',
            'evaluasi' => $evaluation
        ];
        return view('user/detailefektivitas', $data);
    }

    public function PersonalEvaluasiUnplanned()
    {
        $id = session()->get('id');
        $efektifitas = $this->tna->getDataForEvaluationUnplanned($id);
        $dataEvaluasifixed = [];

        foreach ($efektifitas as $efektif) {

            $date_training = date_create($efektif['rencana_training']);
            $date_now = date_create(date('Y-m-d'));
            $compare = date_diff($date_training, $date_now);
            $due_date = (int)$compare->format('%a');
            if ($due_date >= 90) {
                $dataEvaluasiProcess = [
                    'id_tna' => $efektif['id_tna'],
                    'nama' => $efektif['nama'],
                    'judul' => $efektif['training'],
                    'jenis' => $efektif['jenis_training'],
                    'tanggal' => $efektif['rencana_training'],
                    'status' =>  $efektif['status_efektivitas']
                ];

                array_push($dataEvaluasifixed, $dataEvaluasiProcess);
            }
        }
        //dd($evaluasi);
        $data = [
            'tittle' => 'Personal Evaluasi Efektivitas Unplanned',
            'evaluasi' => $dataEvaluasifixed
        ];
        return view('user/personalefektivitas', $data);
    }
    public function DataEvaluasiEfektivitas()
    {
        $training = $this->request->getPost('id_training');
        $data = $this->efektivitas->getIdEfektivitas($training);
        echo json_encode($data);
    }
}