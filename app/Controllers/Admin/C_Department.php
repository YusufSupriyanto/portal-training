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
    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->CompanyCompetency = new M_CompetencyCompany();
        $this->company = new M_Company();
        $this->technical = new M_Technical();
        $this->technicalB = new M_TechnicalB();
        $this->astra = new M_Astra();
        $this->soft = new M_Soft();
        $this->competencyAstra = new M_CompetencyAstra();
        $this->competencyExpert = new M_CompetencyExpert();
        $this->competencySoft = new M_CompetencySoft();
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
                //$this->user->save($Data);
            }
        }
        if ($divisi != null) {
            $Datadivisi = $this->user->getDataByDivisi($divisi[0]);
            $Datadivisicompetency = $this->company->getDataCompanyDivisi($divisi[0]);
            foreach ($Datadivisi as $DataDivisi) {
                $Data = [
                    'id_user' => $DataDivisi['id_user'],
                    'divisi' => $divisi[1]
                ];
                // d($Data);
                //save
            }
            foreach ($Datadivisicompetency as $DataCompetency) {
                $DataCompetency = [
                    'id_company' => $DataCompetency['id_company'],
                    'divisi' => $divisi[1]
                ];
                // d($DataCompetency);
                //save
            }
        }
        if ($department != null) {
            $Datadepartment = $this->user->getDataByDepartment($department[0]);
            foreach ($Datadepartment as $DataDepartment) {
                $Data = [
                    'id_user' => $DataDepartment['id_user'],
                    'departemen' => $department[1]
                ];
                //  $this->
            }
            $DataCompetencyTechnicalA =  $this->technical->getDataTechnicalDepartemen($department[0]);
            foreach ($DataCompetencyTechnicalA as $DataDepartmentA) {
                $DataTechnicalA = [
                    'id_technical' => $DataDepartmentA['id_technical'],
                    'departemen' => $department[1]
                ];
                //save
            }
            $DataCompetencyTechnicalB = $this->technicalB->getDataByDepartment($department[0]);
            foreach ($DataCompetencyTechnicalB as $DataDepartmentB) {
                $DataTechnicalB = [
                    'id_technicalB' => $DataDepartmentB['id_technicalB'],
                    'departemen' => $department[1]
                ];
                //save
            }
        }
        if ($seksi != null) {
            $Dataseksi = $this->user->getDataByDepartment($seksi[0]);
            foreach ($Dataseksi as $DataSeksi) {
                $DataSeksi = [
                    'id_technicalB' => $DataDepartmentB['id_technicalB'],
                    'departemen' => $department[1]
                ];
                //save
            }
        }
        return redirect()->to('/database_department');
    }

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

            $data_old = [
                'type_golongan' => trim($user['type_golongan'], " "),
                'type_user' => trim($user['type_user'], " ")
            ];

            $data_new = [
                'type_golongan' => $sheet[$i][5],
                'type_user' => $sheet[$i][6]
            ];

            $compare = array_diff($data_new, $data_old);
            // dd($different);
            if (!empty($compare)) {
                if (array_key_exists("type_golongan", $compare)) {
                    if (trim($compare['type_golongan']) == 'A') {
                        if (array_key_exists("type_user", $compare)) {
                            if (trim($compare['type_user']) == 'REGULAR') {
                                //$Astra = "Check";
                                $old_competency = $this->competencyAstra->getAstraIdCompetency($user['id_user']);
                                //check data sudah ada atau belum
                                if (!empty($old_competency)) {
                                    $Astra = $this->astra->getAllIdAstra();
                                    for ($i = 0; $i < count($old_competency); $i++) {
                                        foreach ($Astra as $key => $values) {
                                            if (in_array($values['id_astra'], $old_competency[$i])) {
                                                unset($Astra[$key]);
                                            }
                                        }
                                    }
                                    foreach ($Astra as $astra) {
                                        $DataAstra = [
                                            'id_user' => $user['id_user'],
                                            'id_astra' => $astra['id_astra'],
                                            'score_astra' => 0
                                        ];
                                        $this->competencyAstra->save($DataAstra);
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
                                        $this->competencyAstra->save($DataAstraEmpty);
                                    }
                                }
                            } else {
                                $old_competency  = $this->competencyExpert->getProfileExpertCompetency($user['id_user']);
                                // check data sudah ada atau belum
                                if (!empty($Expert)) {
                                    $Expert =  $this->expert->getAllIdExpert();
                                    for ($i = 0; $i < count($old_competency); $i++) {
                                        foreach ($Expert as $key => $values) {
                                            if (in_array($values['id_expert'], $old_competency[$i])) {
                                                unset($Expert[$key]);
                                            }
                                        }
                                    }
                                    foreach ($Expert as $expert) {
                                        $DataExpert = [
                                            'id_user' => $user['id_user'],
                                            'id_astra' => $expert['id_expert'],
                                            'score_expert' => 0
                                        ];
                                        // save
                                        $this->competencyExpert->save($DataExpert);
                                    }
                                } else {
                                    $Expert =  $this->expert->getAllIdExpert();
                                    foreach ($Expert as $expert) {
                                        $DataExpert = [
                                            'id_user' => $user['id_user'],
                                            'id_expert' => $expert['id_expert'],
                                            'score_expert' => 0
                                        ];
                                        //save
                                        $this->competencyExpert->save($DataExpert);
                                    }
                                }
                            }
                        }
                    } else {
                        $old_competency =  $this->competencySoft->getProfileSoftCompetency($user['id_user']);
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
                            foreach ($Soft as $soft) {
                                $DataSoft = [
                                    'id_user' => $user['id_user'],
                                    'id_soft' => $soft['id_soft'],
                                    'score_soft' => 0
                                ];
                                //save 
                                $this->competencySoft->save($DataSoft);
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
                                $this->competencySoft->save($DataSoft);
                            }
                        }
                    }
                }
            }
            $this->user->save($users);
        }
        return redirect()->to('/database_department');
    }
}