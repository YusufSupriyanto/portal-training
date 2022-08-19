<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class C_Tna extends BaseController
{
    public function index()
    {

        $data = [
            'tittle' => 'Form TNA',
        ];
        return view('admin/tna', $data);
    }
}