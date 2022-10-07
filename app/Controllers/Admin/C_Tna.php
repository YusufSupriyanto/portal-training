<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Deadline;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_Tna extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;

    private M_Approval $approval;

    private M_TnaUnplanned $unplanned;



    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->approval = new M_Approval();
        $this->unplanned = new M_TnaUnplanned();
    }
    public function index()
    {
        $tna = $this->tna->getStatusWaitAdmin();


        //dd($deadline['deadline']);
        $data = [
            'tittle' => 'Form TNA',
            'tna' => $tna,
        ];
        return view('admin/tna', $data);
    }

    // public function change()
    // {
    //     $id = $this->request->getVar('id_deadline');
    //     $deadline = $this->request->getVar('deadline');

    //     if ($deadline == 0) {
    //         $data = [
    //             'id_deadline' => $id,
    //             'deadline' => 1
    //         ];
    //         $this->deadline->save($data);
    //         return redirect()->to('/tna');
    //     } else {
    //         $data = [
    //             'id_deadline' => $id,
    //             'deadline' => 0
    //         ];
    //         $this->deadline->save($data);
    //         return redirect()->to('/tna');
    //     }
    // }


    public function trainingMonthly()
    {

        // $date = '2022-09-30';
        $TrainingMonthly = $this->tna->getTrainingMonthly();
        // dd($TrainingMonthly[0]);

        $data = [
            'tittle' => 'Form TNA',
            'training' => $TrainingMonthly
        ];
        return view('admin/trainingmonthly', $data);
    }

    public function accept()
    {
        $data = [
            'id_tna' => $this->request->getPost('id_tna'),
            'biaya_actual' => $this->request->getPost('biaya_actual'),
            'mulai_training' => $this->request->getPost('mulai_training'),
            'rencana_training' => $this->request->getPost('rencana_training'),
            'vendor' => $this->request->getPost('vendor'),
            'tempat' => $this->request->getPost('tempat'),
            'status' => 'accept'
        ];
        // dd($data);
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
            'tittle' => 'Kadiv Status Approval',
            'tna' => $tna
        ];
        return view('admin/tnakadiv', $data);
    }


    public function kadivAccept($date)
    {

        $status = $this->tna->getKadivAccept($date);
        $data = [
            'tittle' => 'KADIV Training Accepted',
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
            'mulai_training' => $this->request->getPost('mulai_training'),
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

    public function TrainingDitolak()
    {
        $reject = $this->tna->getTrainingDitolak();

        $data = [
            'tittle' => 'Training Di Reject',
            'training' => $reject
        ];
        return view('admin/trainingreject', $data);
    }


    public function TrainingFix()
    {
        $atmp = $this->tna->getAtmp();

        $data = [
            'tittle' => 'Training Fixed',
            'Atmp' => $atmp
        ];

        return view('admin/trainingfixed', $data);
    }
}