<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Company;
use App\Models\M_CompetencyCompany;
use App\Models\M_EvaluasiReaksi;
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

    private M_Technical $technical;
    private M_TechnicalB $technicalB;

    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->CompanyCompetency = new M_CompetencyCompany();
        $this->company = new M_Company();
        $this->technical = new M_Technical();
        $this->technicalB = new M_TechnicalB();
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
    }
}