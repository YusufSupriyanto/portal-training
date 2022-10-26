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
        $page = basename($_SERVER['PHP_SELF']);
        $data = [
            'tittle' => 'List Training',
            'jenis' => $categories,
            'category' => $page
        ];
        //dd($data);
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

        $categories = $this->category->getIdCategories($id);
        // dd($categories);
        if ($categories['list'] == 'Training') {
            $this->category->save($data);
            return redirect()->to('/list_training');
        } else {
            $this->category->save($data);
            return redirect()->to('/non_training');
        }
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
        session()->setFlashdata('success', 'Data Berhasil Di Import');
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
        session()->setFlashdata('success', 'Data Berhasil Di Import');
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
        session()->setFlashdata('success', 'Data Berhasil Di Import');
        return redirect()->to('/list_training');
    }

    public function delete($id)
    {
        $this->category->delete($id);
        session()->setFlashdata('success', 'Category berhasil di Hapus');
        header("Location: https://www.geeksforgeeks.org");
        exit;
    }

    public function singleAddCategory()
    {
        $list = $this->request->getVar('list');
        $category = $this->request->getVar('category');
        $deskripsi = $this->request->getVar('deskripsi');
        $file = $this->request->getFile('file');
        $file->getName();
        $file->getClientExtension();
        $newName = $file->getRandomName();
        $file->move("../public/upload", $newName);
        $filepath = base_url() . "/upload/" . $newName;


        $data = [
            'list' => $list,
            'category' => $category,
            'deskripsi' => $deskripsi,
            'path' => $filepath
        ];
        $filter  = $this->request->getVar('filter');
        if ($filter == 1) {
            $this->category->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Import');
            return redirect()->to('/non_training');
        } else {
            $this->category->save($data);
            session()->setFlashdata('success', 'Data Berhasil Di Import');
            return redirect()->to('/list_training');
        }
    }


    public function saveSingleTraining()
    {
        $add = $this->request->getPost('add');

        $number =  str_replace(".", "", $add[3]);
        $data  = [
            'judul_training' => $add[0],
            'jenis_training' =>  $add[1],
            'deskripsi' => $add[2],
            'biaya' => $number
        ];
        $this->training->save($data);
        echo json_encode($data);
    }


    public function deleteAllTraining()
    {
        $this->training->emptyTable();
        session()->setFlashdata('success', 'Data Berhasil Di Import');
        return redirect()->to('/list_training');
    }
    public function deleteTraining()
    {
        $id = $this->request->getVar('id');
        $page = $this->request->getVar('category');
        //dd($id);
        $this->training->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Import');
        return redirect()->to('/detail/' . $page);
    }

    public function editTraining()
    {
        $angka = $this->request->getPost('biaya');
        $number =  str_replace(".", "", $angka);
        $data = [
            'id_training' => $this->request->getPost('id'),
            'judul_training' => $this->request->getPost('judul'),
            'jenis_training' => $this->request->getPost('jenis'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'vendor' => $this->request->getPost('vendor'),
            'biaya' => $number

        ];
        $this->training->save($data);
        session()->setFlashdata('success', 'Data Berhasil Di Update');
        echo json_encode($data);
    }
}