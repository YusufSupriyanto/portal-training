<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_ListTraining;
use App\Models\M_Tna;
use App\Models\UserModel;

class FormTna extends BaseController
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

    //function untuk menamplilkan data member dengan user yang akan di daftarkan tna
    public function index()
    {
        $id = session()->get('id');
        $user = $this->user->filter($id);
        $tna = $this->tna->getTnaFilter($id);
        $data = [
            'tittle' => 'Data Member',
            'user' => $user,
            'tna' => $tna
        ];
        return view('user/datamember', $data);
    }

    //function untuk menampilkan data user dan akan di daftarkan tna
    public function TnaUser($id)
    {
        $user = $this->user->getAllUser($id);
        $trainings = $this->training->getAll();
        $tna = $this->tna->getUserTna($id);


        $data = [
            'tittle' => 'TRAINING NEED ANALYSIS',
            'user' => $user,
            'training' => $trainings,
            'tna' => $tna
        ];
        return view('user/formtna', $data);
    }

    //function untuk status tna yang sudah dikirim ke admin
    public function status()
    {
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');

        if ($bagian == 'BOD') {
            $status =  $this->tna->getStatusWaitUser($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $status =  $this->tna->getStatusWaitUser($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $status = $this->tna->getStatusWaitUser($bagian, $departemen);
        } else {
            $status  =  array();
        }

        // dd($status);
        $data = [
            'tittle' => 'Status TNA',
            'status' => $status,
        ];
        return view('user/statustna', $data);
    }

    public function approve()
    {
        $data = [
            'tittle' => 'Approve TNA',
        ];
        return view('user/approvetna', $data);
    }


    //function untuk mengupdate status tna ke wait

    public function TnaSend()
    {
        $data =  $_POST['training'];
        for ($i = 0; $i < count($data); $i++) {
            $update = $this->tna->getAllTna($data[$i]);
            $tna = [
                'id_tna' => $update[0]->id_tna,
                'status' => 'wait'
            ];
            $this->tna->save($tna);
        }
        return redirect()->to('/data_member');
    }



    public function AjaxTna()
    {
        $id_training = $this->request->getPost('id_training');
        $jenis_trainng = $this->training->getIdTraining($id_training);

        echo json_encode($jenis_trainng);
    }

    //function untuk save tna
    public function TnaForm($id_user, $id_training)
    {
        $user = $this->user->getAllUser($id_user);
        $jenis_trainng = $this->training->getIdTraining($id_training);

        // dd($jenis_trainng);
        $data = [
            'id_user' => $id_user,
            'id_training' => $id_training,
            'dic' => $user['dic'],
            'divisi' => $user['divisi'],
            'departemen' => $user['departemen'],
            'nama' => $user['nama'],
            'golongan' => null,
            'seksi' => $user['seksi'],
            'jenis_training' => $jenis_trainng['jenis_training'],
            'kategori_training' => $this->request->getVar('kategori'),
            'training' => $jenis_trainng['judul_training'],
            'metode_training' => $this->request->getVar('metode'),
            'rencana_training' => $this->request->getVar('rencana'),
            'tujuan_training' => $this->request->getVar('tujuan'),
            'notes' => $this->request->getVar('notes'),
            'biaya' => $jenis_trainng['biaya'],
            'status' => 'save',

        ];
        // dd($data);
        $this->tna->save($data);

        $id  = $this->tna->getIdTna();

        $data2 = [
            'id_tna' => $id->id_tna,
            'id_user' => $id->id_user
        ];
        $this->approval->save($data2);
        session()->setFlashdata('success', 'TNA Berhasil Disimpan');
        return redirect()->to('/form_tna/' . $id_user);
    }


    public function requestTna()
    {
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');

        if ($bagian == 'BOD') {
            $status = $this->tna->getRequestTna($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $status =  $this->tna->getRequestTna($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $status = $this->tna->getRequestTna($bagian, $departemen);
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


    //function accept kadiv
    public function acceptKadiv()
    {
        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        $data = [
            'id_approval' => $approve['id_approval'],
            'id_tna' => $this->request->getPost('id_tna'),
            'status_approval_1' => 'accept'
        ];
        $this->approval->save($data);
        echo json_encode($data);
    }
    public function rejectKadiv()
    {
        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        $data = [
            'id_approval' => $approve['id_approval'],
            'alasan' => $this->request->getPost('alasan'),
            'status_approval_1' => 'reject'
        ];
        $this->approval->save($data);
        echo json_encode($data);
    }

    public function acceptBod()
    {
        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        $data = [
            'id_approval' => $approve['id_approval'],
            'id_tna' => $this->request->getPost('id_tna'),
            'status_approval_3' => 'accept'
        ];
        $this->approval->save($data);
        echo json_encode($data);
    }

    public function rejectBod()
    {
        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        $data = [
            'id_approval' => $approve['id_approval'],
            'id_tna' => $this->request->getPost('id_tna'),
            'alasan' => $this->request->getPost('alasan'),
            'status_approval_3' => 'reject'
        ];
        $this->approval->save($data);
        echo json_encode($data);
    }
}