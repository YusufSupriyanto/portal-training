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

class C_CompetencyExpert extends BaseController
{
    private M_Expert $expert;
    private UserModel $user;

    private M_CompetencyExpert $competencyExpert;
    function __construct()
    {
        $this->expert = new M_Expert();
        $this->user = new UserModel();
        $this->competencyExpert = new M_CompetencyExpert();
    }

    public function InputExcel()
    {
        $file = $this->request->getFile('file');
        if ($file == "") {
            return redirect()->to('/list_expert');
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
        // dd($sheet);
        $user = $this->user->getUserExpert();
        // dd($user);
        for ($i = 1; $i < count($sheet); $i++) {
            $dataExpert = [
                'expert' => $sheet[$i][0],
                'proficiency' => $sheet[$i][1]
            ];
            $this->expert->save($dataExpert);
            $getExpert = $this->expert->getExpertLastRow();
            foreach ($user as $users) {
                $data = [
                    'id_user' => $users['id_user'],
                    'id_expert' => $getExpert->id_expert,
                    'score_expert' => 0
                ];
                $this->competencyExpert->save($data);
            }
        }

        return redirect()->to('/list_expert');
    }
}