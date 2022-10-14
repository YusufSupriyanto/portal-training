<?php

namespace App\Controllers;

use App\Models\M_Tna;
use App\Models\UserModel;

class Home extends BaseController
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
        $id = session()->get('id');
        $user = $this->user->filter($id);
        $data = [
            'tittle' => 'Portal Training & Development',
            'user' => $user
        ];
        return view('admin/home', $data);
    }
}