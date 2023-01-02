<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\M_Budget;
use App\Models\M_Contact;
use App\Models\M_ListTraining;
use App\Models\M_Tna;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class C_Dashboard extends BaseController
{
    public M_ListTraining $training;

    private M_Tna $tna;

    private M_Budget $budget;

    private UserModel $user;
    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->tna = new M_Tna();
        $this->budget = new M_Budget();
        $this->user = new UserModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Dashboard',
            'Jenis_training' => $this->JenisTrainingDashboard(),
            'category' => $this->CategoryDashboard(),
            'budget' => $this->budget->BudgetDashboard(date('Y')),
            'month' => $this->TrainingDahboardMonth(),
            'column' => $this->TrainingDahboardCountColumn(),
            'line' => $this->TrainingDahboardCountLine(),
            'need_approval' => $this->DashboardNeedApproval(),
            'approved' => $this->DashboardApproved(),
            'rejected' => $this->DashboardRejected(),
            'department' => $this->user->DistinctDepartemen(),
            'dept' => $this
        ];

        // dd($data);

        return view('admin/dashboard', $data);
    }

    public function TrainingDahboardMonth()
    {
        $training = $this->tna->DashboardTraining(date('Y'));
        if (empty($training)) {
            return  '';
        } else {
            foreach ($training as $Training) {
                $Month[] = date("F", mktime(0, 0, 0, $Training['Bulan'], 10));
            }
            return $Month;
        }
    }
    public function TrainingDahboardCountColumn()
    {
        $training = $this->tna->DashboardTraining(date('Y'));
        if (empty($training)) {
            return 0;
        } else {
            foreach ($training as $Training) {

                $total[] = $Training['total'];
            }
            return $total;
        }
    }

    public function TrainingDahboardCountLine()
    {
        $training = $this->tna->DashboardTrainingLine(date('Y'));
        if (empty($training)) {
            return 0;
        } else {
            foreach ($training as $Training) {

                $total[] = $Training['total'];
            }
            return $total;
        }
    }

    public function TrainingDahboardMonthDepartment($department)
    {
        $training = $this->tna->DashboardTrainingDepartment(date('Y'), $department);
        if (empty($training)) {
            return  '';
        } else {
            foreach ($training as $Training) {
                $Month[] = date("F", mktime(0, 0, 0, $Training['Bulan'], 10));
            }
            return $Month;
        }
    }



    public function JenisTrainingDashboard()
    {
        $jenis = $this->tna->getJenisTraining();
        $JenisTrainings = [];

        foreach ($jenis as $Jenis) {
            $count = $this->tna->CountJenisTraining($Jenis->jenis_training, date('Y'));
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            $JenisTraining = [
                'name' => $Jenis->jenis_training,
                'y' => $count[0]->jenis_training,
                'color' => "rgb($r , $g , $b)"
            ];
            array_push($JenisTrainings, $JenisTraining);
        }
        return $JenisTrainings;
    }

    public function CategoryDashboard()
    {
        $categories = $this->tna->getCategory();
        $category = [];
        foreach ($categories as $Categories) {
            $count = $this->tna->CountCategory($Categories->kategori_training, date('Y'));
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
            $categori = [
                'name' => $Categories->kategori_training,
                'y' => $count[0]->kategori_training,
                'color' => "rgb($r , $g , $b)"
            ];

            array_push($category, $categori);
        }
        return $category;
    }


    public function DashboardRejected()
    {
        $rejected = $this->tna->getDashboardTrainingReject(date('Y'));
        $total = $this->tna->getCountTrainingByYear(date('Y'));
        //dd($total);
        if (empty($rejected)) {
            return 0;
        } else {
            $number = $rejected[0]['id_tna'] / $total[0]['id_tna'] * 100;
            $persent = number_format($number, 2, ',', '.');
            return $persent;
        }
    }


    public function DashboardApproved()
    {
        $approved  = $this->tna->getDashboardTrainingApproved(date('Y'));
        // dd($approved);
        $total = $this->tna->getCountTrainingByYear(date('Y'));
        if (empty($approved)) {
            return 0;
        } else {
            $number = $approved[0]['id_tna'] / $total[0]['id_tna'] * 100;
            $persent = number_format($number, 2, ',', '.');
            return $persent;
        }
    }

    public function DashboardNeedApproval()
    {
        $need = $this->tna->getDashboardTrainingNeedApproval(date('Y'));
        $total = $this->tna->getCountTrainingByYear(date('Y'));
        if (empty($need)) {
            return 0;
        } else {
            $number = $need[0]['id_tna'] / $total[0]['id_tna'] * 100;
            $persent = number_format($number, 2, ',', '.');
            return $persent;
        }
    }


    public function TrainingDahboardCountColumnDepartment($department)
    {
        $training = $this->tna->DashboardTrainingDepartment(date('Y'), $department);
        if (empty($training)) {
            return  0;
        } else {
            foreach ($training as $Training) {

                $total[] = $Training['total'];
            }
            return $total;
        }
    }

    public function TrainingDahboardCountLineDepartment($department)
    {
        $training = $this->tna->DashboardTrainingLineDepartment(date('Y'), $department);

        if (empty($training)) {
            return  0;
        } else {
            foreach ($training as $Training) {

                $total[] = $Training['total'];
            }
            return $total;
        }
    }

    public function testChartDepartment()
    {
        $department = $this->user->DistinctDepartemen();

        //  foreach ($department as $Department) {
        $month = $this->TrainingDahboardMonthDepartment('HRD');
        // $column = $this->TrainingDahboardCountColumnDepartment($Department['departemen']);
        // $line = $this->TrainingDahboardCountLineDepartment($Department['departemen']);
        d($month);
        // d($line);
        // }
    }
}