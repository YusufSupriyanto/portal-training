<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Astra;
use App\Models\M_Contact;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Technical;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class C_Competency extends BaseController
{
    private M_Astra $astra;
    private M_Technical $technical;
    private UserModel $user;
    public function __construct()
    {
        $this->astra = new M_Astra();
        $this->technical = new M_Technical();
        $this->user = new UserModel();
    }

    public function astra()
    {

        $astraUser = $this->user->getUserAstra();
        dd($astraUser);
        // $astra = $this->astra->getDataAstra();
        // //dd($astra);

        // $data = [
        //     'tittle' => 'Astra Leadership Competency',
        //     'astra' => $astra
        // ];
        // return view('admin/competencyastra', $data);
    }


    public function EditAstra()
    {
        $id_astra =  $this->request->getVar('id_astra');
        $astra =  $this->request->getVar('astra');
        $proficiency =  $this->request->getVar('proficiency');

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


    public function technical()
    {
        $technical = $this->technical->getDataTechnical();
        //dd($technical);

        $data = [
            'tittle' => 'Technical Competency',
            'technical' => $technical
        ];
        return view('admin/competencytechnical', $data);
    }

    public function SaveTechnical()
    {

        $id_technical =  $this->request->getVar('id_technical');
        $technical =  $this->request->getVar('technical');
        $proficiency =  $this->request->getVar('proficiency');
        $depertemen = $this->request->getVar('department');

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
            return redirect()->to('/list_technical');
        } else {
            $data = [
                'technical' => $technical,
                'departemen' => $depertemen,
                'proficiency' => $proficiency
            ];

            // dd($data);
            $this->technical->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Di Input');
            return redirect()->to('/list_technical');
        }
    }
    public function DeleteTechnical($id)
    {
        $this->technical->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/list_technical');
    }
}