<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {

        $data = [
            'tittle' => 'Portal Training & Development'
        ];
        return view('admin/home', $data);
    }
}