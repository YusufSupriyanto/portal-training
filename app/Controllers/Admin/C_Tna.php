<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Tna;
use App\Models\UserModel;

class C_Tna extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;
    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
    }
    public function index()
    {
        $tna = $this->tna->getStatusWait();

        $data = [
            'tittle' => 'Form TNA',
            'tna' => $tna
        ];
        return view('admin/tna', $data);
    }

    public function accept()
    {
        $tna = $this->request->getPost('btn-accept');
        dd($tna);
        $data = [
            'id_tna' => $tna[0]->id_tna,
            'biaya_actual' => $this->request->getVar('actual'),
            'status' => 'Accept'
        ];

        dd($data);
    }
}