<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Contact;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;

class C_Department extends BaseController
{
    public M_Contact $contact;
    public function __construct()
    {
        $this->contact = new M_Contact();
    }

    public function index()
    {
        // dd('department');


        $data = [
            'tittle' => 'Update Department',
            // 'contact' => $contact
        ];
        return view('admin/department', $data);
    }
}