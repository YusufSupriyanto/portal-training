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


    public function trainingMonthly()
    {

        $date = $this->tna->getDateTraining();
        dd($date);

        $data = [
            'tittle' => 'Form TNA',
            'date' => $date
        ];
        return view('admin/trainingmonthly', $data);
    }

    public function accept()
    {
        $data = [
            'id_tna' => $this->request->getPost('id_tna'),
            'biaya_actual' => $this->request->getPost('biaya_actual'),
            'rencana_training' => $this->request->getPost('rencana_training'),
            'status' => 'accept'
        ];
        $this->tna->save($data);
        echo json_encode($data);
    }

    public function reject()
    {

        $data = [
            'id_tna' =>  $this->request->getPost('id_tna'),
            'biaya_actual' => $this->request->getPost('biaya_actual'),
            'rencana_training' => $this->request->getPost('rencana_training'),
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


    public function kadivAccept()
    {


        $status = $this->tna->getKadivAccept();

        $data = [
            'tittle' => 'Kadiv accept',
            'status' => $status
        ];
        return view('admin/kadivaccept', $data);
    }

    public function acceptAdmin()
    {

        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        $biaya_actual = (int) $this->request->getPost('biaya_actual');
        if ($biaya_actual <= 2500000) {
            $data = [
                'id_approval' => $approve['id_approval'],
                'status_approval_2' => 'accept',
                'status_approval_3' => 'accept'
            ];
        } else {
            $data = [
                'id_approval' => $approve['id_approval'],
                'status_approval_2' => 'accept',
            ];
        }

        $data1 = [
            'id_tna' => $this->request->getPost('id_tna'),
            'rencana_training' => $this->request->getPost('rencana_training'),
            'biaya_actual' => $this->request->getPost('biaya_actual'),
        ];

        // $fulldata = array_merge($data, $data1);


        $this->tna->save($data1);
        $this->approval->save($data);
        echo json_encode($data);
    }

    public function rejectAdmin()
    {

        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        $data1 = [
            'id_tna' => $this->request->getPost('id_tna'),
            'biaya_actual' => $this->request->getPost('biaya_actual'),
        ];

        $data = [
            'id_approval' => $approve['id_approval'],
            'alasan' => $this->request->getPost('alasan'),
            'status_approval_2' => 'reject'
        ];

        $this->tna->save($data1);
        $this->approval->save($data);
        echo json_encode($data);
    }

    public function detailTna()
    {
        $id_tna = $this->request->getPost('id_tna');
        $data = $this->tna->getAllTna($id_tna);
        echo json_encode($data);
    }

    public function detailReject()
    {
        $id = $this->request->getPost('id_tna');
        $data = $this->approval->getIdApproval($id);
        echo json_encode($data);
    }
}