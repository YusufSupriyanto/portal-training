<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiEfektifitas;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_ListTraining;
use App\Models\UserModel;
use App\Models\M_Approval;
use App\Models\M_History;
use App\Models\M_TnaUnplanned;
use PhpParser\Builder\Function_;

class UnplannedTraining extends BaseController
{
    private UserModel $user;
    private M_ListTraining $training;
    private M_Tna $tna;
    private M_Approval $approval;
    private M_EvaluasiReaksi $evaluasiReaksi;
    private M_EvaluasiEfektifitas $efektivitas;
    private M_History $history;

    private M_TnaUnplanned $unplanned;
    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->user = new UserModel();
        $this->tna = new M_Tna();
        $this->approval = new M_Approval();
        $this->evaluasiReaksi = new M_EvaluasiReaksi();
        $this->history = new M_History();
        $this->efektivitas = new M_EvaluasiEfektifitas();
        $this->unplanned = new M_TnaUnplanned();
    }
    public function index()
    {
        $id = session()->get('id');
        $user = $this->user->filter($id);
        $tna = $this->tna->getTnaFilterUnplanned($id);
        $data = [
            'tittle' => 'Data Member',
            'user' => $user,
            'tna' => $tna
        ];
        return view('user/datamemberunplanned', $data);
    }

    public function TnaUserUnplanned()
    {
        $id = $this->request->getPost('member');
        $value = $this->request->getPost('training');
        // $trainingId = $this->training->getIdTraining($id);
        // dd($id);
        $user = $this->user->getAllUser($id);
        $trainings = $this->training->getAll();
        $unplannedHistory = $this->unplanned->getHistoryUnplanned($id);
        $unplannedTerdaftar = $this->unplanned->getUnplannedTerdaftar($id);
        $unplanTraining = $this->unplanned->getUserTna($id);

        $array = [];
        foreach ($unplanTraining as $usersTna) {
            $id = $this->training->getIdTraining($usersTna['id_training']);
            $trainingProcess =
                [
                    'id_training' => $usersTna['id_training'],
                    'judul_training' => $usersTna['training'],
                    'jenis_training' => $usersTna['jenis_training'],
                    'deskripsi' => $id['deskripsi'],
                    'vendor' => $usersTna['vendor'],
                    'biaya' => $usersTna['biaya']
                ];
            array_push($array, $trainingProcess);
        }
        for ($i = 0; $i < count($array); $i++) {
            foreach ($trainings as $key => $arr) {
                // echo $arr['id_training'];
                if (in_array($arr['id_training'], $array[$i])) {
                    unset($trainings[$key]);
                }
            }
        }
        $data = [
            'tittle' => 'Unplanned Training',
            'user' => $user,
            'training' => $trainings,
            'value' => $value,
            'tna' => $unplannedHistory,
            'terdaftar' => $unplannedTerdaftar,
            'validation' => \Config\Services::validation(),
        ];
        return view('user/formtnaunplanned', $data);
    }


    public function requestUnplanned()
    {
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');

        if ($bagian == 'BOD') {
            $status = $this->unplanned->getRequestTnaUnplanned($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $status =  $this->unplanned->getRequestTnaUnplanned($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $status = $this->unplanned->getRequestTnaUnplanned($bagian, $departemen);
        } else {
            $status  =  array();
        }
        $data = [
            'tittle' => 'Request Tna',
            'status' => $status
        ];
        if (session()->get('bagian') == 'KADIV') {
            return view('user/requestuser', $data);
        }
        return view('user/requestuserbod', $data);
    }

    public function status()
    {
        $id =  session()->get('id');
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');

        if ($bagian == 'BOD') {
            $status =  $this->unplanned->getStatusWaitUser($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $status =  $this->unplanned->getStatusWaitUser($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $status = $this->unplanned->getStatusWaitUser($bagian, $departemen);
        } else {
            $status =  $this->unplanned->getStatusWaitUser($bagian, $dic, $id);
        }

        // dd($status);
        $data = [
            'tittle' => 'Status TNA',
            'status' => $status,
        ];
        return view('user/statustna', $data);
    }

    public function Unplanned()
    {
        $id = $this->request->getPost('member');
        $training = $this->request->getPost('training');
        $jenis = $this->request->getPost('jenis');
        $kategori = $this->request->getPost('kategori');
        $metode = $this->request->getPost('metode');
        $start = $this->request->getPost('start');
        $end = $this->request->getPost('end');
        $budget = $this->request->getPost('budget');
        // $trainingId = $this->training->getIdTraining($id);
        // dd($value);
        $user = $this->user->getAllUser($id);
        $tna = $this->unplanned->getUserTnaUnplanned($id);
        //dd($value);
        $data = [
            'tittle' => 'Unplanned Training',
            'user' => $user,
            'id_training' => $this->request->getPost('id_training'),
            'training' => $training,
            'jenis' => $jenis,
            'kategori' => $kategori,
            'metode' => $metode,
            'start' => $start,
            'end' => $end,
            'budget' => $budget,
            'tna' => $tna,
            'validation' => \Config\Services::validation(),
        ];
        //dd($data);
        return view('user/formunplannedtna', $data);
    }

    public function UnplannedSave()
    {

        $deadline = $this->request->getVar('deadline');
        if ($deadline == 0) {
            $kelompok = 'training';
        } else {
            $kelompok = 'unplanned';
        }

        $id_user = $this->request->getPost('id_user');
        $id_training = $this->request->getVar('id_training');

        if (!$this->validate([
            'tujuan' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/form_tna')->withInput()->with('validation', $validation);
        }
        $user = $this->user->getAllUser($id_user);
        $jenis_trainng = $this->training->getIdTraining($id_training);

        $data = [
            'id_user' => $id_user,
            'id_training' => $id_training,
            'dic' => $user['dic'],
            'divisi' => $user['divisi'],
            'departemen' => $user['departemen'],
            'nama' => $user['nama'],
            'golongan' => null,
            'seksi' => $user['seksi'],
            'jenis_training' => $this->request->getVar('jenis_training'),
            'kategori_training' => $this->request->getVar('kategori'),
            'training' => $this->request->getVar('training'),
            'metode_training' => $this->request->getVar('metode'),
            'mulai_training' => $this->request->getVar('rencanaFirst'),
            'rencana_training' => $this->request->getVar('rencana'),
            'tujuan_training' => $this->request->getVar('tujuan'),
            'notes' => $this->request->getVar('notes'),
            'biaya' => $this->request->getVar('budget'),
            'biaya_actual' => $this->request->getVar('budget'),
            'status' => 'save',
            'kelompok_training' => $kelompok

        ];
        //dd($data);
        $this->tna->save($data);

        $id  = $this->tna->getIdTna();

        $data2 = [
            'id_tna' => $id->id_tna,
            'id_user' => $id->id_user
        ];
        $data3 = [
            'id_tna' => $id->id_tna,
        ];
        $data4 = [
            'id_tna' => $id->id_tna
        ];
        $data5 = [
            'id_tna' => $id->id_tna,
            'id_user' => $id_user
        ];
        $this->approval->save($data2);
        $this->evaluasiReaksi->save($data3);
        $this->history->save($data4);
        $this->efektivitas->save($data5);

        session()->setFlashdata('success', 'TNA Berhasil Disimpan');
        if ($kelompok == 'training') {
            return redirect()->to('/data_member');
        } else {
            return redirect()->to('/data_member_unplanned');
        }
    }

    public function DataTraining()
    {
        $id = $this->request->getPost('id_training');

        $data = $this->tna->getIdTna($id);

        echo json_encode($data);
    }
}