<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class C_User extends BaseController
{
    private UserModel $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function index()
    {
        $user = $this->user->getAllUser();

        $data = [
            'tittle' => 'User',
            'user' => $this->user->getAllUser()
        ];
        return view('admin/user', $data);
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



        for ($i = 1; $i < count($sheet); $i++) {
            // var_dump($sheet[$i][1]);
            $data = [
                'npk' => $sheet[$i][1],
                'nama' => $sheet[$i][2],
                'status' => $sheet[$i][3],
                'divisi' => $sheet[$i][4],
                'departemen' => $sheet[$i][5],
                'seksi' => $sheet[$i][6],
                'bagian' => $sheet[$i][7],
                'username' => $sheet[$i][8],
                'password' => password_hash($sheet[$i][9], PASSWORD_DEFAULT),
                'level' => $sheet[$i][10],


            ];
            $this->user->save($data);
        }
        session()->setFlashdata('import', 'Data Berhasil Di Import');
        return redirect()->to('/user');
    }
}