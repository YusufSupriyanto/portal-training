<?php

namespace App\Controllers\Admin;



use App\Controllers\BaseController;
use App\Models\M_Categories;
use App\Models\M_ListTraining;
use App\Models\M_NonTraining;
use CodeIgniter\Images\Image;




class C_ListTraining extends BaseController
{
    private M_ListTraining $training;
    private M_NonTraining $nontraining;
    private M_Categories $category;



    public function __construct()
    {
        $this->training = new M_ListTraining();
        $this->nontraining = new M_NonTraining();
        $this->category = new M_Categories();
    }
    public function index()
    {
        $get =  $this->category->getTrainingCategory();

        $data = [
            'tittle' => 'List Training',
            'jenis' => $get,
        ];
        return view('admin/list_training', $data);
    }

    public function nonTraining()
    {
        $get =  $this->category->getNonTrainingCategory();
        $data = [
            'tittle' => 'Non Training',
            'jenis' => $get,
        ];
        return view('admin/non_training', $data);
    }

    public function detail($category)
    {
        $categories = $this->training->getList($category);
        $data = [
            'tittle' => 'List Training',
            'jenis' => $categories,
        ];
        return view('admin/detailtraining', $data);
    }

    public function update($id)
    {


        $edit = $this->category->getEditCategory($id);
        $data = [
            'tittle' => 'Edit Category',
            'category' => $this->category->getEditCategory($id)
        ];

        return view('admin/editcategory', $data);
    }

    public function edit($id)
    {
        $file = $this->request->getFile('file');
        $file->getName();
        $file->getClientExtension();
        $newName = $file->getRandomName();
        $file->move("../public/upload", $newName);
        $filepath = base_url() . "/upload/" . $newName;



        $data = [
            'id_categories' => $id,
            'list' => $this->request->getVar('list'),
            'category' => $this->request->getVar('category'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'path' => $filepath,
        ];

        $this->category->save($data);
        return redirect()->to('/list_training');
    }

    public function import2()
    {
        $file = $this->request->getFile('file');

        if ($file == "") {
            return redirect()->to('/non_training');
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
                'category' => $sheet[$i][1],
                'method' => $sheet[$i][2],
                'deskripsi' => $sheet[$i][3],
                'evaluasi' => $sheet[$i][4],

            ];
            $this->nontraining->save($data);
        }
        session()->setFlashdata('import', 'Data Berhasil Di Import');
        return redirect()->to('/non_training');
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

    public function addCategory()
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
                'list' => $sheet[$i][1],
                'category' => $sheet[$i][2],
                'deskripsi' => $sheet[$i][3],
                'path' => $sheet[$i][4],
            ];
            $this->category->save($data);
        }
        session()->setFlashdata('import', 'Data Berhasil Di Import');
        return redirect()->to('/list_training');
    }

    public function delete($id)
    {
        $this->category->delete($id);
        session()->setFlashdata('delete', 'Category berhasil di Hapus');
        return redirect()->to('/list_training');
    }
}