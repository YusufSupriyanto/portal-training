<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Contact;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\UserModel;


class ContacUs extends BaseController
{

    private M_Contact $contact;

    public function __construct()
    {
        $this->contact = new M_Contact();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Contac Us',
        ];
        return view('user/contacususer', $data);
    }

    public function sendContact()
    {
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $pesan = $this->request->getVar('pesan');

        $data = [
            'nama' => $nama,
            'email' => $email,
            'pesan' => $pesan
        ];
        $this->contact->save($data);
        session()->setFlashdata('success', 'Pesan Berhasil Dikirim');
        return redirect()->to('/contac_us');
    }
}