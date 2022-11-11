<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Deadline;
use App\Models\M_EvaluasiEfektifitas;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_History;
use App\Models\M_ListTraining;
use App\Models\M_Tna;
use App\Models\UserModel;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyTechnical;
use App\Models\M_Astra;
use App\Models\M_Budget;
use App\Models\M_Technical;

class FormTna extends BaseController
{
    private UserModel $user;
    private M_ListTraining $training;
    private M_Tna $tna;
    private M_Approval $approval;
    private M_EvaluasiReaksi $evaluasiReaksi;
    private M_EvaluasiEfektifitas $efektivitas;
    private M_History $history;

    private M_Astra $astra;
    private M_CompetencyAstra $competencyAstra;
    private M_Technical $technical;
    private M_CompetencyTechnical $competencyTechnical;

    private M_Budget $budget;


    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->user = new UserModel();
        $this->tna = new M_Tna();
        $this->approval = new M_Approval();
        $this->evaluasiReaksi = new M_EvaluasiReaksi();
        $this->history = new M_History();
        $this->efektivitas = new M_EvaluasiEfektifitas();
        $this->astra = new M_Astra();
        $this->competencyAstra = new M_CompetencyAstra();
        $this->technical = new M_Technical();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->budget = new M_Budget();
    }

    //function untuk menamplilkan data member dengan user yang akan di daftarkan tna
    public function index()
    {
        $id = session()->get('id');
        $user = $this->user->filter($id);
        $tna = $this->tna->getTnaFilter($id);
        $budget = $this->budget->getBudgetCurrent(session()->get('departemen'));

        //dd($budget);
        $data = [
            'tittle' => 'Data Member',
            'user' => $user,
            'tna' => $tna,
            'budget' => $budget
        ];
        return view('user/datamember', $data);
    }

    //function untuk menampilkan data user dan akan di daftarkan tna
    public function TnaUser()
    {
        $id = $this->request->getPost('member');


        $user = $this->user->getAllUser($id);

        $trainings = $this->training->getAll();

        $tna = $this->tna->getHistoryTna($id);

        $tnaUser = $this->tna->getUserTna($id);

        $terdaftar = $this->tna->getTnaTerdaftar($id);

        $array = [];
        foreach ($tnaUser as $usersTna) {
            $trainingUser = $this->training->getIdTraining($usersTna['id_training']);

            $trainingProcess =
                [
                    'id_training' => $usersTna['id_training'],
                    'judul_training' => $usersTna['training'],
                    'jenis_training' => $usersTna['jenis_training'],
                    'deskripsi' => $trainingUser['deskripsi'],
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

        //Filter Astra Competency

        $datas  = $this->competencyAstra->getProfileAstraCompetency($id);
        $astra = [];
        //dd($datas);
        if (!empty($datas)) {

            foreach ($datas as $data) {
                if ($data['score_astra'] < $data['proficiency']) {
                    $competency = [
                        'id' => $data['id_competency_astra'],
                        'category' => "ALC - " . $data['astra'],
                        'competency' => $data['astra'],
                        'proficiency' => $data['proficiency'],
                        'score' => $data['score_astra'],
                        'keterangan' => 'alc'
                    ];
                    array_push($astra, $competency);
                }
            }
        } else {
            $astra = [];
        }


        //Filter Tecnhnical Competency
        $datas2  = $this->competencyTechnical->getProfileTechnicalCompetency($id, $user['departemen']);
        $technical = [];
        //dd($datas);
        if (!empty($datas2)) {

            foreach ($datas2 as $dataTech) {
                if ($dataTech['score_technical'] < $dataTech['proficiency']) {
                    $competencyTech = [
                        'id' => $dataTech['id_competency_technical'],
                        'category' => "Technical Comp - " . $dataTech['technical'],
                        'competency' => $dataTech['technical'],
                        'proficiency' => $dataTech['proficiency'],
                        'score' => $dataTech['score_technical'],
                        'keterangan' => 'tc'
                    ];
                    array_push($technical, $competencyTech);
                }
            }
        } else {
            $technical = [];
        }
        $target = array_merge($astra, $technical);
        //dd($target);
        $data = [
            'tittle' => 'TRAINING NEED ANALYSIS',
            'user' => $user,
            'training' => $trainings,
            'tna' => $tna,
            'terdaftar' => $terdaftar,
            'astra' => $astra,
            'technical' => $technical,
            'target' => $target,
            'validation' => \Config\Services::validation(),
        ];
        return view('user/formtna', $data);
    }


    //function untuk status tna yang sudah dikirim ke admin
    public function status()
    {
        $id =  session()->get('id');
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');
        $seksi = session()->get('seksi');
        //dd($seksi);

        if ($bagian == 'BOD') {
            $status =  $this->tna->getStatusWaitUser($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $status =  $this->tna->getStatusWaitUser($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $status = $this->tna->getStatusWaitUser($bagian, $departemen);
        } else {
            $status =  $this->tna->getStatusWaitUser($bagian, $seksi);
        }

        //dd($status);
        $data = [
            'tittle' => 'Status TNA',
            'status' => $status,
        ];
        return view('user/statustna', $data);
    }

    public function statusPersonal()
    {
        $id =  session()->get('id');
        $status = $this->tna->getStatusPersonal($id);
        $data = [
            'tittle' => 'Status TNA',
            'status' => $status,
        ];
        return view('user/statustnapersonal', $data);
    }
    public function statusPersonalUnplanned()
    {
        $id =  session()->get('id');
        $status = $this->tna->getStatusPersonalUnplanned($id);
        $data = [
            'tittle' => 'Status Unplanned',
            'status' => $status,
        ];
        return view('user/statusunplannedpersonal', $data);
    }

    // public function statusMember()
    // {
    //     $id = session()->get('id');
    //     $data = $this->tna->getStatusWaitMember($id);
    //     dd($data);
    // }

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
        $bagian = session()->get('bagian');

        $page = basename($_SERVER['PHP_SELF']);

        if ($bagian == 'BOD') {
            $data =  $_POST['training'];

            for ($i = 0; $i < count($data); $i++) {
                $update = $this->tna->getAllTna($data[$i]);
                $tna = [
                    'id_tna' => $update[0]->id_tna,
                    'status' => 'wait',

                ];
                $approvals = $this->approval->getIdApproval($update[0]->id_tna);

                $dataApproval = [
                    'id_approval' => $approvals['id_approval'],
                    'status_approval_1' => 'accept',
                ];
                $this->tna->save($tna);
                $this->approval->save($dataApproval);
            }
            if ($page == 'send') {
                return redirect()->to('/data_member');
            } else {
                return redirect()->to('/data_member_unplanned');
            }
        } else {
            $data =  $_POST['training'];
            for ($i = 0; $i < count($data); $i++) {
                $update = $this->tna->getAllTna($data[$i]);
                $tna = [
                    'id_tna' => $update[0]->id_tna,
                    'status' => 'wait',

                ];
                $this->tna->save($tna);
            }
            if ($page == 'send') {
                return redirect()->to('/data_member');
            } else {
                return redirect()->to('/data_member_unplanned');
            }
        }
    }



    public function AjaxTna()
    {
        $id_training = $this->request->getPost('id_training');
        $jenis_trainng = $this->training->getIdTraining($id_training);

        echo json_encode($jenis_trainng);
    }

    //function untuk save tna
    public function TnaForm()
    {
        // $competency = $this->request->getPost('kompetensi');

        // $id_kompetensi = strstr($competency, "1", false);
        // $type_kompetensi = strstr($competency, ",1", true);
        // dd($type_kompetensi);

        $deadline = $this->request->getVar('deadline');
        if ($deadline == 0) {
            $kelompok = 'training';
        } else {
            $kelompok = 'unplanned';
        }

        $id_user = $this->request->getPost('id_user');
        $id = $this->request->getPost('trainingunplanned');
        if ($id == null) {
            $id_training = $_POST['training'];
        } else {
            $id_training = $id;
        }
        $user = $this->user->getAllUser($id_user);
        //dd($user);
        $jenis_trainng = $this->training->getIdTraining($id_training);

        $budget = $this->budget->getBudgetCurrent($user['departemen']);

        if ($jenis_trainng['biaya'] > $budget['available_budget']) {
            session()->setFlashdata('warning', 'Maaf');
            return redirect()->to('/data_member');
        }
        // dd($id_user);
        $data = [
            'id_user' => $id_user,
            'id_training' => $id_training,
            'id_budget' => $budget['id_budget'],
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
            'request_training' => $this->request->getVar('request'),
            'tujuan_training' => $this->request->getVar('tujuan'),
            'notes' => $this->request->getVar('notes'),
            'biaya' => $jenis_trainng['biaya'],
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


    public function requestTna()
    {
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');
        // dd($departemen);

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

        if ($bagian == 'KADEPT' || $bagian == 'KADIV') {
            return view('user/requestuser', $data);
        } else {
            return view('user/requestuserbod', $data);
        }
    }


    //function accept kadiv
    public function acceptKadiv()
    {
        $bagian = session()->get('bagian');
        $approve = $this->approval->getIdApproval($this->request->getPost('id_tna'));
        if ($bagian == 'KADIV') {
            $data = [
                'id_approval' => $approve['id_approval'],
                'id_tna' => $this->request->getPost('id_tna'),
                'status_approval_1' => 'accept'
            ];
            $this->approval->save($data);
        } else {
            $data = [
                'id_approval' => $approve['id_approval'],
                'id_tna' => $this->request->getPost('id_tna'),
                'status_approval_0' => 'accept'
            ];
            $this->approval->save($data);
        }


        echo json_encode('SUCCESS');
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