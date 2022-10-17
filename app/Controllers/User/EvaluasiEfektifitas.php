<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_EvaluasiEfektifitas;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class EvaluasiEfektifitas extends BaseController
{

    private M_Tna $tna;
    private M_EvaluasiEfektifitas $efektivitas;

    private UserModel $user;
    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->efektivitas = new M_EvaluasiEfektifitas();
        $this->user = new UserModel();
    }

    public function index()
    {
        $efektifitas = $this->tna->getDataEfektivitas();
        //  dd($efektifitas);


        $dataEvaluasifixed = [];

        foreach ($efektifitas as $efektif) {

            $date_training = date_create($efektif['rencana_training']);
            $date_now = date_create(date('Y-m-d'));
            $compare = date_diff($date_training, $date_now);
            $due_date = (int)$compare->format('%a');
            if ($due_date >= 90) {
                $dataEvaluasiProcess = [
                    'id_tna' => $efektif['id_tna'],
                    'nama' => $efektif['nama'],
                    'judul' => $efektif['training'],
                    'jenis' => $efektif['jenis_training'],
                    'tanggal' => $efektif['rencana_training'],
                    'status' =>  $efektif['status_efektivitas']
                ];

                array_push($dataEvaluasifixed, $dataEvaluasiProcess);
            }
        }
        $data = [
            'tittle' => 'Evaluasi Efektifitas',
            'evaluasi' => $dataEvaluasifixed
        ];
        return view('user/evaluasiefektifitas', $data);
    }

    public function formEvaluasi($id)
    {
        $evaluation  = $this->tna->getDataForEvaluation($id);
        // dd($evaluation);
        $data = [
            'tittle' => 'Form Evaluasi Efektifitas',
            'evaluasi' => $evaluation
        ];
        return view('user/formefektivitas', $data);
    }


    public function saveEfektivitas()
    {
        $id = $this->request->getPost('id_tna');
        // dd($id);
        $id_efektivitas =  $this->efektivitas->getIdEfektivitas($id);
        // dd($id_efektivitas);
        $pengetahuan = $_POST['pengetahuan'];
        $keteranpilan = $_POST['keterampilan'];
        $data = [
            'id_efektivitas' => $id_efektivitas[0]['id_efektivitas'],
            'pengetahuan' => $pengetahuan[0],
            'keterampilan' =>  $keteranpilan[0],
            'performance' => $_POST['performance'],
            'perubahan' => $_POST['perubahan'],
            'pelatihan' => $_POST['pelatihan'],
            'note1' => $this->request->getVar('note1'),
            'note2' => $this->request->getVar('note2'),
            'note3' => $this->request->getVar('note3'),
            'note4' => $this->request->getVar('note4'),
            'note5' => $this->request->getVar('note5'),
            'kompetensi1' => $this->request->getVar('kompetensi1'),
            'kompetensi2' => $this->request->getVar('kompetensi2'),
            'kompetensi3' => $this->request->getVar('kompetensi3'),
            'kompetensi4' => $this->request->getVar('kompetensi4'),
            'kompetensi5' => $this->request->getVar('kompetensi5'),
            'perubahan1' => $this->request->getVar('perubahan1'),
            'perubahan2' => $this->request->getVar('perubahan2'),
            'perubahan3' => $this->request->getVar('perubahan3'),
            'perubahan4' => $this->request->getVar('perubahan4'),
            'perubahan5' => $this->request->getVar('perubahan5'),
            'keterangan1' => $this->request->getVar('keterangan1'),
            'keterangan2' => $this->request->getVar('keterangan2'),
            'keterangan3' => $this->request->getVar('keterangan3'),
            'keterangan4' => $this->request->getVar('keterangan4'),
            'keterangan5' => $this->request->getVar('keterangan5'),
            'status_efektivitas' => 1
        ];

        //dd($data);
        $this->efektivitas->save($data);
        return redirect()->to('/evaluasi_efektifitas');
    }

    public function DetailEfektivitas($id)
    {
        $evaluation  = $this->tna->getDataForEvaluation($id);
        $data = [
            'tittle' => 'View Data Efektivitas',
            'evaluasi' => $evaluation
        ];
        return view('user/detailefektivitas', $data);
    }

    public function DataEvaluasiEfektivitas()
    {
        $training = $this->request->getPost('id_training');
        $data = $this->efektivitas->getIdEfektivitas($training);
        echo json_encode($data);
    }

    public function PersonalEvaluasi()
    {
        $id = session()->get('id');
        $efektifitas = $this->tna->getDataForEvaluationTraining($id);
        $dataEvaluasifixed = [];

        foreach ($efektifitas as $efektif) {

            $date_training = date_create($efektif['rencana_training']);
            $date_now = date_create(date('Y-m-d'));
            $compare = date_diff($date_training, $date_now);
            $due_date = (int)$compare->format('%a');
            if ($due_date >= 90) {
                $dataEvaluasiProcess = [
                    'id_tna' => $efektif['id_tna'],
                    'nama' => $efektif['nama'],
                    'judul' => $efektif['training'],
                    'jenis' => $efektif['jenis_training'],
                    'tanggal' => $efektif['rencana_training'],
                    'status' =>  $efektif['status_efektivitas']
                ];

                array_push($dataEvaluasifixed, $dataEvaluasiProcess);
            }
        }
        //dd($evaluasi);
        $data = [
            'tittle' => 'Personal Evaluasi Efektivitas',
            'evaluasi' => $dataEvaluasifixed
        ];
        return view('user/personalefektivitas', $data);
    }

    public function sendEmail()
    {
        $email = $this->tna->getNotifEmailTraining();
        foreach ($email as $emails) {
            if ($emails['status_approval_3'] == 'accept') {
                $date_training = date_create($emails['rencana_training']);
                $date_now = date_create(date('Y-m-d'));
                $compare = date_diff($date_training, $date_now);
                $due_date = (int)$compare->format('%a');
                if ($due_date >= 90) {
                    if ($emails['status_efektivitas'] == null) {
                        $users = $this->user->getAllUser($emails['id_user']);
                        if ($users['bagian'] == 'STAFF 4UP' or $users['bagian'] == 'KASIE') {
                            $person = $this->user->getDataKadept($users['departemen']);
                            phpinfo();
                        } elseif ($users['bagian'] == 'KADEPT') {
                            $person = $this->user->getDataKadiv($users['divisi']);
                            dd($person);
                        } else {
                            $person = $this->user->getDataBod($users['dic']);
                            dd($person);
                        }
                    }
                }
            }
        }
    }
    public function dump()
    {
        // $email = $this->tna->getNotifEmailTraining();
        // foreach ($email as $emails) {
        //     if ($emails['status_approval_3'] == 'accept') {
        //         $date_training = date_create($emails['rencana_training']);
        //         $date_now = date_create(date('Y-m-d'));
        //         $compare = date_diff($date_training, $date_now);
        //         $due_date = (int)$compare->format('%a');
        //         if ($due_date >= 90) {
        //             if ($emails['status_efektivitas'] == null) {
        //                 $users = $this->user->getAllUser($emails['id_user']);
        //                 if ($users['bagian'] == 'STAFF 4UP' or $users['bagian'] == 'KASIE') {
        //                     $person = $this->user->getDataKadept($users['departemen']);
        //                     phpinfo();
        //                 } elseif ($users['bagian'] == 'KADEPT') {
        //                     $person = $this->user->getDataKadiv($users['divisi']);
        //                     dd($person);
        //                 } else {
        //                     $person = $this->user->getDataBod($users['dic']);
        //                     dd($person);
        //                 }
        //             }
        //         }
        //     }
        // }
        // dd($email);
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'ysme1209@gmail.com';                     //SMTP username
            $mail->Password   = 'stpkfcwasjuzetpj';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('ysme1209@gmail.com', 'Rifsilhana Yunratika');
            $mail->addAddress('ddump437@gmail.com', 'Joe User');     //Add a recipient
            $mail->addReplyTo('ysme1209@gmail.com', 'Information');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Update Evaluasi Efektifitas Training';
            $mail->Body    = 'Halo, @nama_user <br><br>Saatnya anda melakukan update evaluasi efektifitas Training @nama_training yang telah dilakukan oleh member anda @nama_peserta_training pada 3 bulan yang lalu.
            <br><br>Klik link berikut untuk mengisi evaluasi efektifitas training<br><a href="https://www.google.co.uk/">Link</a><br>Evaluasi anda akan sangat bermanfaat untuk pengembangan member anda.<br><br>Terimakasih.';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}