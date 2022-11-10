<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class C_Budget extends BaseController
{
    private UserModel $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function index()
    {
        $department = $this->user->DistinctDepartemen();
        $data = [
            'tittle' => 'Training Budget',
            'department' => $department
        ];
        return view('admin/budget', $data);
    }

    public function SaveBudget()
    {
        $alocated = $this->request->getVar('alocated');
        dd($alocated);
    }
}