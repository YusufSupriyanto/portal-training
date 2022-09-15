<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Tna;
use App\Models\UserModel;

class C_History extends BaseController
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

        $user = $this->user->getAllUser();

        $users = [];
        foreach ($user as $users) {
            $training = $this->tna->getTnaUser($users['id_user']);
            //     $historyData = [
            //     'nama' => $user->nama,
            //     'jumlah_training' => 
            // ];
        }



        $data = [
            'tittle' => 'History Training',
            // 'user' => $history,
        ];
        return view('admin/history', $data);
    }
}