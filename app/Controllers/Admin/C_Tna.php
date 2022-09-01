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

        $data = [
            'id_tna' => $tna = $this->request->getPost('id_tna'),
            'biaya_actual' => $this->request->getVar('actual'),
            'status' => 'Accept'
        ];

        $this->tna->save($data);
        echo json_encode($data);
    }
}