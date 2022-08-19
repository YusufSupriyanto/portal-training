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
        $get =  $this->training->getCategory();
        $category = $this->request->getVar('filter');
        $categories = $this->training->getList($category);

        if ($categories) {
            $list = $categories;
        } else {
            $list = $this->training->getAll();
        }
        $data = [
            'tittle' => 'List Training',
            'jenis' => $get,
            'training' => $list,
        ];
        return view('admin/list_training', $data);
    }

    public function import()
    {
        $file = $this->request->getFile('file');
        if ($file == "") {
            return redirect()->to('/list_training');
        }
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
            // var_dump($sheet[$i][1]);
            $data = [
                'judul_training' => $sheet[$i][1],
                'jenis_training' => $sheet[$i][2],
                'deskripsi' => $sheet[$i][3],
                'vendor' => $sheet[$i][4],
                'biaya' => $sheet[$i][5]

            ];
            $this->training->save($data);
        }
        session()->setFlashdata('import', 'Data Berhasil Di Import');
        return redirect()->to('/list_training');
    }
}