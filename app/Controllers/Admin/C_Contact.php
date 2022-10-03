<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Approval;
use App\Models\M_Contact;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;

class C_Contact extends BaseController
{
    public M_Contact $contact;
    public function __construct()
    {
        $this->contact = new M_Contact();
    }

    public function index()
    {
        $contact =  $this->contact->getDataContact();
        // dd($contact);

        $data = [
            'tittle' => 'Message From User',
            'contact' => $contact
        ];
        return view('admin/contac', $data);
    }
    public function delete()
    {
        $id = $this->request->getVar('id');
        //dd($id);
        $this->contact->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Dihapus');
        return redirect()->to('/massage_user');
    }
}