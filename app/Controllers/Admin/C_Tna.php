<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Tna;
use App\Models\UserModel;

class C_Tna extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;

    private M_Approval $approval;
    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->approval = new M_Approval();
    }
    public function index()
    {
        $tna = $this->tna->getStatusWaitAdmin();

        $data = [
            'tittle' => 'Form TNA',
            'tna' => $tna
        ];
        return view('admin/tna', $data);
    }

    public function accept()
    {

        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));

        $data = [
            'id_approval' => $approve['id_approval'],
            'id_tna' => $this->request->getPost('id_tna'),
            'biaya_actual' => $this->request->getVar('actual'),
            'metode_training' => $this->request->getVar('metode'),
            'rencana_training' => $this->request->getVar('rencana_training'),
            'status' => 'accept'
        ];

        $this->tna->save($data);
        echo json_encode($data);
    }

    public function reject()
    {
        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        $data = [
            'id_approval' => $approve['id_approval'],
            'id_tna' =>  $this->request->getPost('id_tna'),
            'biaya_actual' => $this->request->getVar('actual'),
            'metode_training' => $this->request->getVar('metode'),
            'rencana_training' => $this->request->getVar('rencana_training'),
            'status' => 'reject'
        ];
        $this->tna->save($data);
        echo json_encode($data);
    }


    public function kadivStatus()
    {
        $tna = $this->tna->getKadivStatus();
        $data = [
            'tittle' => 'Kadiv Status',
            'tna' => $tna
        ];
        return view('admin/tnakadiv', $data);
    }
}