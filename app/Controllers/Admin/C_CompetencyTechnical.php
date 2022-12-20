<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Astra;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyTechnical;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Technical;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_CompetencyTechnical extends BaseController
{


    private M_Technical $technical;
    private M_CompetencyTechnical $competencyTechnical;
    private UserModel $user;

    public function __construct()
    {
        $this->technical = new M_Technical();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->user = new UserModel();
    }

    public function InputExcel()
    {
        $department = $this->request->getVar('department');
        $golongan = $this->request->getVar('golongan');

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

        $userTechnical = $this->user->getUserTechnicalA($department);
        //dd($userTechnical);
        for ($i = 1; $i < count($sheet); $i++) {
            $dataTechnical = [
                'technical' => $sheet[$i][0],
                'proficiency' => $sheet[$i][1],
                'departemen' => $department,
            ];
            $this->technical->save($dataTechnical);
            $technicalId = $this->technical->getTechnicalLastRow();
            foreach ($userTechnical as $users) {
                $person = [
                    'id_user' => $users['id_user'],
                    'id_technical' => $technicalId->id_technical,
                    'score_technical' => 0
                ];
                $this->competencyTechnical->save($person);
            }
        }
        return redirect()->to('/list_technicalA');
    }
}