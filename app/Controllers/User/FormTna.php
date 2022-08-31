<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_ListTraining;
use App\Models\M_Tna;
use App\Models\UserModel;

class FormTna extends BaseController
{
    private UserModel $user;
    private M_ListTraining $training;
    private M_Tna $tna;

    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->user = new UserModel();
        $this->tna = new M_Tna();
    }
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

    public function status()
    {
        $data = [
            'tittle' => 'Status TNA',
        ];
        return view('user/statustna', $data);
    }

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

    public function TnaForm($id_user, $id_training)
    {
        $user = $this->user->getAllUser($id_user);
        $jenis_trainng = $this->training->getIdTraining($id_training);

        // dd($jenis_trainng);
        $data = [
            'id_user' => $id_user,
            'id_training' => $id_training,
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
        session()->setFlashdata('success', 'TNA Berhasil Disimpan');
        return redirect()->to('/form_tna/' . $id_user);
    }
}