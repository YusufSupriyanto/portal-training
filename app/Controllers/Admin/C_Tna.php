<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\User\FormTna;
use App\Models\M_Approval;
use App\Models\M_Budget;
use App\Models\M_Deadline;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_Tna extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;

    private M_Approval $approval;

    private M_Budget $budget;
    private C_Budget $budgetC;

    private M_TnaUnplanned $unplanned;

    private FormTna $UserTna;




    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->approval = new M_Approval();
        $this->unplanned = new M_TnaUnplanned();
        $this->budget = new M_Budget();
        $this->budgetC = new C_Budget();
        $this->UserTna = new FormTna();
    }
    public function index()
    {
        $departemen = $this->tna->getStatusWaitAdminDepartemen();
        // dd('test');
        $data = [
            'tittle' => 'Form TNA',
            'tna' => $this->tna,
            'dept' => $departemen,
            'budget' => $this->budget
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
        $angka = $this->request->getPost('biaya_actual');
        $rupiah = $this->budgetC->strFilter($angka);
        // $rupiah =  str_replace(".", "", $angka);
        $budgets = $this->budget->getBudgetCurrent($tna[0]['departemen']);
        if ($budgets['temporary_calculation'] != null) {
            $budgetData = [
                'id_budget' => $budgets['id_budget'],
                'temporary_calculation' => $budgets['temporary_calculation'] + $rupiah
            ];
            $this->budget->save($budgetData);
        } else {
            $budgetData = [
                'id_budget' => $budgets['id_budget'],
                'temporary_calculation' =>  $rupiah
            ];
            $this->budget->save($budgetData);
        }
        if ($tna[0]['type_golongan'] == 'A         ') {

            $data = [
                'id_tna' => $id,
                'biaya_actual' => $rupiah,
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
            $data = [
                'id_tna' => $id,
                'biaya_actual' => $rupiah,
                'mulai_training' => $this->request->getPost('mulai_training'),
                'rencana_training' => $this->request->getPost('rencana_training'),
                'vendor' => $this->request->getPost('vendor'),
                'tempat' => $this->request->getPost('tempat'),
                'status' => 'accept'
            ];
            $this->tna->save($data);
        }
        echo json_encode('Success');
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

        $departemen = $this->tna->getKadivAcceptDistinct($date);
        $data = [
            'tittle' => 'KADIV Training Accepted',
            'departemen' => $departemen,
            'stat' => $this->tna,
            'date' => $date,
            'budget' => $this->budget
        ];
        return view('admin/kadivaccept', $data);
    }

    public function acceptAdmin()
    {

        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        $biaya_actual = $this->request->getPost('biaya_actual');

        $Rupiah  = $this->budgetC->strFilter($biaya_actual);
        // $rupiah =  str_replace(".", "", $biaya_actual);
        $tna =  $this->tna->getAllTna($this->request->getPost('id_tna'));
        $budget = $this->budget->getDataBudgetById($tna[0]->id_budget);
        if ($Rupiah < $tna[0]->biaya_actual) {
            $total =  $tna[0]->biaya_actual - $Rupiah;
            $sum = $budget['temporary_calculation'] - $total;
            $dataBudget = [
                'id_budget' => $tna[0]->id_budget,
                'temporary_calculation' => $sum
            ];
            $this->budget->save($dataBudget);
        } elseif ($Rupiah > $tna[0]->biaya_actual) {
            $total = $Rupiah - $tna[0]->biaya_actual;
            $sum = $budget['temporary_calculation'] + $total;
            $dataBudget = [
                'id_budget' => $tna[0]->id_budget,
                'temporary_calculation' => $sum
            ];
            $this->budget->save($dataBudget);
        }
        if ($Rupiah <= 2500000) {
            $tna =  $this->tna->getAllTna($this->request->getPost('id_tna'));
            $budget = $this->budget->getDataBudgetById($tna[0]->id_budget);
            $dataBudget = [
                'id_budget' => $budget['id_budget'],
                'used_budget' => $budget['used_budget'] + $tna[0]->biaya_actual,
                'available_budget' => $budget['available_budget'] - $tna[0]->biaya_actual
            ];
            $this->budget->save($dataBudget);
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
            'biaya_actual' => $Rupiah,
            'vendor' => $this->request->getPost('vendor')
        ];

        // $fulldata = array_merge($data, $data1);

        $this->tna->save($data1);
        $this->approval->save($data);
        echo json_encode('SUCCESS');
    }

    public function rejectAdmin()
    {
        $id = $this->request->getPost('id_tna');

        $approve = $this->approval->getIdApproval($id);
        $biaya_actual = $this->request->getPost('biaya_actual');
        $Rupiah  = $this->budgetC->strFilter($biaya_actual);
        $training = $this->tna->getAllTna($id);
        $this->UserTna->subtraction($Rupiah, $training[0]->departemen);
        $data1 = [
            'id_tna' => $this->request->getPost('id_tna'),
            'biaya_actual' => $Rupiah,
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


    public function TrainingNotImplemented()
    {
        $training = $this->approval->getTrainingNotImplemented();
        //dd($training);

        $data = [
            'tittle' => 'Training Tidak Terlaksana',
            'training' => $training
        ];
        return view('admin/trainingnotimplemented', $data);
    }
}