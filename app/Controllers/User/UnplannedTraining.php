<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiEfektifitas;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_ListTraining;
use App\Models\UserModel;
use App\Models\M_Approval;
use App\Models\M_Budget;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyCompany;
use App\Models\M_CompetencyExpert;
use App\Models\M_CompetencySoft;
use App\Models\M_CompetencyTechnical;
use App\Models\M_CompetencyTechnicalB;
use App\Models\M_History;
use App\Models\M_Nilai;
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
    private M_Budget $budget;

    private M_CompetencyAstra $competencyAstra;
    private M_CompetencyExpert $competencyExpert;
    private M_CompetencyTechnical $competencyTechnical;
    private M_CompetencySoft $competencySoft;
    private M_CompetencyTechnicalB $competencyTechnicalB;
    private M_CompetencyCompany $competencyCompany;

    private M_Nilai $nilai;
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
        $this->budget = new M_Budget();
        $this->competencyAstra = new M_CompetencyAstra();
        $this->competencyCompany = new M_CompetencyCompany();
        $this->competencyExpert = new M_CompetencyExpert();
        $this->competencySoft = new M_CompetencySoft();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->competencyTechnicalB = new M_CompetencyTechnicalB();
        $this->nilai = new M_Nilai();
    }
    public function index()
    {
        $id = session()->get('id');
        $user = $this->user->filter($id);

        $departemen = $this->unplanned->getTnaFilterDistinct($id);

        $tna = $this->unplanned->getTnaFilterUnplanned($id);

        $budget = $this->budget->getBudgetCurrent(session()->get('departemen'));
        // dd($tna);
        //  dd($departemen);
        $data = [
            'tittle' => 'Data Member',
            'user' => $user,
            'tna' => $tna,
            'departemen' => $departemen,
            'budget' => $budget,
            'tnaKadept' => $this->unplanned,
            'budgetKadept' => $this->budget
        ];
        return view('user/datamemberunplanned', $data);
    }

    public function TnaUserUnplanned()
    {
        $id = $this->request->getPost('member');
        $user = $this->user->getAllUser($id);
        $trainings = $this->training->getAll();
        $unplannedHistory = $this->unplanned->getHistoryUnplanned($id);
        $unplannedTerdaftar = $this->unplanned->getUnplannedTerdaftar($id);
        $unplanTraining = $this->unplanned->getUserTna($id);

        $array = [];
        foreach ($unplanTraining as $usersTna) {
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

        if ($user['type_golongan'] == 'A         ' && $user['type_user'] == 'REGULAR             ') {
            //Filter Astra Competency
            $datas  = $this->competencyAstra->getProfileAstraCompetency($id);
            $astra = [];
            if (!empty($datas)) {

                foreach ($datas as $data) {
                    if ($data['score_astra'] < $data['proficiency']) {
                        $competency = [
                            'id' => $data['id_competency_astra'],
                            'category' => "ALC - " . $data['astra'],
                            'competency' => $data['astra'],
                            'proficiency' => $data['proficiency'],
                            'score' => $data['score_astra'],
                            'keterangan' => 'Astra'
                        ];
                        array_push($astra, $competency);
                    }
                }
            } else {
                $astra = [];
            }
            //Filter Tecnhnical Competency
            $datas2  = $this->competencyTechnical->getProfileTechnicalCompetency($id);
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
                            'keterangan' => 'TechnicalA'
                        ];
                        array_push($technical, $competencyTech);
                    }
                }
            } else {
                $technical = [];
            }
            $target = array_merge($astra, $technical);
            $data = [
                'tittle' => 'UNPLANNED TRAINING',
                'user' => $user,
                'training' => $trainings,
                'tna' => $unplannedHistory,
                'terdaftar' => $unplannedTerdaftar,
                'astra' => $astra,
                'technical' => $technical,
                'target' => $target,
                'validation' => \Config\Services::validation(),
            ];
        } elseif ($user['type_golongan'] == 'A         ' && $user['type_user'] == 'EXPERT              ') {
            //Filter Expert Competency
            $dataExpert  = $this->competencyExpert->getProfileExpertCompetency($id);
            $Expert = [];
            if (!empty($dataExpert)) {

                foreach ($dataExpert as $DataExpert) {
                    if ($DataExpert['score_expert'] < $DataExpert['proficiency']) {
                        $competency = [
                            'id' => $DataExpert['id_competency_expert'],
                            'category' => "Exp - " . $DataExpert['expert'],
                            'competency' => $DataExpert['expert'],
                            'proficiency' => $DataExpert['proficiency'],
                            'score' => $DataExpert['score_expert'],
                            'keterangan' => 'Expert'
                        ];
                        array_push($Expert, $competency);
                    }
                }
            } else {
                $Expert = [];
            }
            //Filter Tecnhnical Competency
            $datas2  = $this->competencyTechnical->getProfileTechnicalCompetency($id);
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
                            'keterangan' => 'TechnicalA'
                        ];
                        array_push($technical, $competencyTech);
                    }
                }
            } else {
                $technical = [];
            }
            $target = array_merge($Expert, $technical);
            $data = [
                'tittle' => 'UNPLANNED TRAINING',
                'user' => $user,
                'training' => $trainings,
                'tna' => $unplannedHistory,
                'terdaftar' => $unplannedTerdaftar,
                'expert' => $Expert,
                'technical' => $technical,
                'target' => $target,
                'validation' => \Config\Services::validation(),
            ];
        } else {
            $dataCompany  = $this->competencyCompany->getProfileCompanyCompetency($id);
            $Company = [];
            if (!empty($dataCompany)) {

                foreach ($dataCompany as $DataCompany) {
                    if ($DataCompany['score_company'] < $DataCompany['proficiency']) {
                        $competency = [
                            'id' => $DataCompany['id_competency_company'],
                            'category' => "Comp - " . $DataCompany['company'],
                            'competency' => $DataCompany['company'],
                            'proficiency' => $DataCompany['proficiency'],
                            'score' => $DataCompany['score_company'],
                            'keterangan' => 'Company'
                        ];
                        array_push($Company, $competency);
                    }
                }
            } else {
                $Company = [];
            }
            $dataSoft  = $this->competencySoft->getProfileSoftCompetency($id);
            $Soft = [];
            if (!empty($dataSoft)) {

                foreach ($dataSoft as $DataSoft) {
                    if ($DataSoft['score_soft'] < $DataSoft['proficiency']) {
                        $competency = [
                            'id' => $DataSoft['id_competency_soft'],
                            'category' => "Soft - " . $DataSoft['soft'],
                            'competency' => $DataSoft['soft'],
                            'proficiency' => $DataSoft['proficiency'],
                            'score' => $DataSoft['score_soft'],
                            'keterangan' => 'Soft'
                        ];
                        array_push($Soft, $competency);
                    }
                }
            } else {
                $Soft = [];
            }
            $dataTechnicalB  = $this->competencyTechnicalB->getProfileTechnicalCompetencyB($id);
            $TechnicalB = [];
            if (!empty($dataTechnicalB)) {

                foreach ($dataTechnicalB as $dataTechnicalB) {
                    if ($dataTechnicalB['score'] < $dataTechnicalB['proficiency']) {
                        $competency = [
                            'id' => $dataTechnicalB['id_competency_technicalB'],
                            'category' => "TechB - " . $dataTechnicalB['technicalB'],
                            'competency' => $dataTechnicalB['technicalB'],
                            'proficiency' => $dataTechnicalB['proficiency'],
                            'score' => $dataTechnicalB['score'],
                            'keterangan' => 'TechnicalB'
                        ];
                        array_push($TechnicalB, $competency);
                    }
                }
            } else {
                $TechnicalB = [];
            }
            $target = array_merge($Soft, $Company, $TechnicalB);
            $data = [
                'tittle' => 'UNPLANNED TRAINING',
                'user' => $user,
                'training' => $trainings,
                'tna' => $unplannedHistory,
                'terdaftar' => $unplannedTerdaftar,
                'soft' => $Soft,
                'technicalB' => $TechnicalB,
                'company' => $Company,
                'target' => $target,
                'validation' => \Config\Services::validation(),
            ];
        }

        return view('user/formtnaunplanned', $data);
    }


    public function requestUnplanned()
    {
        $bagian = session()->get('bagian');
        $dic = session()->get('dic');
        $divisi = session()->get('divisi');
        $departemen = session()->get('departemen');

        if ($bagian == 'BOD') {
            $dept = $this->unplanned->getRequestTnaUnplannedDistinct($bagian, $dic);
        } elseif ($bagian == 'KADIV') {
            $dept =  $this->unplanned->getRequestTnaUnplannedDistinct($bagian, $divisi);
        } elseif ($bagian == 'KADEPT') {
            $dept = $this->unplanned->getRequestTnaUnplannedDistinct($bagian, $departemen);
        } else {
            $dept  =  array();
        }


        $data = [
            'tittle' => 'Request Unplanned',
            'departemen' => $dept,
            'status' => $this->unplanned,
            'budget' => $this->budget
        ];
        if ($bagian == 'KADIV' || $bagian == 'KADEPT') {
            return view('user/requestuser', $data);
        } else {
            return view('user/requestuserbod', $data);
        }
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
        $user = $this->user->getAllUser($id);
        $unplannedHistory = $this->unplanned->getHistoryUnplanned($id);
        $unplannedTerdaftar = $this->unplanned->getUnplannedTerdaftar($id);

        if ($user['type_golongan'] == 'A         ' && $user['type_user'] == 'REGULAR             ') {
            //Filter Astra Competency
            $datas  = $this->competencyAstra->getProfileAstraCompetency($id);
            $astra = [];
            if (!empty($datas)) {

                foreach ($datas as $data) {
                    if ($data['score_astra'] < $data['proficiency']) {
                        $competency = [
                            'id' => $data['id_competency_astra'],
                            'category' => "ALC - " . $data['astra'],
                            'competency' => $data['astra'],
                            'proficiency' => $data['proficiency'],
                            'score' => $data['score_astra'],
                            'keterangan' => 'Astra'
                        ];
                        array_push($astra, $competency);
                    }
                }
            } else {
                $astra = [];
            }
            //Filter Tecnhnical Competency
            $datas2  = $this->competencyTechnical->getProfileTechnicalCompetency($id);
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
                            'keterangan' => 'TechnicalA'
                        ];
                        array_push($technical, $competencyTech);
                    }
                }
            } else {
                $technical = [];
            }
            $target = array_merge($astra, $technical);
            $data = [
                'tittle' => 'UNPLANNED TRAINING',
                'user' => $user,
                'training' => $training,
                'id_training' => $this->request->getPost('id_training'),
                'tna' => $unplannedHistory,
                'jenis' => $jenis,
                'kategori' => $kategori,
                'metode' => $metode,
                'start' => $start,
                'end' => $end,
                'budget' => $budget,
                'terdaftar' => $unplannedTerdaftar,
                'astra' => $astra,
                'technical' => $technical,
                'target' => $target,
                'validation' => \Config\Services::validation(),
            ];
        } elseif ($user['type_golongan'] == 'A         ' && $user['type_user'] == 'EXPERT              ') {
            //Filter Expert Competency
            $dataExpert  = $this->competencyExpert->getProfileExpertCompetency($id);
            $Expert = [];
            if (!empty($dataExpert)) {

                foreach ($dataExpert as $DataExpert) {
                    if ($DataExpert['score_expert'] < $DataExpert['proficiency']) {
                        $competency = [
                            'id' => $DataExpert['id_competency_expert'],
                            'category' => "Exp - " . $DataExpert['expert'],
                            'competency' => $DataExpert['expert'],
                            'proficiency' => $DataExpert['proficiency'],
                            'score' => $DataExpert['score_expert'],
                            'keterangan' => 'Expert'
                        ];
                        array_push($Expert, $competency);
                    }
                }
            } else {
                $Expert = [];
            }
            //Filter Tecnhnical Competency
            $datas2  = $this->competencyTechnical->getProfileTechnicalCompetency($id);
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
                            'keterangan' => 'TechnicalA'
                        ];
                        array_push($technical, $competencyTech);
                    }
                }
            } else {
                $technical = [];
            }
            $target = array_merge($Expert, $technical);
            $data = [
                'tittle' => 'UNPLANNED TRAINING',
                'user' => $user,
                'training' => $training,
                'id_training' => $this->request->getPost('id_training'),
                'tna' => $unplannedHistory,
                'jenis' => $jenis,
                'kategori' => $kategori,
                'metode' => $metode,
                'start' => $start,
                'end' => $end,
                'budget' => $budget,
                'terdaftar' => $unplannedTerdaftar,
                'expert' => $Expert,
                'technical' => $technical,
                'target' => $target,
                'validation' => \Config\Services::validation(),
            ];
        } else {
            $dataCompany  = $this->competencyCompany->getProfileCompanyCompetency($id);
            $Company = [];
            if (!empty($dataCompany)) {

                foreach ($dataCompany as $DataCompany) {
                    if ($DataCompany['score_company'] < $DataCompany['proficiency']) {
                        $competency = [
                            'id' => $DataCompany['id_competency_company'],
                            'category' => "Comp - " . $DataCompany['company'],
                            'competency' => $DataCompany['company'],
                            'proficiency' => $DataCompany['proficiency'],
                            'score' => $DataCompany['score_company'],
                            'keterangan' => 'Company'
                        ];
                        array_push($Company, $competency);
                    }
                }
            } else {
                $Company = [];
            }
            $dataSoft  = $this->competencySoft->getProfileSoftCompetency($id);
            $Soft = [];
            if (!empty($dataSoft)) {

                foreach ($dataSoft as $DataSoft) {
                    if ($DataSoft['score_soft'] < $DataSoft['proficiency']) {
                        $competency = [
                            'id' => $DataSoft['id_competency_soft'],
                            'category' => "Soft - " . $DataSoft['soft'],
                            'competency' => $DataSoft['soft'],
                            'proficiency' => $DataSoft['proficiency'],
                            'score' => $DataSoft['score_soft'],
                            'keterangan' => 'Soft'
                        ];
                        array_push($Soft, $competency);
                    }
                }
            } else {
                $Soft = [];
            }
            $dataTechnicalB  = $this->competencyTechnicalB->getProfileTechnicalCompetencyB($id);
            $TechnicalB = [];
            if (!empty($dataTechnicalB)) {

                foreach ($dataTechnicalB as $dataTechnicalB) {
                    if ($dataTechnicalB['score'] < $dataTechnicalB['proficiency']) {
                        $competency = [
                            'id' => $dataTechnicalB['id_competency_technicalB'],
                            'category' => "TechB - " . $dataTechnicalB['technicalB'],
                            'competency' => $dataTechnicalB['technicalB'],
                            'proficiency' => $dataTechnicalB['proficiency'],
                            'score' => $dataTechnicalB['score'],
                            'keterangan' => 'TechnicalB'
                        ];
                        array_push($TechnicalB, $competency);
                    }
                }
            } else {
                $TechnicalB = [];
            }
            $target = array_merge($Soft, $Company, $TechnicalB);
            $data = [
                'tittle' => 'UNPLANNED TRAINING',
                'user' => $user,
                'training' => $training,
                'id_training' => $this->request->getPost('id_training'),
                'tna' => $unplannedHistory,
                'jenis' => $jenis,
                'kategori' => $kategori,
                'metode' => $metode,
                'start' => $start,
                'end' => $end,
                'budget' => $budget,
                'terdaftar' => $unplannedTerdaftar,
                'soft' => $Soft,
                'technicalB' => $TechnicalB,
                'company' => $Company,
                'target' => $target,
                'validation' => \Config\Services::validation(),
            ];
        }


        // $data = [
        //     'tittle' => 'Unplanned Training',
        //     'user' => $user,
        //     'id_training' => $this->request->getPost('id_training'),
        //     'training' => $training,
        //     'jenis' => $jenis,
        //     'kategori' => $kategori,
        //     'metode' => $metode,
        //     'start' => $start,
        //     'end' => $end,
        //     'budget' => $budget,
        //     'terdaftar' => $unplannedTerdaftar,
        //     'tna' => $unplannedHistory,
        //     'validation' => \Config\Services::validation(),
        // ];
        //dd($data);
        return view('user/formunplannedtna', $data);
    }

    public function UnplannedSave()
    {

        $competency = $this->request->getPost('kompetensi');
        // dd($competency);


        $type_kompetensi = explode(",", $competency);
        //dd($type_kompetensi);
        // dd($type_kompetensi);

        $deadline = $this->request->getVar('deadline');
        if ($deadline == 0) {
            $kelompok = 'training';
        } else {
            $kelompok = 'unplanned';
        }

        $id_user = $this->request->getPost('id_user');
        $id_trainings = $this->request->getVar('id_training');
        if ($id_trainings == null) {
            $id_training = $_POST['training'];
        } else {
            $id_training = $id_trainings;
        }
        $user = $this->user->getAllUser($id_user);

        if (!$this->validate([
            'tujuan' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/form_tna')->withInput()->with('validation', $validation);
        }
        $user = $this->user->getAllUser($id_user);
        $jenis_trainng = $this->training->getIdTraining($id_training);

        $budget = $this->budget->getBudgetCurrent($user['departemen']);

        if (empty($budget['available_budget'])) {
            session()->setFlashdata('warning', 'Maaf');
            return redirect()->to('/data_member');
        } else {
            if ($jenis_trainng['biaya'] > $budget['available_budget']) {
                session()->setFlashdata('warning', 'Maaf');
                return redirect()->to('/data_member');
            }
        }

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

        $nilai = [
            'id_tna' => $id->id_tna,
            'id_competency1' => $type_kompetensi[0],
            'type_competency1' => $type_kompetensi[1]
        ];
        //dd($nilai);


        $this->nilai->save($nilai);
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
        $training = $this->request->getPost('training');

        // $data = $this->tna->getTnaByid($id);

        echo json_encode($training);
    }
}