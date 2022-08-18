<?php

namespace App\Controllers\Admin;



use App\Controllers\BaseController;
use App\Models\M_ListTraining;



class C_ListTraining extends BaseController
{
    private M_ListTraining $training;

    public function __construct()
    {
        $this->training = new M_ListTraining();
    }
    public function index()
    {

        $data = [
            'tittle' => 'List Training',
            // 'training' => $this->training->getList()
        ];
        return view('admin/list_training', $data);
    }

    public function import()
    {
        $file = $this->request->getFile('file');
        $ext = $file->getClientExtension();
        if ($ext == 'xls') {
            $render = new
                \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new
                \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();


        for ($i = 1; $i < count($sheet); $i++) {
            $data = [
                'judul_training' => $sheet[$i][1],
                'jenis_training' => $sheet[$i][2],
                'deskripsi' => $sheet[$i][3],
                'vendor' => $sheet[$i][4],
                'biaya' => $sheet[$i][5]

            ];
            $this->training->save($data);

            return redirect()->to('/list_training');
        }
    }
}