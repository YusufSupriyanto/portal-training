<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_History;
use App\Models\M_Tna;
use App\Models\UserModel;

class C_History extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;

    private M_History $history;


    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->history = new M_History();
    }

    public function index()
    {

        $user = $this->user->getAllUser();
        $DataHistory = [];

        foreach ($user as $users) {
            $training = $this->tna->getTnaUser($users->id_user);
            $history = [
                'id' => $users->id_user,
                'nama' => $users->nama,
                'jumlah_training' => $training[0]['id_user']
            ];
            array_push($DataHistory, $history);
        }

        $data = [
            'tittle' => 'History Training',
            'user' => $DataHistory,
        ];
        return view('admin/history', $data);
    }

    public function DetailHistory()
    {
        $id = $this->request->getPost('history');

        $history = $this->tna->getDetailHistory($id);


        $data = [
            'tittle' => 'History Training',
            'history' => $history,
            'id' => $id
        ];
        return view('admin/detailhistory', $data);
    }

    public function SertifikatUpload()
    {

        $id_tna = $this->request->getVar('history');
        $file = $this->request->getFile('file');
        $keterangan = $this->request->getVar('keterangan');


        $id  = $this->history->getIdHistory($id_tna);
        $file->getName();
        $file->getClientExtension();
        $newName = $file->getRandomName();
        $file->move("../public/sertifikat", $newName);
        $filepath = "/sertifikat/" . $newName;

        $data = [
            'id_history' => $id[0]['id_history'],
            'sertifikat' => $filepath,
            'keterangan' => $keterangan[0]
        ];
        $this->history->save($data);
        return redirect()->to('/history');
    }

    public function UploadHistory()
    {
        $file = $this->request->getFile('file');
        $id = $this->request->getVar('id_user');
        $user = $this->user->getAllUser($id);
        // dd($user);
        if ($file == "") {
            return redirect()->to('/history');
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
        //dd($sheet);
        // $dataFixed = [];
        for ($i = 1; $i < count($sheet); $i++) {
            // var_dump($sheet[$i][1]);
            $training = $sheet[$i][1];
            $mulai = strtotime($sheet[$i][2]);
            $selesai = strtotime($sheet[$i][3]);
            $vendor = $sheet[$i][4];
            $tempat = $sheet[$i][5];
            $data = [
                'id_user' => $user['id_user'],
                'dic' => $user['dic'],
                'divisi' => $user['divisi'],
                'departemen' => $user['departemen'],
                'nama' =>  $user['nama'],
                'seksi' => $user['seksi'],
                'training' => $training,
                'mulai_training' => date('Y-m-d', $mulai),
                'rencana_training' => date('Y-m-d', $selesai),
                'vendor' => $vendor,
                'tempat' => $tempat,

            ];
            //   dd($data);
            $this->tna->save($data);
            $id  = $this->tna->getIdTna();
            $data2 = [
                'id_tna' => $id->id_tna,
                'id_user' => $id->id_user
            ];
            $this->history->save($data2);
        }
        session()->setFlashdata('success', 'Data Berhasil Di Import');
        return redirect()->to('/history');
    }
}