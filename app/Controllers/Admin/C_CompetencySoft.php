<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Astra;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencySoft;
use App\Models\M_CompetencyTechnical;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Soft;
use App\Models\M_Technical;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_CompetencySoft extends BaseController
{
    private M_Soft $Soft;
    private UserModel $user;

    private M_CompetencySoft $competencySoft;

    // private M_CompetencySoft $competencySoft;
    function __construct()
    {
        $this->Soft = new M_Soft();
        $this->user = new UserModel();
        $this->competencySoft = new M_CompetencySoft();
        // $this->competencySoft = new M_CompetencySoft();
    }


    public function index()
    {
        $soft = $this->Soft->getDatasoft();



        $data = [
            'tittle' => 'Astra Leadership Competency',
            'soft' => $soft
        ];
        return view('admin/list_soft', $data);
    }

    public function InputExcel()
    {
        $file = $this->request->getFile('file');
        if ($file == "") {
            return redirect()->to('/list_soft');
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
        $user = $this->user->getGroupB();
        //dd($user);

        for ($i = 1; $i < count($sheet); $i++) {
            $dataSoft = [
                'soft' => $sheet[$i][0],
                'proficiency' => $sheet[$i][1]
            ];
            $this->Soft->save($dataSoft);
            $getSoft = $this->Soft->getSoftLastRow();
            foreach ($user as $users) {
                $data = [
                    'id_user' => $users['id_user'],
                    'id_soft' => $getSoft->id_soft,
                    'score_soft' => 0
                ];
                $this->competencySoft->save($data);
            }
        }

        return redirect()->to('/list_soft');
    }

    public function EditSoft()
    {
        $id_soft =  $this->request->getVar('id_soft');
        $soft =  $this->request->getVar('soft');
        $proficiency =  $this->request->getVar('proficiency');
        $user = $this->user->getGroupB();
        // dd($user);

        if ($id_soft != "") {
            $data = [
                'id_soft' => $id_soft,
                'soft' => $soft,
                'proficiency' => $proficiency
            ];
            $this->Soft->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Update');
            return redirect()->to('/list_soft');
        } else {
            $data = [
                'soft' => $soft,
                'proficiency' => $proficiency
            ];
            $this->Soft->save($data);
            $list_new_soft = $this->Soft->getAstraLastRow();
            foreach ($user as $users) {
                $softUser = [
                    'id_user' => $users['id_user'],
                    'id_soft' => $list_new_soft->id_soft,
                    'score_soft' => 0
                ];
                $this->competencySoft->save($softUser);
                //d($AstraUser);
            }
            session()->setFlashdata('success', 'Data Berhasil Di Input');
            return redirect()->to('/list_soft');
        }
    }

    public function Delete($id)
    {
        $this->Soft->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/list_soft');
    }
}