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
        // dd($history[0]);

        $data = [
            'tittle' => 'History Training',
            'history' => $history,
        ];
        return view('admin/detailhistory', $data);
    }

    public function SertifikatUpload()
    {

        $id_tna = $_POST['history'];
        $file = $this->request->getFile('file' . $id_tna[0]);
        // $file = $_FILES['file' . $id_tna[0]];
        $keterangan = $_POST['keterangan'];

        $id  = $this->history->getIdHistory($id_tna);
        $file->getName();
        $file->getClientExtension();
        $newName = $file->getRandomName();
        // var_dump($newName);
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
}