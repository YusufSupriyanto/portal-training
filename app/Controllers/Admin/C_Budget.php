<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Budget;
use App\Models\UserModel;

class C_Budget extends BaseController
{
    private UserModel $user;
    private M_Budget $budget;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->budget = new M_Budget();
    }
    public function index()
    {
        $department = $this->user->DistinctDepartemen();
        $budget = $this->budget->getAllBudget();
        $data = [
            'tittle' => 'Training Budget',
            'department' => $department,
            'budget' => $budget
        ];
        return view('admin/budget', $data);
    }

    public function strFilter($string)
    {
        $number =  str_replace("Rp.", "", $string);
        $angka = str_replace(".", "", $number);
        $fixes = str_replace(" ", "", $angka);
        return $fixes;
    }

    public function SaveBudget()
    {
        $id_budget = $this->request->getVar('id_budget');
        $department = $this->request->getVar('department');
        $alocated = $this->strFilter($this->request->getVar('alocated'));
        $used = $this->strFilter($this->request->getVar('used'));
        $available = $this->strFilter($this->request->getVar('available'));
        $temporary = $this->strFilter($this->request->getVar('temporary'));

        $year = $this->request->getVar('year');
        //dd($id_budget);
        if ($id_budget != "") {
            $budgetData = $this->budget->getDataBudgetById($id_budget);
            $budgetAvailable = $alocated - $budgetData['used_budget'];
            if ($year < date('Y')) {
                $condition = 'past';
            } elseif ($year == date('Y')) {
                $condition = 'current';
            } else {
                $condition = 'future';
            }
            $data1 = [
                'id_budget' => $id_budget,
                'department' => $department,
                'alocated_budget' => $alocated,
                'available_budget' => $budgetAvailable,
                'used_budget' => $used,
                'temporary_calculation' => $temporary,
                'year' => $year,
                'current' => $condition
            ];
            //dd($data1);
            $this->budget->save($data1);
            return redirect()->to('/budget');
        } else {
            if ($year < date('Y')) {
                $condition = 'past';
            } elseif ($year == date('Y')) {
                $condition = 'current';
            } else {
                $condition = 'future';
            }
            $data2 = [
                'department' => $department,
                'alocated_budget' => $alocated,
                'available_budget' => $available,
                'used_budget' => $used,
                'temporary_calculation' => $temporary,
                'year' => $year,
                'current' => $condition
            ];
            // dd($data2);
            $this->budget->save($data2);
            return redirect()->to('/budget');
        }
    }


    //function run from cron cob
    public function UpdateBudget()
    {
    }
}