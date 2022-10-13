<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class User extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;
    private M_TnaUnplanned $unplanned;


    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->unplanned = new M_TnaUnplanned();
    }

    public function index()
    {
        $id = session()->get('id');

        $user = $this->user->getAllUser($id);
        //dd($user);


        $data = [
            'tittle' => 'Profile',
            'person' => $user
        ];
        return view('user/profile', $data);
    }
}