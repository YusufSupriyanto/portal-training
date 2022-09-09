<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {

        $data = [
            'tittle' => 'Portal Training & Development'
        ];
        return view('user/homeuser', $data);
    }
}