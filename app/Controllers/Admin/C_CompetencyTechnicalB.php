<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Astra;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyTechnical;
use App\Models\M_CompetencyTechnicalB;
use App\Models\M_Technical;
use App\Models\M_TechnicalB;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_CompetencyTechnicalB extends BaseController
{


    private M_Technical $technical;
    private M_CompetencyTechnical $competencyTechnical;
    private UserModel $user;
    private M_TechnicalB $technicalB;

    private M_CompetencyTechnicalB $competencyTechnicaLB;

    public function __construct()
    {
        $this->technical = new M_Technical();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->user = new UserModel();
        $this->technicalB = new M_TechnicalB();
        $this->competencyTechnicaLB = new M_CompetencyTechnicalB();
    }


    public function InputExcel()
    {
        $department = $this->request->getVar('department');

        $file = $this->request->getFile('technical');
        if ($file == "") {
            return redirect()->to('/list_technical');
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
        //dd($sheet[1][2]);
        $data = [];
        for ($i = 1; $i < count($sheet); $i++) {
            $dataTechnicalB = [
                'technicalB' => $sheet[$i][0],
                'kepala_sub_seksi' => (int) $sheet[$i][1],
                'kepala_regu' => $sheet[$i][2],
                'staff' => $sheet[$i][3],
                'data_entry' => $sheet[$i][4],
                'operator' => $sheet[$i][5],
                'security' => $sheet[$i][6],
                'supply_man' => $sheet[$i][7],
                'supporting_assembly_a' => $sheet[$i][8],
                'supporting_assembly_b' => $sheet[$i][9],
                'driver_forklift' => $sheet[$i][10],
                'driver' => $sheet[$i][11],
                'department' => $department
            ];
            $this->technicalB->save($dataTechnicalB);
            $id_technicalB = $this->technicalB->getTechnicalBLastRow();
            $userB = $this->user->getUserTechnicalB($department);
            foreach ($userB as $users) {
                $dataUser = [
                    'id_technicalB' => $id_technicalB->id_technicalB,
                    'id_user' => $users['id_user'],
                    'score' => 0
                ];
                $this->competencyTechnicaLB->save($dataUser);
            }
        }

        return redirect()->to('/list_technicalB');
    }


    public function DetailTechnical($department)
    {
        $department0 = $this->technicalB->getDataTechnicalBDepartemen($department);
        $data = [
            'tittle' => 'Technical Competency',
            'department' => $department,
            'department0' => $department0
        ];
        return view('admin/competencytechnicalB', $data);
    }


    public function SaveSingleTechnical()
    {
        $id  = $this->request->getVar('id_technical');
        $technical = $this->request->getVar('technical');
        $kesubsek = $this->request->getVar('kesubsek');
        $kepreg = $this->request->getVar('kepreg');
        $staff = $this->request->getVar('staff');
        $ade = $this->request->getVar('ade');
        $operator = $this->request->getVar('operator');
        $security = $this->request->getVar('security');
        $supply = $this->request->getVar('supply');
        $assembling_a = $this->request->getVar('assembling_a');
        $assembling_b = $this->request->getVar('assembling_b');
        $driver_forklift = $this->request->getVar('driver_forklift');
        $driver = $this->request->getVar('driver');
        $department = $this->request->getVar('department');

        if ($id != "") {
            $data = [
                'id_technicalB' => $id,
                'technicalB' => $technical,
                'kepala_sub_seksi' => $kesubsek,
                'kepala_regu' => $kepreg,
                'staff' => $staff,
                'data_entry' => $ade,
                'operator' => $operator,
                'security' => $security,
                'supply' => $supply,
                'supporting_assembly_a' => $assembling_a,
                'supporting_assembly_b' => $assembling_b,
                'driver_forklift' => $driver_forklift,
                'driver' => $driver
            ];
            $this->technicalB->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Update');
            return redirect()->to('technical_departemen/' . $department);
        } else {
            $data = [
                'technicalB' => $technical,
                'kepala_sub_seksi' => $kesubsek,
                'kepala_regu' => $kepreg,
                'staff' => $staff,
                'data_entry' => $ade,
                'operator' => $operator,
                'security' => $security,
                'supply' => $supply,
                'supporting_assembly_a' => $assembling_a,
                'supporting_assembly_b' => $assembling_b,
                'driver_forklift' => $driver_forklift,
                'driver' => $driver
            ];
            $this->technicalB->save($data);
            $id_technicalB = $this->technicalB->getTechnicalBLastRow();
            $userB = $this->user->getUserTechnicalB($department);
            foreach ($userB as $users) {
                $dataUser = [
                    'id_technicalB' => $id_technicalB->id_technicalB,
                    'id_user' => $users['id_user'],
                    'score' => 0
                ];
                $this->competencyTechnicaLB->save($dataUser);
            }
            session()->setFlashdata('success', 'Data Berhasil Di Simpan');
            return redirect()->to('technical_departemen/' . $department);
        }
    }

    public function Delete($id, $department)
    {

        // d($id);
        // d($department);
        $this->technicalB->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Simpan');
        return redirect()->to('technical_departemen/' . $department);
    }
}