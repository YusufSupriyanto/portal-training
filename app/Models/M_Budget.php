<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Budget extends Model
{
    protected $table      = 'budget';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_budget';
    protected $allowedFields = ['alocated_budget', 'available_budget', 'used_budget', 'year', 'department', 'current', 'temporary_calculation'];

    public function getAllBudget()
    {
        $this->select();
        return $this->get()->getResultArray();
    }

    public function BudgetDashboard($date)
    {
        $this->select()->where('year', $date);
        return $this->get()->getResultArray();
    }

    public function getBudgetCurrent($department)
    {

        return $this->where('current', 'current')->where('department', $department)->first();
    }

    public function getDataBudgetById($id)
    {
        return $this->where(['id_budget' => $id])->first();
    }
}