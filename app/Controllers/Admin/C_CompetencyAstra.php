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

class C_CompetencyAstra extends BaseController
{
    private M_Astra $astra;
    private UserModel $user;

    private M_CompetencyAstra $competencyAstra;
    function __construct()
    {
        $this->astra = new M_Astra();
        $this->user = new UserModel();
        $this->competencyAstra = new M_CompetencyAstra();
    }

    public function InputExcel()
    {
        $file = $this->request->getFile('file');
        if ($file == "") {
            return redirect()->to('/list_astra');
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
        $user = $this->user->getUserAstra();
        // dd($user);

        for ($i = 1; $i < count($sheet); $i++) {
            $dataAstra = [
                'astra' => $sheet[$i][0],
                'proficiency' => $sheet[$i][1]
            ];
            $this->astra->save($dataAstra);
            $getAstra = $this->astra->getAstraLastRow();
            foreach ($user as $users) {
                $data = [
                    'id_user' => $users['id_user'],
                    'id_astra' => $getAstra->id_astra,
                    'score_astra' => 0
                ];
                $this->competencyAstra->save($data);
            }
        }

        return redirect()->to('/list_astra');
    }
}