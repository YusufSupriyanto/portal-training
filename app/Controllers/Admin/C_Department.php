<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Astra;
use App\Models\M_Company;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyCompany;
use App\Models\M_CompetencyExpert;
use App\Models\M_CompetencySoft;
use App\Models\M_CompetencyTechnical;
use App\Models\M_CompetencyTechnicalB;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Expert;
use App\Models\M_Soft;
use App\Models\M_Technical;
use App\Models\M_TechnicalB;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_Department extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;
    private M_CompetencyCompany $CompanyCompetency;
    private M_Company $company;
    private M_Astra $astra;
    private M_Expert $expert;
    private M_Soft $soft;
    private M_Technical $technical;
    private M_TechnicalB $technicalB;
    private M_CompetencyAstra $competencyAstra;
    private M_CompetencyExpert $competencyExpert;
    private M_CompetencySoft $competencySoft;
    private M_CompetencyTechnical $competencyTechnical;

    private M_CompetencyTechnicalB $competencyTechnicalB;

    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->CompanyCompetency = new M_CompetencyCompany();
        $this->company = new M_Company();
        $this->technical = new M_Technical();
        $this->technicalB = new M_TechnicalB();
        $this->astra = new M_Astra();
        $this->expert = new M_Expert();
        $this->soft = new M_Soft();
        $this->competencyAstra = new M_CompetencyAstra();
        $this->competencyExpert = new M_CompetencyExpert();
        $this->competencySoft = new M_CompetencySoft();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->competencyTechnicalB = new M_CompetencyTechnicalB();
    }

    public function index()
    {
        $dic = $this->user->DistinctDic();
        $divisi = $this->user->DistinctDivisi();
        $department = $this->user->DistinctDepartemen();
        $seksi = $this->user->DistinctSeksi();
        $data = [
            'tittle' => 'Update Department',
            'dic' => $dic,
            'divisi' => $divisi,
            'department' => $department,
            'seksi' => $seksi
        ];
        return view('admin/department', $data);
    }


    // this function just for change name dic,division,department,seksi
    public function changeStructure()
    {
        $dic = $this->request->getPost('dic');
        $divisi = $this->request->getPost('divisi');
        $department = $this->request->getPost('department');
        $seksi = $this->request->getPost('seksi');

        if ($dic != null) {
            $Datadic =  $this->user->getDataByDic($dic[0]);
            foreach ($Datadic as $DataDic) {
                $Data = [
                    'id_user' => $DataDic['id_user'],
                    'dic' => $dic[1]
                ];
                $this->user->save($Data);
            }
        }
        if ($divisi != null) {
            $Datadivisi = $this->user->getDataByDivisi($divisi[0]);

            foreach ($Datadivisi as $DataDivisi) {
                $Data = [
                    'id_user' => $DataDivisi['id_user'],
                    'divisi' => $divisi[1]
                ];
                $this->user->save($Data);
                //save
            }

            // change name Division In Company Technical
            $Datadivisicompetency = $this->company->getDataCompanyDivisi($divisi[0]);

            if (!empty($Datadivisicompetency)) {
                foreach ($Datadivisicompetency as $DataCompetency) {
                    $DataCompetency = [
                        'id_company' => $DataCompetency['id_company'],
                        'divisi' => $divisi[1]
                    ];
                    //just save name division in database
                    //save 
                    $this->company->save($DataCompetency);
                }
            }
        }
        if ($department != null) {
            $Datadepartment = $this->user->getDataByDepartment($department[0]);
            foreach ($Datadepartment as $DataDepartment) {
                $Data = [
                    'id_user' => $DataDepartment['id_user'],
                    'departemen' => $department[1]
                ];
                $this->user->save($Data);
            }

            // change name department in Database Technical Group A
            $DataCompetencyTechnicalA =  $this->technical->getDataTechnicalDepartemen($department[0]);

            if (!empty($DataCompetencyTechnicalA)) {
                foreach ($DataCompetencyTechnicalA as $DataDepartmentA) {
                    $DataTechnicalA = [
                        'id_technical' => $DataDepartmentA['id_technical'],
                        'departemen' => $department[1]
                    ];
                    // just save name department in database
                    //save
                    $this->technical->save($DataTechnicalA);
                }
            }

            $DataCompetencyTechnicalB = $this->technicalB->getDataByDepartment($department[0]);
            if (!empty($DataCompetencyTechnicalB)) {
                foreach ($DataCompetencyTechnicalB as $DataDepartmentB) {
                    $DataTechnicalB = [
                        'id_technicalB' => $DataDepartmentB['id_technicalB'],
                        'departemen' => $department[1]
                    ];
                    // just save name department in database
                    //save
                    $this->technicalB->save($DataCompetencyTechnicalB);
                }
            }
        }
        if ($seksi != null) {
            $Dataseksi = $this->user->getDataBySeksi($seksi[0]);
            foreach ($Dataseksi as $DataSeksi) {
                $DataSeksi = [
                    'id_user' => $DataSeksi['id_user'],
                    'seksi' => $seksi[1]
                ];
                //just save name seksi
                //save
                $this->user->save($DataSeksi);
            }
        }
        return redirect()->to('/database_department');
    }


    //this function for Add New Name Department
    public function NewDepartment()
    {
        ini_set('max_execution_time', 300);

        $file = $this->request->getFile('department');
        if ($file == "") {
            return redirect()->to('/database_department');
        }
        $ext = $file->getClientExtension();
        if ($ext == 'xls') {
            $render = new
                \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new
                \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        for ($i = 1; $i < count($sheet); $i++) {
            $user = $this->user->GetUserByNPK($sheet[$i][0]);
            // dd($user);
            $users = [
                'id_user' => $user['id_user'],
                'dic' => $sheet[$i][2],
                'divisi' => $sheet[$i][3],
                'departemen' => $sheet[$i][4],
                'type_golongan' => $sheet[$i][5],
                'type_user' => $sheet[$i][6]
            ];

            // $data_old = [
            //     'type_golongan' => trim($user['type_golongan'], " "),
            //     'type_user' => trim($user['type_user'], " ")
            // ];

            $data_new = [
                'type_golongan' => $sheet[$i][5],
                'type_user' => $sheet[$i][6]
            ];
            //$compare = array_diff($data_new, $data_old);
            if (trim($data_new['type_golongan']) == 'A') {
                if (trim($data_new['type_user']) == 'REGULAR') {
                    //$Astra = "Check";
                    $old_competency = $this->competencyAstra->getAstraIdCompetency($user['id_user']);
                    //check data sudah ada atau belum
                    if (!empty($old_competency)) {
                        $Astra = $this->astra->getAllIdAstra();

                        for ($i = 0; $i < count($old_competency); $i++) {
                            foreach ($Astra as $key => $values) {
                                if (in_array($values['astra'], $old_competency[$i])) {
                                    unset($Astra[$key]);
                                }
                            }
                        }

                        if (!empty($Astra)) {
                            foreach ($Astra as $astra) {
                                $DataAstra = [
                                    'id_user' => $user['id_user'],
                                    'id_astra' => $astra['id_astra'],
                                    'score_astra' => 0
                                ];
                                // $this->competencyAstra->save($DataAstra);
                                //dd($DataAstra);
                            }
                        }
                    } else {
                        $Astra = $this->astra->getAllIdAstra();
                        foreach ($Astra as $AstraCompetency) {
                            $DataAstraEmpty = [
                                'id_astra' => $AstraCompetency['id_astra'],
                                'id_user' => $user['id_user'],
                                'score_astra' => 0
                            ];

                            //save
                            // $this->competencyAstra->save($DataAstraEmpty);
                        }
                    }
                } else {
                    $old_competency = $this->competencyExpert->getProfileExpertCompetency($user['id_user']);
                    $Expert = $this->expert->getDataExpert();
                    // check data sudah ada atau belum
                    if (!empty($old_competency)) {

                        for ($i = 0; $i < count($old_competency); $i++) {
                            foreach ($Expert as $key => $values) {
                                if (in_array($values['id_expert'], $old_competency[$i])) {
                                    unset($Expert[$key]);
                                }
                            }
                        }

                        if (!empty($Expert)) {
                            foreach ($Expert as $expert) {
                                $DataExpert = [
                                    'id_user' => $user['id_user'],
                                    'id_astra' => $expert['id_expert'],
                                    'score_expert' => 0
                                ];
                                // save
                                // $this->competencyExpert->save($DataExpert);
                            }
                        }
                    } else {
                        $Expert = $this->expert->getAllIdExpert();
                        //$test = 'Masuk';
                        foreach ($Expert as $expert) {
                            $DataExpert = [
                                'id_user' => $user['id_user'],
                                'id_expert' => $expert['id_expert'],
                                'score_expert' => 0
                            ];
                            //save
                            //$this->competencyExpert->save($DataExpert);
                        }
                    }
                }
            } else {
                $old_competency = $this->competencySoft->getProfileSoftCompetency($user['id_user']);
                //check data sudah ada atau belum
                if (!empty($old_competency)) {
                    $Soft = $this->soft->getAllIdSoft();
                    for ($i = 0; $i < count($old_competency); $i++) {
                        foreach ($Soft as $key => $values) {
                            if (in_array($values['id_soft'], $old_competency[$i])) {
                                unset($Soft[$key]);
                            }
                        }
                    }

                    if (!empty($Soft)) {
                        foreach ($Soft as $soft) {
                            $DataSoft = [
                                'id_user' => $user['id_user'],
                                'id_soft' => $soft['id_soft'],
                                'score_soft' => 0
                            ];
                            //save 
                            // $this->competencySoft->save($DataSoft);
                        }
                    }
                } else {
                    $Soft = $this->soft->getAllIdSoft();
                    foreach ($Soft as $soft) {
                        $DataSoft = [
                            'id_user' => $user['id_user'],
                            'id_soft' => $soft['id_soft'],
                            'score_soft' => 0
                        ];
                        //save 
                        // $this->competencySoft->save($DataSoft);
                    }
                }
            }
            //$this->user->save($users);
        }
        return redirect()->to('/database_department');
    }


    //function For Update Or Join Name Department
    public function UpdateNameDepartment()
    {
        $file = $this->request->getFile('update');

        if ($file == "") {
            return redirect()->to('/database_department');
        }
        $ext = $file->getClientExtension();
        if ($ext == 'xls') {
            $render = new
                \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new
                \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();



        for ($i = 1; $i < count($sheet); $i++) {
            $user = $this->user->GetUserByNPK($sheet[$i][0]);

            $users = [
                'id_user' => $user['id_user'],
                'dic' => $sheet[$i][2],
                'divisi' => $sheet[$i][3],
                'departemen' => $sheet[$i][4],
                'type_golongan' => $sheet[$i][5],
                'type_user' => $sheet[$i][6],
                'nama_jabatan' => $sheet[$i][7]
            ];
            // dd($users);

            //cek apakah type golongan di Update
            if (trim($user['type_golongan']) != trim($sheet[$i][5])) {



                //Jika Type User A
                if (trim($sheet[$i][5]) == 'A') {

                    //Jika User Regular
                    if (trim($sheet[$i][6]) == 'REGULAR') {
                        $Astra = $this->competencyAstra->getProfileAstraCompetency($user['id_user']);
                        //Jika Technical A Kosong
                        if (empty($Astra)) {
                            $AstraCompetency = $this->astra->getAllIdAstra();

                            foreach ($AstraCompetency as $CompetencyUser) {
                                $AstraUser = [
                                    'id_user' => $user['id_user'],
                                    'id_astra' => $CompetencyUser['id_astra'],
                                    'score_astra' => 0
                                ];
                                //$this->competencyAstra->save($AstraUser);
                            }
                            //Jika Technical A tidak Kosong
                        } else {

                            $AstraCompetency = $this->astra->getDataAstra();

                            for ($A = 0; $A < count($Astra); $A++) {
                                foreach ($AstraCompetency as $key => $values) {
                                    if (in_array($values['astra'], $Astra[$A])) {
                                        unset($AstraCompetency[$key]);
                                    }
                                }
                            }

                            if (!empty($AstraCompetency)) {
                                foreach ($AstraCompetency as $CompetencyUser) {
                                    $AstraUser = [
                                        'id_user' => $user['id_user'],
                                        'id_astra' => $CompetencyUser['id_astra'],
                                        'score_astra' => 0
                                    ];
                                    //$this->competencyAstra->save($AstraUser);
                                }
                            }
                        }
                        //Jika User Expert
                    } else {
                        $Expert  = $this->competencyExpert->getProfileExpertCompetency($user['id_user']);
                        // dd($Expert);
                        $ExpertCompetency = $this->expert->getAllIdExpert();


                        if (empty($Expert)) {

                            foreach ($ExpertCompetency as $CompetencyUser) {
                                $ExpertUser = [
                                    'id_user' => $user['id_user'],
                                    'id_expert' => $CompetencyUser['id_expert'],
                                    'score_expert' => 0
                                ];
                                //$this->competencyExpert->save($ExpertUser);
                            }
                        } else {

                            $ExpertCompetency = $this->expert->getDataExpert();

                            for ($E = 0; $E < count($Expert); $E++) {
                                foreach ($ExpertCompetency as $key => $values) {
                                    if (in_array($values['expert'], $Expert[$E])) {
                                        unset($ExpertCompetency[$key]);
                                    }
                                }
                            }

                            if (!empty($$ExpertCompetency)) {
                                foreach ($ExpertCompetency as $CompetencyUser) {
                                    $ExpertUser = [
                                        'id_user' => $user['id_user'],
                                        'id_expert' => $CompetencyUser['id_expert'],
                                        'score_expert' => 0
                                    ];
                                    // $this->competencyExpert->save($ExpertUser);
                                }
                            }
                        }
                    }

                    //Jika Type User B
                } else {

                    $Soft = $this->competencySoft->getProfileSoftCompetency($user['id_user']);
                    if (empty($Soft)) {
                        $SoftCompetency = $this->soft->getAllIdSoft();

                        foreach ($SoftCompetency as $CompetencyUser) {
                            $SoftUser = [
                                'id_user' => $user['id_user'],
                                'id_soft' => $CompetencyUser['id_soft'],
                                'score_soft' => 0
                            ];
                            //$this->competencyAstra->save($AstraUser);
                        }
                    } else {
                        $SoftCompetency = $this->soft->getDataSoft();
                        for ($S = 0; $S < count($Soft); $S++) {
                            foreach ($SoftCompetency as $key => $values) {
                                if (in_array($values['soft'], $Soft[$S])) {
                                    unset($SoftCompetency[$key]);
                                }
                            }
                        }

                        if (!empty($SoftCompetency)) {
                            foreach ($SoftCompetency as $CompetencyUser) {
                                $SoftUser = [

                                    'id_user' => $user['id_user'],
                                    'id_soft' => $CompetencyUser['id_soft'],
                                    'score_soft' => 0
                                ];
                                //save
                            }
                        }
                    }
                }
            }



            if (trim($user['departemen']) != trim($sheet[$i][4])) {

                //Jika Golongan User A
                if (trim($sheet[$i][5]) == 'A') {
                    $CompetencyUser  = $this->competencyTechnical->getProfileTechnicalCompetencyDept($user['id_user'], trim($sheet[$i][4]));

                    $all_technical_competency = $this->competencyTechnical->getProfileTechnicalCompetency($user['id_user']);

                    //Jika Technical A Tidak Kosong
                    if (!empty($CompetencyUser)) {
                        $CompetencyDepartment = $this->technical->getDataTechnicalDepartemen(trim($sheet[$i][4]));

                        for ($TI0 = 0; $TI0 < count($CompetencyUser); $TI0++) {
                            foreach ($CompetencyDepartment as $key => $values) {
                                if (in_array($values['technical'], $CompetencyUser[$TI0])) {
                                    unset($CompetencyDepartment[$key]);
                                }
                            }
                        }

                        $DuplicateCompetency = [];
                        if (!empty($CompetencyDepartment)) {
                            for ($TI1 = 0; $TI1 < count($all_technical_competency); $TI1++) {
                                foreach ($CompetencyDepartment as $key => $values) {
                                    if (in_array($values['technical'], $all_technical_competency[$TI1])) {
                                        array_push($DuplicateCompetency, $CompetencyDepartment[$key]);
                                        unset($CompetencyDepartment[$key]);
                                    }
                                }
                            }
                        }


                        if (!empty($DuplicateCompetency)) {

                            $SameCompetency = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));

                            foreach ($SameCompetency as $competency) {
                                $technical_score = $this->competencyTechnical->getProfileTechnicalCompetencyValue($user['id_user'], $competency['technical']);
                                $TechnicalSame = [
                                    'id_user' => $user['id_user'],
                                    'id_technical' => $competency['id_technical'],
                                    'score_techncial' => $technical_score[0]['score_technical']

                                ];
                                // $this->competencyTechnical->save($TechnicalSame);
                            }
                        }

                        //jika Technical A Kosong
                    } else {

                        $CompetencyDepartment = $this->technical->getDataTechnicalDepartemen(trim($sheet[$i][4]));

                        $DuplicateCompetency = [];
                        for ($TK0 = 0; $TK0 < count($all_technical_competency); $TK0++) {
                            foreach ($CompetencyDepartment as $key => $values) {
                                if (in_array($values['technical'], $all_technical_competency[$TK0])) {
                                    array_push($DuplicateCompetency, $CompetencyDepartment[$key]);
                                    unset($CompetencyDepartment[$key]);
                                }
                            }
                        }

                        if (!empty($CompetencyDepartment)) {
                            foreach ($CompetencyDepartment as $Competency) {
                                $DataTechnical = [
                                    'id_user' => $user['id_user'],
                                    'id_technical' => $Competency['id_technical'],
                                    'score_technical' => 0
                                ];

                                //save
                            }
                        }

                        if (!empty($DuplicateCompetency)) {
                            $SameCompetency = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));

                            foreach ($SameCompetency as $competency) {
                                $technical_score = $this->competencyTechnical->getProfileTechnicalCompetencyValue($user['id_user'], $competency['technical']);
                                $TechnicalSame = [
                                    'id_user' => $user['id_user'],
                                    'id_technical' => $competency['id_technical'],
                                    'score_techncial' => $technical_score[0]['score_technical']

                                ];
                                // $this->competencyTechnical->save($TechnicalSame);
                            }
                        }
                    }
                    //Jika Golongan User B
                } else {

                    //Kurang filter nama jabatan
                    $CompetencyUser = $this->competencyTechnicalB->getProfileTechnicalCompetencyBDepartment($user['id_user'], trim($sheet[$i][4]));
                    $all_technical_competencyB = $this->competencyTechnicalB->getProfileTechnicalCompetencyB($user['id_user']);
                    if (!empty($CompetencyUser)) {
                        $CompetencyDepartment = $this->technicalB->getDataByDepartmentSeksi(trim($sheet[$i][7]), trim($sheet[$i][4]));

                        for ($TBI = 0; $TBI < count($CompetencyUser); $TBI++) {
                            foreach ($CompetencyDepartment as $key => $values) {
                                if (in_array($CompetencyDepartment['technicalB'], $CompetencyUser[$TBI])) {
                                    unset($CompetencyDepartment[$key]);
                                }
                            }
                        }

                        if (!empty($CompetencyDepartment)) {

                            foreach ($CompetencyDepartment as $Competency) {
                                $DataTechnical = [
                                    'id_user' => $user['id_user'],
                                    'id_technicalB' => $Competency['id_technicalB'],
                                    'score' => 0
                                ];
                                //save
                            }
                        }

                        if (!empty($DuplicateCompetency)) {
                            $SameCompetency = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));
                            foreach ($SameCompetency as $Competency) {
                                $technical_score = $this->technicalB->getDataTechnicalByName($Competency['technicalB']);
                                $TechnicalSame = [
                                    'id_user' => $user['id_user'],
                                    'id_technicalB' => $Competency['id_technicalB'],
                                    'Score' => $technical_score[0]['score']
                                ];
                                //save
                            }
                        }

                        //Mengcapeee

                    } else {
                        $CompetencyDepartment = $this->technicalB->getDataByDepartmentSeksi(trim($sheet[$i][7]), trim($sheet[$i][4]));

                        $DuplicateCompetency = [];
                        for ($TBK = 0; $TBK < count($all_technical_competencyB); $TBK++) {
                            foreach ($CompetencyUser as $key => $values) {
                                if (in_array($values['technicalB'], $all_technical_competencyB[$TBK])) {
                                    array_push($DuplicateCompetency, $CompetencyUser[$key]);
                                    unset($CompetencyUser[$key]);
                                }
                            }
                        }

                        if (!empty($CompetencyDepartment)) {
                            foreach ($CompetencyDepartment as $Competency) {
                                $DataTechnical = [
                                    'id_user' => $user['id_user'],
                                    'id_technicalB' => $Competency['id_technicalB'],
                                    'score' => 0
                                ];
                                //save
                                //dd($DataTechnical);
                            }
                        }

                        if (!empty($DuplicateCompetency)) {

                            $SameCompetency = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));
                            foreach ($SameCompetency as $Competency) {
                                $technical_score = $this->technicalB->getDataTechnicalByName($Competency['technicalB']);
                                $TechnicalSame = [
                                    'id_user' => $user['id_user'],
                                    'id_technicalB' => $Competency['id_technicalB'],
                                    'Score' => $technical_score[0]['score']
                                ];
                                //save
                            }
                        }
                    }
                }
            }
            // if (trim($user['divisi']) == trim($sheet[$i][3])) {
            // }
        }
    }
}