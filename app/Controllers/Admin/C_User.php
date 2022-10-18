<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Career;
use App\Models\M_Education;
use App\Models\UserModel;

class C_User extends BaseController
{
    private UserModel $user;

    private M_Education $education;
    private M_Career $career;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->career = new M_Career();
        $this->education = new M_Education();
    }
    public function index()
    {
        $user = $this->user->getAllUser();
        $seksi = $this->user->DistinctSeksi();
        $dic = $this->user->DistinctDic();
        $divisi = $this->user->DistinctDivisi();
        $departemen = $this->user->DistinctDepartemen();
        //dd($seksi);
        $data = [
            'tittle' => 'User',
            'user' => $this->user->getAllUser(),
            'SEKSI' => $seksi,
            'DIC' => $dic,
            'DIVISI' => $divisi,
            'DEPARTEMEN' => $departemen
        ];
        return view('admin/user', $data);
    }


    public function singleUser()
    {
        $image = $this->request->getFile('image');
        $image->getName();
        $image->getClientExtension();
        $newName = $image->getRandomName();
        $image->move("../public/profile", $newName);
        $filepath = "/profile/" . $newName;
        $data = [
            'nama' => $this->request->getVar('nama'),
            'npk' => $this->request->getVar('npk'),
            'seksi' => $this->request->getVar('seksi'),
            'dic' => $this->request->getVar('dic'),
            'divisi' => $this->request->getVar('divisi'),
            'departemen' => $this->request->getVar('departemen'),
            'bagian' => $this->request->getVar('bagian'),
            'level' => $this->request->getVar('level'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'profile' =>   $filepath
        ];
        // $this->user->save($data);
        $last = $this->user->getLastUser();
        $education = [
            'id_user' => $last,
            'grade' => $this->request->getVar('grade'),
            'year' => $this->request->getVar('year'),
            'institution' => $this->request->getVar('institution'),
            'major' => $this->request->getVar('major')

        ];
        $career = [
            'id_user' => $last,
            'year_start' => $this->request->getVar('year_start'),
            'year_end' => $this->request->getVar('year_end'),
            'position' => $this->request->getVar('position'),
            'department' => $this->request->getVar('department'),
            'division' => $this->request->getVar('division'),
            'company' => $this->request->getVar('company'),
        ];
        // $this->education->save($education);
        // $this->career->save($career);
        // dd($last);
        session()->setFlashdata('success', 'Data Berhasil Di Simpan');
        return redirect()->to('/user');
    }

    public function addUser()
    {
        $file = $this->request->getFile('file');
        if ($file == "") {
            return redirect()->to('/user');
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


        $user  = [];

        for ($i = 1; $i < count($sheet); $i++) {
            // var_dump($sheet[$i][1]);
            $data = [
                'npk' => $sheet[$i][1],
                'nama' => $sheet[$i][2],
                'status' => $sheet[$i][3],
                'dic' => $sheet[$i][4],
                'divisi' => $sheet[$i][5],
                'departemen' => $sheet[$i][6],
                'seksi' => $sheet[$i][7],
                'bagian' => $sheet[$i][8],
                'username' => $sheet[$i][9],
                'password' => password_hash($sheet[$i][10], PASSWORD_DEFAULT),
                'level' => $sheet[$i][11],

            ];
            array_push($user, $data);
        }
        dd($user);
        //$this->user->save($data);
        // session()->setFlashdata('success', 'Data Berhasil Di Import');
        // return redirect()->to('/user');
    }


    public function update($id)
    {
        $data = [
            'tittle' => 'Edit User',
            'user' => $this->user->getAllUser($id)
        ];

        return view('admin/edituser', $data);
    }

    public function edit($id)
    {
        $data = [
            'id_user' => $id,
            'npk' => $this->request->getVar('npk'),
            'nama' => $this->request->getVar('nama'),
            'status' => $this->request->getVar('status'),
            'divisi' => $this->request->getVar('divisi'),
            'departemen' => $this->request->getVar('departemen'),
            'bagian' => $this->request->getVar('bagian'),
        ];

        $this->user->save($data);
        session()->setFlashdata('success', 'Data Berhasil Di Update');
        return redirect()->to('/user');
    }


    public function delete($id)
    {

        $this->user->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/user');
    }


    // public function addIdEducation()
    // {
    //     $id = $this->user->getIdUser();
    //     $education = [];
    //     foreach ($id as $ids) {
    //         $data =
    //             [
    //                 'id_user' => $ids['id_user']
    //             ];
    //         $this->education->save($data);
    //     }
    //     // dd($education);
    // }
}