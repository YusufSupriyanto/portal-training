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
        $departemen = $this->tna->getStatusWaitAdminDepartemen();
        //dd($tna);
        $data = [
            'tittle' => 'Form TNA',
            'tna' => $this->tna,
            'dept' => $departemen
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

        $TrainingMonthly = $this->tna->getTrainingMonthly();
        //dd($TrainingMonthly);

        $data = [
            'tittle' => 'Training Monthly',
            'training' => $TrainingMonthly
        ];
        return view('admin/trainingmonthly', $data);
    }

    public function accept()
    {
        $id = $this->request->getPost('id_tna');

        $tna = $this->tna->getTnaForRole($id);
        if ($tna[0]['type_golongan'] == 'A         ') {
            $angka = $this->request->getPost('biaya_actual');
            $number =  str_replace(".", "", $angka);
            $data = [
                'id_tna' => $id,
                'biaya_actual' => $number,
                'mulai_training' => $this->request->getPost('mulai_training'),
                'rencana_training' => $this->request->getPost('rencana_training'),
                'vendor' => $this->request->getPost('vendor'),
                'tempat' => $this->request->getPost('tempat'),
                'status' => 'accept'
            ];
            $id_approval = $this->approval->getIdApproval($id);
            $approval = [
                'id_approval' => $id_approval['id_approval'],
                'status_approval_0' => 'accept'
            ];
            $this->tna->save($data);
            $this->approval->save($approval);
        } else {
            $angka = $this->request->getPost('biaya_actual');
            $number =  str_replace(".", "", $angka);
            $data = [
                'id_tna' => $id,
                'biaya_actual' => $number,
                'mulai_training' => $this->request->getPost('mulai_training'),
                'rencana_training' => $this->request->getPost('rencana_training'),
                'vendor' => $this->request->getPost('vendor'),
                'tempat' => $this->request->getPost('tempat'),
                'status' => 'accept'
            ];
            $this->tna->save($data);
        }
        echo json_encode('success');
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
        $biaya_actual = $this->request->getPost('biaya_actual');
        $number =  str_replace(".", "", $biaya_actual);
        if ($number <= 2500000) {
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
            'biaya_actual' => $number,
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
            'tittle' => 'Training Rejected',
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

    public function DeleteTrainingReject()
    {
        $id = $this->request->getVar('id');
        $this->tna->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/training_ditolak');
    }
}