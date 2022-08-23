<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class FormTna extends BaseController
{
    public function index()
    {

        $data = [
            'tittle' => 'Form TNA',
        ];
        return view('user/formtna', $data);
    }
}