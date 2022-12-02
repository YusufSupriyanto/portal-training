<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyCompany;
use App\Models\M_CompetencyExpert;
use App\Models\M_CompetencySoft;
use App\Models\M_CompetencyTechnical;
use App\Models\M_CompetencyTechnicalB;
use App\Models\M_EvaluasiEfektifitas;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Nilai;
use App\Models\M_Tna;
use App\Models\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class EvaluasiEfektifitas extends BaseController
{

    private M_Tna $tna;
    private M_EvaluasiEfektifitas $evaluasiEfektivitas;
    private M_CompetencyAstra  $competencyAstra;
    private M_CompetencyExpert $competencyExpert;
    private M_CompetencySoft $competencySoft;
    private M_CompetencyCompany $competencyCompany;

    private M_CompetencyTechnical $competencyTechnical;
    private M_CompetencyTechnicalB $competencyTechnicalB;

    private UserModel $user;
    private M_Nilai $nilai;


    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->evaluasiEfektivitas = new M_EvaluasiEfektifitas();
        $this->user = new UserModel();
        $this->nilai = new M_Nilai();
        $this->competencyAstra = new M_CompetencyAstra();
        $this->competencyCompany = new  M_CompetencyCompany();
        $this->competencyExpert = new M_CompetencyExpert();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->competencyTechnicalB = new M_CompetencyTechnicalB();
    }

    public function index()
    {
        $id =  session()->get('id');

        $efektifitas = $this->tna->getDataEfektivitas($id);
        // dd($efektifitas);
        $dataEvaluasifixed = [];

        foreach ($efektifitas as $efektif) {

            $date_training = date_create($efektif['rencana_training']);
            //  dd($date_training);
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
        //dd($dataEvaluasifixed);
        $data = [
            'tittle' => 'Evaluasi Efektifitass',
            'evaluasi' => $dataEvaluasifixed
        ];
        return view('user/evaluasiefektifitas', $data);
    }

    public function formEvaluasi($id)
    {
        $evaluation  = $this->tna->getDataForEvaluation($id);
        // dd($evaluation[0]['id_competency1']);
        if ($evaluation[0]['type_golongan'] == 'A         ' && $evaluation[0]['type_user'] == 'REGULAR             ') {
            $CompetencyFixed = [];
            if ($evaluation[0]['type_competency1'] == 'Astra     ') {
                $competency_now = $this->competencyAstra->getAstraByIdCompetency($evaluation[0]['id_competency1']);
                foreach ($competency_now as $Competency_Now) {
                    $competency = [
                        'id' => $Competency_Now['id_competency_astra'],
                        'category' => "ALC - " . $Competency_Now['astra'],
                        'competency' => $Competency_Now['astra'],
                        'proficiency' => $Competency_Now['proficiency'],
                        'score' => $Competency_Now['score_astra'],
                        'keterangan' => 'Astra'
                    ];
                    array_push($CompetencyFixed, $competency);
                }
            } else {
                $competency_now = $this->competencyTechnical->getTechnicalByCompetency($evaluation[0]['id_competency1']);
                foreach ($competency_now as $Competency_Now) {
                    $competency = [
                        'id' => $Competency_Now['id_competency_technical'],
                        'category' => "Technical Comp - " . $Competency_Now['technical'],
                        'competency' => $Competency_Now['technical'],
                        'proficiency' => $Competency_Now['proficiency'],
                        'score' => $Competency_Now['score_technical'],
                        'keterangan' => 'TechnicalA'
                    ];
                    array_push($CompetencyFixed, $competency);
                }
            }
            // dd($CompetencyFixed);
            $astra = $this->competencyAstra->getProfileAstraCompetency($evaluation[0]['id_user']);
            $Astra = [];
            foreach ($astra as $data) {
                if ($data['score_astra'] < $data['proficiency']) {
                    $competency = [
                        'id' => $data['id_competency_astra'],
                        'category' => "ALC - " . $data['astra'],
                        'competency' => $data['astra'],
                        'proficiency' => $data['proficiency'],
                        'score' => $data['score_astra'],
                        'keterangan' => 'Astra'
                    ];
                    array_push($Astra, $competency);
                }
            }
            $technicalA = $this->competencyTechnical->getProfileTechnicalCompetency($evaluation[0]['id_user']);
            $TechnicalA = [];
            foreach ($technicalA as $dataTech) {
                if ($dataTech['score_technical'] < $dataTech['proficiency']) {
                    $competencyTech = [
                        'id' => $dataTech['id_competency_technical'],
                        'category' => "Technical Comp - " . $dataTech['technical'],
                        'competency' => $dataTech['technical'],
                        'proficiency' => $dataTech['proficiency'],
                        'score' => $dataTech['score_technical'],
                        'keterangan' => 'TechnicalA'
                    ];
                    array_push($TechnicalA, $competencyTech);
                }
            }
            $target = array_merge($Astra, $TechnicalA);
            $data = [
                'tittle' => 'Form Evaluasi Efektifitas',
                'evaluasi' => $evaluation,
                'competency' => $CompetencyFixed,
                'target' => $target
            ];
            return view('user/formefektivitas', $data);
        } elseif ($evaluation[0]['type_golongan'] == 'A         ' && $evaluation[0]['type_user'] == 'EXPERT              ') {

            if ($evaluation[0]['type_competency1'] == 'Expert    ') {
                $competency_now = $this->competencyExpert->getExpertByIdCompetency($evaluation[0]['id_competency1']);
                $CompetencyFixed = [];
                foreach ($competency_now as $Competency_Now) {
                    $competency = [
                        'id' => $Competency_Now['id_competency_expert'],
                        'category' => "Exp - " . $Competency_Now['expert'],
                        'competency' => $Competency_Now['expert'],
                        'proficiency' => $Competency_Now['proficiency'],
                        'score' => $Competency_Now['score_expert'],
                        'keterangan' => 'Expert'
                    ];
                    array_push($CompetencyFixed, $competency);
                }
            } else {
                $competency_now = $this->competencyTechnical->getTechnicalByCompetency($evaluation[0]['id_competency1']);
                foreach ($competency_now as $Competency_Now) {
                    $competency = [
                        'id' => $Competency_Now['id_competency_technical'],
                        'category' => "Technical Comp - " . $Competency_Now['technical'],
                        'competency' => $Competency_Now['technical'],
                        'proficiency' => $Competency_Now['proficiency'],
                        'score' => $Competency_Now['score_technical'],
                        'keterangan' => 'TechnicalA'
                    ];
                    array_push($CompetencyFixed, $competency);
                }
            }
            $expert = $this->competencyExpert->getProfileExpertCompetency($evaluation[0]['id_user']);
            $Expert = [];
            foreach ($expert as $DataExpert) {
                if ($DataExpert['score_expert'] < $DataExpert['proficiency']) {
                    $competency = [
                        'id' => $DataExpert['id_competency_expert'],
                        'category' => "Exp - " . $DataExpert['expert'],
                        'competency' => $DataExpert['expert'],
                        'proficiency' => $DataExpert['proficiency'],
                        'score' => $DataExpert['score_expert'],
                        'keterangan' => 'Expert'
                    ];
                    array_push($Expert, $competency);
                }
            }
            $technicalA = $this->competencyTechnical->getProfileTechnicalCompetency($evaluation[0]['id_user']);
            $TechnicalA = [];
            foreach ($technicalA as $dataTech) {
                if ($dataTech['score_technical'] < $dataTech['proficiency']) {
                    $competencyTech = [
                        'id' => $dataTech['id_competency_technical'],
                        'category' => "Technical Comp - " . $dataTech['technical'],
                        'competency' => $dataTech['technical'],
                        'proficiency' => $dataTech['proficiency'],
                        'score' => $dataTech['score_technical'],
                        'keterangan' => 'TechnicalA'
                    ];
                    array_push($TechnicalA, $competencyTech);
                }
            }
            $target = array_merge($Expert, $TechnicalA);
            $data = [
                'tittle' => 'Form Evaluasi Efektifitas',
                'evaluasi' => $evaluation,
                'competency' => $CompetencyFixed,
                'target' => $target
            ];
            return view('user/formefektivitas', $data);
        } else {
            //dd('Group B');
            $company = $this->competencyCompany->getProfileCompanyCompetency($evaluation[0]['id_user']);
            dd($company);
            // $soft = $this->competencySoft->getProfileSoftCompetency($evaluation[0]['id_user']);
            // $technicalB = $this->competencyTechnicalB->getProfileTechnicalCompetencyB($evaluation[0]['id_user']);
        }
        // dd($evaluation);

    }


    public function saveEfektivitas()
    {
        $id = $this->request->getPost('id_tna');
        // dd($id);s
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
                            //dd($person[0]['email']);
                            $this->Email($person[0]['email'], $person[0]['nama']);
                        } elseif ($users['bagian'] == 'KADEPT') {
                            $person = $this->user->getDataKadiv($users['divisi']);
                            $this->Email($person[0]['email'], $person[0]['nama']);
                        } else {
                            $person = $this->user->getDataBod($users['dic']);
                            $this->Email($person[0]['email'], $person[0]['nama']);
                        }
                    }
                }
            }
        }
    }
    public function Email($email, $name)
    {
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
            $mail->addAddress($email, $name);     //Add a recipient
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