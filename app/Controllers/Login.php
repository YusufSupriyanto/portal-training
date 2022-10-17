<?php

namespace App\Controllers;

use App\Models\UserModel;


class Login extends BaseController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Portal Training | Log In'
        ];
        return view('login', $data);
    }

    public function validation()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $row = $this->userModel->get_data_login($username);
        // dd($row);

        if ($row == null) {
            // session()->setFlashdata('message', 'username salah');
            return redirect()->to('/');
        }
        if (password_verify($password, $row->password)) {
            $data = array(
                'log' => true,
                'id' => $row->id_user,
                'nama' => $row->nama,
                'npk' => $row->npk,
                'username' => $row->username,
                'dic' => $row->dic,
                'divisi' => $row->divisi,
                'departemen' => $row->departemen,
                'bagian' => $row->bagian,
                'level' => $row->level,
                'image' => $row->profile,
                'email' => $row->email
            );

            if ($data['level'] == 'USER') {
                session()->set($data);
                session()->setFlashdata('message', 'Login Berhasil');
                return redirect()->to('/home_user');
            } else {
                session()->set($data);
                session()->setFlashdata('message', 'Login Berhasil');
                return redirect()->to('/home');
            }
        }
        // session()->setFlashdata('message', 'Password Salah');
        return redirect()->to('/');
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('message', 'berhasil Logout');
        return redirect()->to('/');
    }
}