<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Astra;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyExpert;
use App\Models\M_CompetencyTechnical;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Expert;
use App\Models\M_Technical;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_Competency extends BaseController
{
    private M_Astra $astra;
    private M_Technical $technical;

    private M_Expert $expert;
    private UserModel $user;
    private M_CompetencyAstra $competencyAstra;
    private M_CompetencyExpert $competencyExpert;
    private M_CompetencyTechnical $competencyTechnical;
    public function __construct()
    {
        $this->astra = new M_Astra();
        $this->expert = new M_Expert();
        $this->technical = new M_Technical();
        $this->user = new UserModel();
        $this->competencyAstra = new M_CompetencyAstra();
        $this->competencyExpert = new M_CompetencyExpert();
        $this->competencyTechnical = new M_CompetencyTechnical();
    }

    public function astra()
    {
        $astra = $this->astra->getDataAstra();


        $data = [
            'tittle' => 'Astra Leadership Competency',
            'astra' => $astra
        ];
        return view('admin/competencyastra', $data);
    }


    //function untuk menambahkan List Astra dan Edit List Astra
    public function EditAstra()
    {
        $id_astra =  $this->request->getVar('id_astra');
        $astra =  $this->request->getVar('astra');
        $proficiency =  $this->request->getVar('proficiency');
        $user = $this->user->getUserAstra();
        // dd($user);

        if ($id_astra != "") {
            $data = [
                'id_astra' => $id_astra,
                'astra' => $astra,
                'proficiency' => $proficiency
            ];
            $this->astra->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Update');
            return redirect()->to('/list_astra');
        } else {
            $data = [
                'astra' => $astra,
                'proficiency' => $proficiency
            ];
            $this->astra->save($data);
            $list_new_astra = $this->astra->getAstraLastRow();
            foreach ($user as $users) {
                $AstraUser = [
                    'id_user' => $users['id_user'],
                    'id_astra' => $list_new_astra->id_astra,
                    'score_astra' => 0
                ];
                $this->competencyAstra->save($AstraUser);
                //d($AstraUser);
            }
            session()->setFlashdata('success', 'Data Berhasil Di Di Input');
            return redirect()->to('/list_astra');
        }
    }
    public function DeleteAstra($id)
    {
        $this->astra->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/list_astra');
    }


    public function technicalA()
    {

        $technicalA = $this->competencyTechnical->getDataDepertemenA();
        $department = $this->user->DistinctDepartemen();

        //dd($department);

        $data = [
            'tittle' => 'Department Technical Competency',
            'technicalA' => $technicalA,
            'department' => $department
        ];
        return view('admin/listtechnicalcompetencyA', $data);
    }
    public function technicalB()
    {


        $technicalB = $this->competencyTechnical->getDataDepertemenB();
        $department = $this->user->DistinctDepartemen();

        //dd($department);

        $data = [
            'tittle' => 'Department Technical Competency',
            'technicalB' => $technicalB,
            'department' => $department
        ];
        return view('admin/listtechnicalcompetencyB', $data);
    }

    public function DetailTechnical($departemen, $group)
    {
        $technical = $this->technical->getDataTechnicalDepartemen($departemen, $group);
        $department = $this->user->DistinctDepartemen();
        //dd($technical);

        $data = [
            'tittle' => 'Technical Competency',
            'technical' => $technical,
            'department' => $department,
            'departemen' => $departemen,
            'group' => $group
        ];
        return view('admin/competencytechnical', $data);
    }

    public function SaveTechnical()
    {

        $id_technical =  $this->request->getVar('id_technical');
        $technical =  $this->request->getVar('technical');
        $proficiency =  $this->request->getVar('proficiency');
        $depertemen = $this->request->getVar('department');
        $golongan = $this->request->getVar('golongan');
        //dd($golongan);

        if ($id_technical != "") {
            $data = [
                'id_technical' => $id_technical,
                'technical' => $technical,
                'departemen' => $depertemen,
                'proficiency' => $proficiency
            ];

            // dd($data);
            $this->technical->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Update');
            return redirect()->to('/technical_departemen/' . $depertemen . '/' . $golongan);
        } else {
            $data = [
                'technical' => $technical,
                'departemen' => $depertemen,
                'proficiency' => $proficiency,
                'golongan' => $golongan
            ];

            // dd($data);
            $this->technical->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Di Input');
            return redirect()->to('/technical_departemen/' . $depertemen . '/' . $golongan);
        }
    }
    public function DeleteTechnical($id)
    {
        $this->technical->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/list_technical');
    }



    public function Expert()
    {
        $expert = $this->expert->getDataExpert();
        $data = [
            'tittle' => 'Expert Behavior Competencies',
            'expert' => $expert
        ];
        return view('admin/competencyexpert', $data);
    }


    public function EditExpert()
    {
        $id_expert =  $this->request->getVar('id_expert');
        $expert =  $this->request->getVar('expert');
        $proficiency =  $this->request->getVar('proficiency');
        $user = $this->user->getUserExpert();
        // dd($id_expert);

        if ($id_expert != "") {
            $data = [
                'id_expert' => $id_expert,
                'expert' => $expert,
                'proficiency' => $proficiency
            ];
            $this->expert->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Update');
            return redirect()->to('/list_expert');
        } else {
            $data = [
                'expert' => $expert,
                'proficiency' => $proficiency
            ];
            $this->expert->save($data);
            $list_new_expert = $this->expert->getAstraLastRow();
            foreach ($user as $users) {
                $ExpertUser = [
                    'id_user' => $users['id_user'],
                    'id_expert' => $list_new_expert->id_expert,
                    'score_expert' => 0
                ];
                $this->competencyExpert->save($ExpertUser);
                //d($AstraUser);
            }
            session()->setFlashdata('success', 'Data Berhasil Di Di Input');
            return redirect()->to('/list_expert');
        }
    }

    public function DeleteExpert($id)
    {

        // dd($id);

        $this->expert->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/list_expert');
    }


    // public function InputDataTechnical()
    // {
    //     $file =  $this->request->getFile('Technical');
    //     dd($file);
    // }

    //dummy function
    public function inputAstra()
    {
        $astraUser = $this->user->getUserAstra();
        //   dd($astraUser);
        $astra = $this->astra->getDataAstra();
        foreach ($astraUser as $user) {
            for ($i = 1; $i <= 8; $i++) {
                $data = [
                    'id_astra' => $i,
                    'id_user' => $user['id_user'],
                    'score_astra' => 0

                ];
                $this->competencyAstra->save($data);
            }
        }
    }
}