<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Astra;
use App\Models\M_Company;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyCompany;
use App\Models\M_CompetencyTechnical;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Technical;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_CompetencyCompany extends BaseController
{
    private M_Company $company;
    private UserModel $user;

    private M_CompetencyCompany  $competencyCompany;

    // private M_Competency $competencyAstra;
    function __construct()
    {
        $this->company = new M_Company();
        $this->user = new UserModel();
        $this->competencyCompany = new M_CompetencyCompany();
    }

    public function index()
    {
        $company = $this->company->getDataCompany();
        $divisi = $this->user->DistinctDivisi();
        $CompanyDivisi = $this->competencyCompany->getDataDivisi();



        $data = [
            'tittle' => 'Company General Competency',
            'company' => $company,
            'divisi' => $divisi,
            'CompanyDivisi' => $CompanyDivisi
        ];
        return view('admin/list_company', $data);
    }

    public function InputExcel()
    {
        $divisi = $this->request->getVar('divisi');
        // dd($divisi);
        $file = $this->request->getFile('company');
        if ($file == "") {
            return redirect()->to('/list_company');
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

        $userCompany = $this->user->getUserDivisi($divisi);
        // dd($userCompany);
        for ($i = 1; $i < count($sheet); $i++) {
            $dataCompany = [
                'company' => $sheet[$i][0],
                'proficiency' => $sheet[$i][1],
                'divisi' => $divisi,

            ];
            $this->company->save($dataCompany);
            $companylId = $this->company->getCompanyLastRow();
            foreach ($userCompany as $users) {
                $person = [
                    'id_user' => $users['id_user'],
                    'id_company' => $companylId->id_company,
                    'score_company' => 0
                ];
                $this->competencyCompany->save($person);
            }
        }
        return redirect()->to('/list_company');
    }

    public function DetailCompany($divisi)
    {
        $company = $this->company->getDataCompanyDivisi($divisi);
        $division = $this->user->DistinctDivisi();
        //dd($company);

        $data = [
            'tittle' => 'Company General Competency',
            'company' => $company,
            'divisi' => $division,
            'division' => $divisi
        ];
        return view('admin/competencycompany', $data);
    }

    public function EditCompany()
    {

        $id_company =  $this->request->getVar('id_company');
        $company =  $this->request->getVar('company');
        $proficiency =  $this->request->getVar('proficiency');
        $division = $this->request->getVar('divisi');

        if ($id_company != "") {
            $data = [
                'id_company' => $id_company,
                'company' => $company,
                'divisi' => $division,
                'proficiency' => $proficiency
            ];

            // dd($data);
            $this->company->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Update');
            return redirect()->to('/list_company');
        } else {
            $data = [
                'company' => $company,
                'divisi' => $division,
                'proficiency' => $proficiency
            ];

            // dd($data);
            $this->company->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Input');
            return redirect()->to('/list_company');
        }
    }


    public function Delete($id)
    {
        $this->company->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/list_company');
    }
}