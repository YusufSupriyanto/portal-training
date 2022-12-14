<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Astra;
use App\Models\M_Career;
use App\Models\M_Company;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyCompany;
use App\Models\M_CompetencyExpert;
use App\Models\M_CompetencySoft;
use App\Models\M_CompetencyTechnical;
use App\Models\M_CompetencyTechnicalB;
use App\Models\M_Education;
use App\Models\M_Expert;
use App\Models\M_Soft;
use App\Models\M_Technical;
use App\Models\M_TechnicalB;
use App\Models\UserModel;
use function PHPUnit\Framework\isEmpty;

class C_User extends BaseController
{
    private UserModel $user;
    private M_Education $education;
    private M_Career $career;

    private M_Astra $astra;

    private M_Technical $technical;

    private M_Expert $expert;
    private M_Company $company;

    private M_TechnicalB $technicalB;

    private M_Soft $soft;

    private M_CompetencyAstra $competencyAstra;
    private M_CompetencyTechnical $competencyTechnical;
    private M_CompetencyExpert $competencyExpert;
    private M_CompetencyCompany $competencyCompany;
    private M_CompetencyTechnicalB $competencyTechnicalB;
    private M_CompetencySoft $competencySoft;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->career = new M_Career();
        $this->education = new M_Education();
        $this->astra = new M_Astra();
        $this->technical = new M_Technical();
        $this->expert = new M_Expert();
        $this->company = new M_Company();
        $this->technicalB = new M_TechnicalB();
        $this->soft = new M_Soft();
        $this->competencyAstra = new M_CompetencyAstra();
        $this->competencyExpert = new M_CompetencyExpert();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->competencyCompany = new M_CompetencyCompany();
        $this->competencyTechnicalB = new M_CompetencyTechnicalB();
        $this->competencySoft = new M_CompetencySoft();
    }
    public function index()
    {
        $user = $this->user->getAllUser();
        $seksi = $this->user->DistinctSeksi();
        $dic = $this->user->DistinctDic();
        $divisi = $this->user->DistinctDivisi();
        $departemen = $this->user->DistinctDepartemen();
        $bagian = $this->user->getUserBagian();
        $jabatan = $this->user->getUserJabatan();
        //dd($seksi);
        $data = [
            'tittle' => 'User',
            'user' => $user,
            'SEKSI' => $seksi,
            'DIC' => $dic,
            'DIVISI' => $divisi,
            'DEPARTEMEN' => $departemen,
            'BAGIAN' => $bagian,
            'JABATAN' => $jabatan,
        ];
        return view('admin/user', $data);
    }

    public function singleUser()
    {
        $level = $this->request->getVar('level');
        $group = $this->request->getVar('group');
        $department = $this->request->getVar('departemen');
        $type_user = $this->request->getvar('type_user');
        // dd($type_user);
        if ($level == "ADMIN") {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'npk' => $this->request->getVar('npk'),
                'seksi' => $this->request->getVar('seksi'),
                'status' => $this->request->getVar('status'),
                'dic' => $this->request->getVar('dic'),
                'divisi' => $this->request->getVar('divisi'),
                'departemen' => $department,
                'bagian' => $this->request->getVar('bagian'),
                'level' => $level,
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'email' => $this->request->getVar('email'),
            ];
            $this->user->save($data);
        } else {
            $image = $this->request->getFile('image');
            if ($image->isValid()) {
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
                    'profile' => $filepath,
                    'type_golongan' => $group,
                    'type_user' => $type_user,
                ];
            } else {
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
                    'type_golongan' => $group,
                    'type_user' => $type_user,
                ];
            }

            $this->user->save($data);
            $last = $this->user->getLastUser();
            // dd($last);
            $education = [
                'id_user' => $last->id_user,
                'grade' => $this->request->getVar('grade'),
                'year' => $this->request->getVar('year'),
                'institution' => $this->request->getVar('institution'),
                'major' => $this->request->getVar('major'),

            ];
            $career = [
                'id_user' => $last->id_user,
                'year_start' => $this->request->getVar('year_start'),
                'year_end' => $this->request->getVar('year_end'),
                'position' => $this->request->getVar('position'),
                'department' => $this->request->getVar('department'),
                'division' => $this->request->getVar('division'),
                'company' => $this->request->getVar('company'),
            ];
            $this->education->save($education);
            $this->career->save($career);

            $user = $this->user->getAllUser($last->id_user);
            //d($user);
            if ($group == 'A') {
                if ($type_user == 'REGULAR') {
                    $AstraList = $this->astra->getDataAstra();
                    // dd($AstraList);
                    foreach ($AstraList as $list) {
                        $Astra = [
                            'id_user' => $last->id_user,
                            'id_astra' => $list['id_astra'],
                            'score_astra' => 0,
                        ];
                        // save d($Astra);
                        $this->competencyAstra->save($Astra);
                    }
                    $departmentUser = $this->technical->getDataTechnicalDepartemen($user['departemen']);
                    if (!is_null($departmentUser)) {
                        foreach ($departmentUser as $departmentUsers) {
                            $technical = [
                                'id_user' => $last->id_user,
                                'id_technical' => $departmentUsers['id_technical'],
                                'score_technical' => 0,
                            ];
                            // save technical A
                            $this->competencyTechnical->save($technical);
                        }
                    }
                } else {
                    $ExpertList = $this->expert->getDataExpert();
                    foreach ($ExpertList as $list) {
                        $Expert = [
                            'id_user' => $last->id_user,
                            'id_expert' => $list['id_expert'],
                            'score_expert' => 0,
                        ];
                        //save
                        $this->competencyExpert->save($Expert);
                    }
                    $departmentUser = $this->technical->getDataTechnicalDepartemen($user['departemen']);
                    if (!is_null($departmentUser)) {
                        foreach ($departmentUser as $departmentUsers) {
                            $technical = [
                                'id_user' => $last->id_user,
                                'id_technical' => $departmentUsers['id_technical'],
                                'score_technical' => 0,
                            ];
                            // save
                            $this->competencyTechnical->save($technical);
                        }
                    }
                }
            } else {
                $CompanyList = $this->company->getDataCompanyDivisi($user['divisi']);
                foreach ($CompanyList as $Clist) {
                    $company = [
                        'id_user' => $last->id_user,
                        'id_company' => $Clist['id_company'],
                        'score_company' => 0,
                    ];
                    //save
                    $this->competencyCompany->save($company);
                }
                $TechnicalBList = $this->technicalB->getDataTechnicalBDepartemen($user['departemen'], $user['nama_jabatan']);
                foreach ($TechnicalBList as $TBList) {
                    $TechnicalB = [
                        'id_user' => $last->id_user,
                        'id_technicalB' => $TBList['id_technicalB'],
                        'score' => 0,
                    ];
                    // save
                    $this->competencyTechnicalB->save($TechnicalB);
                }
                $SoftList = $this->soft->getDataSoft();
                foreach ($SoftList as $SList) {
                    $Soft = [
                        'id_user' => $last->id_user,
                        'id_soft' => $SList['id_soft'],
                        'score_soft' => 0,
                    ];
                    // save
                    $this->competencySoft->save($Soft);
                }
            }
        }
        session()->setFlashdata('success', 'Data Saved Successfully');
        return redirect()->to('/user');
    }

    public function addUser()
    {

        // $departmentUser = $this->technical->getDataTechnicalDepartemen('HRD');
        // if (!is_null($departmentUser)) {
        //     dd('ada');
        // } else {
        //     dd('kosong');
        // }
        // dd($departmentUser);


        ini_set('max_execution_time', 300);
        $file = $this->request->getFile('file');
        //dd($file);
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
        // dd($sheet);

        $user = [];
        $total = count($sheet) - 1;
        for ($i = 1; $i <= $total; $i++) {

            $data = [
                'npk' => $sheet[$i][0],
                'nama' => $sheet[$i][1],
                'status' => $sheet[$i][2],
                'dic' => $sheet[$i][3],
                'divisi' => $sheet[$i][4],
                'departemen' => $sheet[$i][5],
                'seksi' => $sheet[$i][6],
                'bagian' => $sheet[$i][7],
                'username' => $sheet[$i][8],
                'password' => password_hash($sheet[$i][9], PASSWORD_DEFAULT),
                'level' => $sheet[$i][10],
                'type_golongan' => $sheet[$i][11],
                'nama_jabatan' => $sheet[$i][12],
                'type_user' => $sheet[$i][13],
            ];
            $this->user->save($data);
            $last = $this->user->getLastUser();
            $user = $this->user->getAllUser($last->id_user);
            if ($user['type_golongan'] == 'A         ') {
                if ($user['type_user'] == 'REGULAR             ') {
                    $AstraList = $this->astra->getDataAstra();
                    // dd($AstraList);
                    foreach ($AstraList as $list) {
                        $Astra = [
                            'id_user' => $last->id_user,
                            'id_astra' => $list['id_astra'],
                            'score_astra' => 0,
                        ];
                        // save d($Astra);
                        $this->competencyAstra->save($Astra);
                    }
                    $departmentUser = $this->technical->getDataTechnicalDepartemen($user['departemen']);
                    if (!is_null($departmentUser)) {
                        foreach ($departmentUser as $departmentUsers) {
                            $technical = [
                                'id_user' => $last->id_user,
                                'id_technical' => $departmentUsers['id_technical'],
                                'score_technical' => 0,
                            ];
                            // save technical A
                            $this->competencyTechnical->save($technical);
                        }
                    }
                } else {
                    $ExpertList = $this->expert->getDataExpert();
                    foreach ($ExpertList as $list) {
                        $Expert = [
                            'id_user' => $last->id_user,
                            'id_expert' => $list['id_expert'],
                            'score_expert' => 0,
                        ];
                        //save
                        $this->competencyExpert->save($Expert);
                    }
                    $departmentUser = $this->technical->getDataTechnicalDepartemen($user['departemen']);
                    if (!is_null($departmentUser)) {
                        foreach ($departmentUser as $departmentUsers) {
                            $technical = [
                                'id_user' => $last->id_user,
                                'id_technical' => $departmentUsers['id_technical'],
                                'score_technical' => 0,
                            ];
                            // save
                            $this->competencyTechnical->save($technical);
                        }
                    }
                }
            } else {
                $CompanyList = $this->company->getDataCompanyDivisi($user['divisi']);
                foreach ($CompanyList as $Clist) {
                    $company = [
                        'id_user' => $last->id_user,
                        'id_company' => $Clist['id_company'],
                        'score_company' => 0,
                    ];
                    //save
                    $this->competencyCompany->save($company);
                }
                $TechnicalBList = $this->technicalB->getDataTechnicalBDepartemen($user['departemen'], $user['nama_jabatan']);
                foreach ($TechnicalBList as $TBList) {
                    $TechnicalB = [
                        'id_user' => $last->id_user,
                        'id_technicalB' => $TBList['id_technicalB'],
                        'score' => 0,
                    ];
                    // save
                    $this->competencyTechnicalB->save($TechnicalB);
                }
                $SoftList = $this->soft->getDataSoft();
                foreach ($SoftList as $SList) {
                    $Soft = [
                        'id_user' => $last->id_user,
                        'id_soft' => $SList['id_soft'],
                        'score_soft' => 0,
                    ];

                    $this->competencySoft->save($Soft);
                }
            }
        }

        session()->setFlashdata('success', 'Data Berhasil Di Import');
        return redirect()->to('/user');
    }

    public function update()
    {
        $id = $this->request->getVar('update');

        $dic = $this->user->DistinctDic();
        $divisi = $this->user->DistinctDivisi();
        $departemen = $this->user->DistinctDepartemen();
        $seksi = $this->user->DistinctSeksi();
        $jabatan = $this->user->DistinctJabatan();
        $bagian = $this->user->DistinctBagian();
        $type_golongan = $this->user->getTypeGolongan();
        $type_user = $this->user->getTypeUser();
        // d($type_golongan);
        // dd($type_user);

        $data = [
            'tittle' => 'Edit User',
            'user' => $this->user->getAllUser($id),
            'education' => $this->education->getDataEducation($id),
            'career' => $this->career->getDataCareer($id),
            'dic' => $dic,
            'divisi' => $divisi,
            'departemen' => $departemen,
            'seksi' => $seksi,
            'bagian' => $bagian,
            'jabatan' => $jabatan,
            'type_golongan' => $type_golongan,
            'type_user' => $type_user
        ];

        return view('admin/edituser', $data);
    }


    //stuck 

    public function EditUser()
    {
        $dataFixes = [];
        $profile = $this->request->getPost('individual');
        $Equate = $this->EquateArray($profile[0]);
        $input = [
            'divisi' => $profile[5],
            'department' => $profile[6],
            'type_golongan' => trim($profile[9]),
            'type_user' => trim($profile[10])
        ];
        //create competency
        $compare = array_diff($input, $Equate);
        if (trim($input['type_golongan']) == 'A') {
            if (trim($input['type_user']) == 'REGULAR') {
                //$Astra = "Check";
                $old_competency = $this->competencyAstra->getAstraIdCompetency($profile[0]);
                //check data sudah ada atau belum
                if (!empty($old_competency)) {
                    $Astra = $this->astra->getAllIdAstra();
                    for ($i = 0; $i < count($old_competency); $i++) {
                        foreach ($Astra as $key => $values) {
                            if (in_array($values['id_astra'], $old_competency[$i])) {
                                unset($Astra[$key]);
                            }
                        }
                    }
                    foreach ($Astra as $astra) {
                        $DataAstra = [
                            'id_user' => $profile[0],
                            'id_astra' => $astra['id_astra'],
                            'score_astra' => 0
                        ];
                        // $this->competencyAstra->save($DataAstra);
                        //dd($DataAstra);
                    }
                } else {
                    $Astra = $this->astra->getAllIdAstra();
                    foreach ($Astra as $AstraCompetency) {
                        $DataAstraEmpty = [
                            'id_astra' => $AstraCompetency['id_astra'],
                            'id_user' => $profile[0],
                            'score_astra' => 0
                        ];

                        //save
                        // $this->competencyAstra->save($DataAstraEmpty);
                    }
                }
            } else {
                $old_competency = $this->competencyExpert->getProfileExpertCompetency($profile[0]);
                // check data sudah ada atau belum
                if (!empty($old_competency)) {
                    $Expert = $this->expert->getAllIdExpert();
                    for ($i = 0; $i < count($old_competency); $i++) {
                        foreach ($Expert as $key => $values) {
                            if (in_array($values['id_expert'], $old_competency[$i])) {
                                unset($Expert[$key]);
                            }
                        }
                    }
                    foreach ($Expert as $expert) {
                        $DataExpert = [
                            'id_user' => $profile[0],
                            'id_astra' => $expert['id_expert'],
                            'score_expert' => 0
                        ];
                        // save
                        // $this->competencyExpert->save($DataExpert);
                    }
                } else {
                    $Expert = $this->expert->getAllIdExpert();
                    //$test = 'Masuk';
                    foreach ($Expert as $expert) {
                        $DataExpert = [
                            'id_user' => $profile[0],
                            'id_expert' => $expert['id_expert'],
                            'score_expert' => 0
                        ];
                        //save
                        // $this->competencyExpert->save($DataExpert);
                    }
                }
            }
        } else {
            $old_competency = $this->competencySoft->getProfileSoftCompetency($profile[0]);
            //check data sudah ada atau belum
            if (!empty($old_competency)) {
                $Soft = $this->soft->getAllIdSoft();
                for ($i = 0; $i < count($old_competency); $i++) {
                    foreach ($Soft as $key => $values) {
                        if (in_array($values['id_soft'], $old_competency[$i])) {
                            unset($Soft[$key]);
                        }
                    }
                }
                foreach ($Soft as $soft) {
                    $DataSoft = [
                        'id_user' => $profile[0],
                        'id_soft' => $soft['id_soft'],
                        'score_soft' => 0
                    ];
                    //save 
                    //$this->competencySoft->save($DataSoft);
                }
            } else {
                $Soft = $this->soft->getAllIdSoft();
                foreach ($Soft as $soft) {
                    $DataSoft = [
                        'id_user' => $profile[0],
                        'id_soft' => $soft['id_soft'],
                        'score_soft' => 0
                    ];
                    //save 
                    // $this->competencySoft->save($DataSoft);
                }
            }
        }

        //mengecek Apakah Divisi Diubah
        if (array_key_exists("divisi", $compare)) {
            $old_divisi_competency = $this->competencyCompany->getProfileCompanyCompetencyDivision($profile[0], $compare['divisi']);
            //mengecek apakah pernah Berada Dalam Divisi Sebelumnya
            if (!empty($old_divisi_competency)) {
                $all_division_competency = $this->competencyCompany->getProfileCompanyCompetency($profile[0]);
                $SameDivision = [];

                //menghilangkan data yang sama 
                $Company = $this->company->getDataCompanyDivisi($compare['divisi']);
                for ($i = 0; $i < count($old_divisi_competency); $i++) {
                    foreach ($Company as $key => $values) {
                        if (in_array($values['company'], $old_divisi_competency[$i])) {
                            unset($Company[$key]);
                        }
                    }
                }

                //mengecek apakah variable $Company Masih Ada Data
                if (!empty($Company)) {

                    //memisahkan mengirim data yang sama dan menghapus data $Company
                    for ($i = 0; $i < count($all_division_competency); $i++) {

                        foreach ($Company as $key => $values) {

                            if (in_array($values['company'], $all_division_competency[$i])) {
                                array_push($SameDivision, $Company[$key]);
                                unset($Company[$key]);
                            }
                        }
                    }

                    //mengecek apakah variable $Company Masih Ada Data
                    //Jika ada maka disimpan sebagai data baru
                    if (!empty($Company)) {
                        foreach ($Company as $CompanyUser) {
                            $DataCompany = [
                                'id_company' => $CompanyUser['id_company'],
                                'id_user' => $profile[0],
                                'score_company' => 0
                            ];
                            //save
                            // $this->competencyCompany->save($DataCompany);
                        }
                    }
                }

                //jika ada disimpan sebagai competency yang sudah ada
                if (!empty($SameDivision)) {
                    $SerializeCompetency = array_map("unserialize", array_unique(array_map("serialize", $SameDivision)));

                    foreach ($SerializeCompetency as $DivisionSame) {
                        $CompanyScore = $this->competencyCompany->getProfileCompanyCompetencyValue($profile[0], $DivisionSame['company']);
                        $CompetencyDivisionSame = [
                            'id_user' => $profile[0],
                            'id_company' => $DivisionSame['id_company'],
                            'score_company' => $CompanyScore[0]['score_company']
                        ];
                    }
                }
            } else {
                $all_division_competency = $this->competencyCompany->getProfileCompanyCompetency($profile[0]);
                $SameDivision = [];

                $Company = $this->company->getDataCompanyDivisi($compare['divisi']);
                for ($i = 0; $i < count($all_division_competency); $i++) {
                    foreach ($Company as $key => $values) {
                        if (in_array($values['company'], $all_division_competency[$i])) {
                            array_push($SameDivision, $Company[$key]);
                            unset($Company[$key]);
                        }
                    }
                }

                if (!empty($Company)) {
                    foreach ($Company as $CompanyUser) {
                        $DataCompany = [
                            'id_company' => $CompanyUser['id_company'],
                            'id_user' => $profile[0],
                            'score_company' => 0
                        ];
                        //save
                        // $this->competencyCompany->save($DataCompany);
                    }
                }

                if (!empty($SameDivision)) {
                    $SerializeCompetency = array_map("unserialize", array_unique(array_map("serialize", $SameDivision)));
                    foreach ($SerializeCompetency as $DivisionSame) {
                        $CompanyScore = $this->competencyCompany->getProfileCompanyCompetencyValue($profile[0], $DivisionSame['company']);
                        $CompetencyDivisionSame = [
                            'id_user' => $profile[0],
                            'id_company' => $DivisionSame['id_company'],
                            'score_company' => $CompanyScore[0]['score_company']
                        ];
                    }
                }
            }
        }

        // save data user
        $tgl_masuk = date_create($profile[11]);
        $today = date('d-m-Y');
        $interval = date_diff($tgl_masuk, date_create($today));
        $interval->format('%R%y years %m months');
        $data = [
            'id_user' => $profile[0],
            'npk' => $profile[1],
            'nama' => $profile[2],
            'status' => $profile[3],
            'dic' => $profile[4],
            'divisi' => $profile[5],
            'departemen' => $profile[6],
            'seksi' => $profile[7],
            'bagian' => $profile[8],
            'type_golongan' => $profile[9],
            'type_user' => $profile[10],
            'promosi_terakhir' => $profile[11],
            'golongan' => $profile[12],
            'tgl_masuk' => $profile[13],
            'tahun' => $interval->format('%y'),
            'bulan' => $interval->format('%m'),
            'email' => $profile[16],
        ];

        // array_push($dataFixes, $data);
        $this->user->save($data);

        // copetency technical save


        //mengecek apakah departemen diganti
        if (array_key_exists("department", $compare)) {
            //clear

            $DataUser = $this->user->getAllUser($profile[0]);

            $check = 0;

            //Mengecek Apakah data type golongan Sebelumnya
            //Jika Type Golongan A
            if (trim($DataUser['type_golongan']) == 'A') {
                $check = 'Competency A Susah Ada';

                $old_department_competency = $this->competencyTechnical->getProfileTechnicalCompetencyDept($profile[0], $compare['department']);

                //mengecek Apakah Competency Sebelumnya Sudah Ada
                //Jika Competency Sebelumnya Ada
                if (!empty($old_department_competency)) {


                    //department sudah ada isinya
                    $department =  $this->technical->getDataTechnicalDepartemen($compare['department']);

                    $all_competency = $this->competencyTechnical->getProfileTechnicalCompetency($profile[0]);

                    for ($i = 0; $i < count($old_department_competency); $i++) {

                        foreach ($department as $key => $values) {

                            if (in_array($values['technical'], $old_department_competency[$i])) {
                                unset($department[$key]);
                            }
                        }
                    }

                    //mengecek Apakah Competency Departemen Tidak Kosong
                    if (!empty($department)) {
                        $DuplicateCompetency = [];
                        //searcing data same value
                        for ($i = 0; $i < count($all_competency); $i++) {

                            foreach ($department as $key => $values) {

                                if (in_array($values['technical'], $all_competency[$i])) {
                                    array_push($DuplicateCompetency, $department[$key]);
                                    unset($department[$key]);
                                }
                            }
                        }
                        // Mengecek Kembali Apakah Competenncy Department Masih ada
                        if (!empty($department)) {
                            foreach ($department as $Dept) {
                                $TechnicalNew = [
                                    'id_user' => $profile[0],
                                    'id_technical' => $Dept['id_technical'],
                                    'score_technical' => 0
                                ];
                                $this->competencyTechnical->save($TechnicalNew);
                            }
                        }

                        if (!empty($DuplicateCompetency)) {
                            //Menyimpan Data Competency Yang Sama
                            $SameCompetency = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));
                            foreach ($SameCompetency as $competency) {
                                $technical_score = $this->competencyTechnical->getProfileTechnicalCompetencyValue($profile[0], $competency['technical']);
                                $TechnicalSame = [
                                    'id_user' => $profile[0],
                                    'id_technical' => $competency['id_technical'],
                                    'score_techncial' => $technical_score[0]['score_technical']

                                ];
                                $this->competencyTechnical->save($TechnicalSame);
                            }
                        }
                    }

                    //Jika Competency Sebelumnya Kosong
                } else {

                    //clear
                    $check = 'Competency A Kosong';
                    //This Condition for New Department User

                    $all_competency = $this->competencyTechnical->getProfileTechnicalCompetency($profile[0]);

                    $department =  $this->technical->getDataTechnicalDepartemen($compare['department']);
                    $DuplicateCompetency = [];

                    //searcing data same value
                    for ($i = 0; $i < count($all_competency); $i++) {

                        foreach ($department as $key => $values) {

                            if (in_array($values['technical'], $all_competency[$i])) {
                                array_push($DuplicateCompetency, $department[$key]);
                                unset($department[$key]);
                            }
                        }
                    }

                    if (!empty($department)) {

                        foreach ($department as $Department) {
                            $TechnicalNew = [
                                'id_user' => $profile[0],
                                'id_technical' => $Department['id_technical'],
                                'score_technical' => 0
                            ];
                            $this->competencyTechnicalB->save($TechnicalNew);
                        }
                    }

                    if (!empty($DuplicateCompetency)) {
                        $SameCompetency = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));
                        foreach ($SameCompetency as $competency) {
                            $technical_score = $this->competencyTechnical->getProfileTechnicalCompetencyValue($profile[0], $competency['technical']);
                            $TechnicalSame = [
                                'id_user' => $profile[0],
                                'id_technical' => $competency['id_technical'],
                                'score_techncial' => $technical_score[0]['score_technical']

                            ];
                            $this->competencyTechnicalB->save($TechnicalSame);
                        }
                    }
                }

                //jika Golongan B
            } else {

                $old_department_competency = $this->competencyTechnicalB->getProfileTechnicalCompetencyBWithDepartment($profile[0], $compare['department']);
                $all_competency = $this->competencyTechnicalB->getProfileTechnicalCompetencyB($profile[0]);
                //Mengecek Apakah Competency Golongan B sebelumnya ada 
                //Jika Kompetency Golongan B sebelumya adA
                if (!empty($old_department_competency)) {
                    $check = 'Competency B Ada';
                    $department = $this->technicalB->getDataByDepartment($compare['department']);

                    for ($i = 0; $i < count($old_department_competency); $i++) {
                        foreach ($department as $key => $values) {
                            if (in_array($values['technicalB'], $old_department_competency[$i])) {
                                unset($department[$key]);
                            }
                        }
                    }

                    //mengecek Apakah Competency Departemen Tidak Kosong
                    if (!empty($department)) {
                        $DuplicateCompetency = [];
                        //searcing data same value
                        for ($i = 0; $i < count($all_competency); $i++) {

                            foreach ($department as $key => $values) {

                                if (in_array($values['technicalB'], $all_competency[$i])) {
                                    array_push($DuplicateCompetency, $department[$key]);
                                    unset($department[$key]);
                                }
                            }
                        }
                        // Mengecek Kembali Apakah Competenncy Department Maisih ada
                        if (!empty($department)) {
                            foreach ($department as $Dept) {
                                $TechnicalNew = [
                                    'id_user' => $profile[0],
                                    'id_technicalB' => $Dept['id_technicalB'],
                                    'score' => 0
                                ];
                                $this->competencyTechnicalB->save($TechnicalNew);
                            }
                        }

                        if (!empty($DuplicateCompetency)) {
                            //Menyimpan Data Competency Yang Sama
                            $SameCompetency = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));
                            foreach ($SameCompetency as $competency) {
                                $technical_score = $this->competencyTechnicalB->getProfileTechnicalCompetencyBValue($profile[0], $competency['technical']);
                                $TechnicalSame = [
                                    'id_user' => $profile[0],
                                    'id_technicalB' => $competency['id_technicalB'],
                                    'score' => $technical_score[0]['score']

                                ];
                                $this->competencyTechnicalB->save($TechnicalSame);
                            }
                        }
                    }
                } else {

                    $check = 'Competency B Kosong';
                    $department = $this->technicalB->getDataByDepartmentSeksi($DataUser['nama_jabatan'], $compare['department']);

                    $all_competency = $this->competencyTechnicalB->getProfileTechnicalCompetencyB($profile[0]);

                    $DuplicateCompetency = [];

                    for ($i = 0; $i < count($all_competency); $i++) {
                        foreach ($department as $key => $values) {
                            if (in_array($values['technicalB'], $all_competency[$i])) {
                                array_push($DuplicateCompetency, $department[$key]);
                                unset($department[$key]);
                            }
                        }
                    }

                    if (!empty($department)) {
                        foreach ($department as $Department) {
                            $TechnicalNew = [
                                'id_user' => $profile[0],
                                'id_technicalB' => $Department['id_technicalB'],
                                'score' => 0
                            ];
                            $this->competencyTechnicalB->save($TechnicalNew);
                        }
                    }

                    if (!empty($DuplicateCompetency)) {
                        //delete duplicate data
                        $SameCompetency = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));
                        foreach ($SameCompetency as $competency) {
                            $technical_score = $this->competencyTechnicalB->getTechnicalByIdCompetencyBValue($profile[0], $competency['technicalB']);
                            $TechnicalSame = [
                                'id_user' => $profile[0],
                                'id_technicalB' => $competency['id_technicalB'],
                                'score' => $technical_score[0]['score']

                            ];
                            //save
                            $this->competencyTechnicalB->save($TechnicalSame);
                        }
                    }
                }
            }
        }



        //user education save 
        $old_education = $this->request->getPost('education_old');
        if (!empty($old_education)) {

            $oldfix = [];
            foreach ($old_education as $old) {

                $education_old = [
                    'id_education' => $old[1],
                    'grade' => $old[0],
                    'year' => $old[2],
                    'institution' => $old[3],
                    'major' => $old[4],
                ];
                array_push($oldfix, $education_old);
                // $this->education->save($education_old);
            }
            array_push($dataFixes, $oldfix);
        }


        $new_education = $this->request->getPost('education_new');
        if (!empty($new_education)) {
            $newfix = [];
            foreach ($new_education as $new) {
                $education_new = [
                    'id_user' => $profile[0],
                    'grade' => $new[0],
                    'year' => $new[1],
                    'institution' => $new[2],
                    'major' => $new[3],
                ];
                array_push($newfix, $education_new);
                // $this->education->save($education_new);
            }
            array_push($dataFixes, $newfix);
        }


        //career user save
        $old_career = $this->request->getPost('career_old');
        if (!empty($old_career)) {
            $oldfixCareer = [];
            foreach ($old_career as $old_career) {
                $career_old = [
                    'id_career' => $old_career[0],
                    'year_start' => $old_career[1],
                    'year_end' => $old_career[2],
                    'position' => $old_career[3],
                    'departement' => $old_career[4],
                    'division' => $old_career[5],
                    'company' => $old_career[6],
                ];
                array_push($oldfixCareer, $career_old);
                //  $this->career->save($career_old);
            }
            array_push($dataFixes, $oldfixCareer);
        }
        $new_career = $this->request->getPost('career_new');
        if (!empty($new_career)) {
            $newfixCareer = [];
            foreach ($new_career as $new_careers) {
                $career_new = [
                    'id_user' => $profile[0],
                    'year_start' => $new_careers[0],
                    'year_end' => $new_careers[1],
                    'position' => $new_careers[2],
                    'departement' => $new_careers[3],
                    'division' => $new_careers[4],
                    'company' => $new_careers[5],
                ];
                array_push($newfixCareer, $career_new);
                // $this->career->save($career_new);
            }
            array_push($dataFixes, $newfixCareer);
        }
        //  $changes = $this->UpdatedCompetencyUser($profile[0]);

        echo json_encode($CompetencyDivisionSame);
    }



    public function DuplicateCompetncy($department, $old_competency)
    {

        $DuplicateCompetency = [];

        for ($i = 0; $i < count($old_competency); $i++) {

            foreach ($department as $key => $values) {

                if (in_array($values['technical'], $old_competency[$i])) {

                    array_push($DuplicateCompetency, $department[$key]);
                }
            }
        }

        ///delete duplicate data
        $try = array_map("unserialize", array_unique(array_map("serialize", $DuplicateCompetency)));
    }


    public function UnsetCompetency()
    {
    }


    //function for catch same value data  array
    public function SameCompetency($department, $old_competency)
    {
        for ($i = 0; $i < count($old_competency); $i++) {
            foreach ($department as $key => $values) {
                if (in_array($values['technical'], $old_competency[$i])) {
                    return $department[$key];
                }
            }
        }
    }

    //Equate array structure for Edit User
    public function EquateArray($id)
    {
        $user  = $this->user->getAllUser($id);
        $data = [
            'divisi' => $user['divisi'],
            'department' => $user['departemen'],
            'type_golongan' => trim($user['type_golongan']),
            'type_user' => trim($user['type_user'])
        ];
        return $data;
    }



    public function delete($id)
    {
        $this->user->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus');
        return redirect()->to('/user');
    }

    public function deleteEducation()
    {
        $id = $this->request->getPost('id');
        $data = $this->education->delete($id);
        echo json_encode($data);
    }
    public function deleteCareer()
    {
        $id = $this->request->getPost('id');
        $data = $this->career->delete($id);
        echo json_encode($data);
    }

    public function AddEducation()
    {
        $data = [
            'id_user' => $this->request->getVar('id'),
            'grade' => $this->request->getVar('grade'),
            'year' => $this->request->getVar('year'),
            'institution' => $this->request->getVar('institution'),
            'major' => $this->request->getVar('major'),

        ];
        $this->education->save($data);
        session()->setFlashdata('success', 'Data Education Berhasil Di Simpan');
        return redirect()->to('/user');
    }

    public function AddCareer()
    {
        $data = [
            'id_user' => $this->request->getVar('id'),
            'year_start' => $this->request->getVar('year_start'),
            'year_end' => $this->request->getVar('year_end'),
            'position' => $this->request->getVar('position'),
            'departement' => $this->request->getVar('department'),
            'division' => $this->request->getVar('division'),
            'company' => $this->request->getVar('company'),

        ];
        $this->career->save($data);
        session()->setFlashdata('success', 'Data Career Berhasil Di Simpan');
        return redirect()->to('/user');
    }

    public function test()
    {
        $technical = $this->competencyTechnical->getProfileTechnicalCompetency(7017);
        $astra = $this->competencyAstra->getProfileAstraCompetency(7017);
        dd($technical);
    }
    public function EditCompetencyUser()
    {
        $id = $this->request->getPost('id');
        $user = $this->user->getAllUser($id);
        if (trim($user['type_golongan']) == 'A' && trim($user['type_user']) == 'REGULAR') {
            $astra = $this->competencyAstra->getProfileAstraCompetency($id);
            $technicalA = $this->competencyTechnical->getProfileTechnicalCompetency($id);
            echo '
                        <div class="d-flex">
                        <div class="card w-100 m-1">
                        <input type="hidden" value="Astra" name="competency">
                            <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Astra Leadership Competency	</th>
                                                <th>Proficiency</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

            foreach ($astra as $Astra) {
                echo '<tr>
            <td>' . $Astra['astra'] . '</td>
            <td>' . $Astra['proficiency'] . '</td>
            <td>
             <input type="hidden" value="' . $Astra['id_competency_astra'] . '" name="astra[]">
            <input style="width:30px;" name="astra[]" value="' . $Astra['score_astra'] . '">
            </td>
            
            </tr>';
            }

            echo '                           </tbody>
                                    </table>
                                    </div>
                           ';
            echo '
             <div class="card w-100 m-1">
                <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Technical Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach ($technicalA as $technicals) {
                echo '<tr>
<td>' . $technicals['technical'] . '</td>
<td>' . $technicals['proficiency'] . '</td>
<td>
 <input type="hidden" value="' . $technicals['id_competency_technical'] . '" name="technical[]">
<input style="width:30px;" name="technical[]" value="' . $technicals['score_technical'] . '"></td>
</tr>';
            }

            echo '                           </tbody>
                        </table>
                        </div>
                         </div>
               ';
        } elseif (trim($user['type_golongan']) == 'A' && trim($user['type_user']) == 'EXPERT') {
            $expert = $this->competencyExpert->getProfileExpertCompetency($id);
            $technical = $this->competencyTechnical->getProfileTechnicalCompetency($id);
            echo '
            <div class="d-flex">
            <div class="card w-100 m-1">
            <input type="hidden" value="Expert" name="competency">
                <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Expert Behavior Competencies</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach ($expert as $experts) {
                echo '<tr>
<td>' . $experts['expert'] . '</td>
<td>' . $experts['proficiency'] . '</td>
<td>
<input type="hidden"  value="' . $experts['id_competency_expert'] . '" name="expert[]">
<input style="width:30px;" value="' . $experts['score_expert'] . '" name="expert[]">
</td>
</tr>';
            }

            echo '                           </tbody>
                        </table>
                        </div>
               ';
            echo '
             <div class="card w-100 m-1">
                <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Technical Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach ($technical as $technicals) {
                echo '<tr>
<td>' . $technicals['technical'] . '</td>
<td>' . $technicals['proficiency'] . '</td>
<td>
<input type="hidden" value="' . $technicals['id_competency_technical'] . '" name="technical[]">
<input style="width:30px;" name="technical[]" value="' . $technicals['score_technical'] . '"></td>
</td>
</tr>';
            }

            echo '                           </tbody>
                        </table>
                        </div>
                         </div>
               ';
        } else {
            $company = $this->competencyCompany->getProfileCompanyCompetency($id);
            $soft = $this->competencySoft->getProfileSoftCompetency($id);
            $technicalB = $this->competencyTechnicalB->getProfileTechnicalCompetencyB($id);
            echo '
            <div class="d-flex">
            <div class="card w-100 m-1">
             <input type="hidden" value="B" name="competency">
                <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Company General Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach ($company as $companies) {
                echo '<tr>
<td>' . $companies['company'] . '</td>
<td>' . $companies['proficiency'] . '</td>
<td>
<input type="hidden" name="company[]" value="' . $companies['id_competency_company'] . '">
<input style="width:30px;" name="company[]" value="' . $companies['score_company'] . '">
</td>
</tr>';
            }

            echo '                           </tbody>
                        </table>
                        </div>
               ';

            echo '
             <div class="card w-100 m-1">
                <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Technical Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach ($technicalB as $technical) {
                echo '<tr>
<td>' . $technical['technicalB'] . '</td>
<td>' . $technical['proficiency'] . '</td>
<td>
<input type="hidden" name="technicalB[]" value="' . $technical['id_competency_technicalB'] . '">
<input style="width:30px;" name="technicalB[]"  value="' . $technical['score'] . '">
</td>
</tr>';
            }

            echo '                           </tbody>
                        </table>
                        </div>
                       
               ';

            echo
            ' <div class="card w-100 m-1">
                <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Soft Competency</th>
                                    <th>Proficiency</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach ($soft as $softy) {
                echo '<tr>
<td>' . $softy['soft'] . '</td>
<td>' . $softy['proficiency'] . '</td>
<td>
<input type="hidden" name="soft[]" value="' . $softy['id_competency_soft'] . '">
<input style="width:30px;" name="soft[]" value="' . $softy['score_soft'] . '">
</td>
</tr>';
            }

            echo '                           </tbody>
                        </table>
                        </div>
                          </div>
               ';
        }
    }

    public function ChangeCompetency()
    {
        $competency  = $this->request->getVar('competency');
        if ($competency == 'Astra') {
            //Astra Competency
            $astra = $this->request->getVar('astra');
            $AstraCompetency = array_chunk($astra, 2);
            foreach ($AstraCompetency as $Astra) {
                $AstraData = [
                    'id_competency_astra' => $Astra[0],
                    'score_astra' => $Astra[1]
                ];
                $this->competencyAstra->save($AstraData);
            }
            $technical = $this->request->getVar('technical');
            $TehnicalCompetency = array_chunk($technical, 2);
            foreach ($TehnicalCompetency as $Technical) {
                $TechnicalData = [
                    'id_competency_technical' => $Technical[0],
                    'score_technical' => $Technical[1]
                ];
                $this->competencyTechnical->save($TechnicalData);
            }
            return redirect()->to('/user');
        } elseif ($competency == 'Expert') {
            //Expert Competency
            $expert = $this->request->getVar('expert');
            $ExpertCompetency = array_chunk($expert, 2);
            foreach ($ExpertCompetency as $Expert) {
                $ExpertData = [
                    'id_competency_expert' => $Expert[0],
                    'score_expert' => $Expert[1]
                ];
                $this->competencyExpert->save($ExpertData);
            }
            $technical = $this->request->getVar('technical');
            $TehnicalCompetency = array_chunk($technical, 2);
            foreach ($TehnicalCompetency as $Technical) {
                $TechnicalData = [
                    'id_competency_technical' => $Technical[0],
                    'score_technical' => $Technical[1]
                ];
                $this->competencyTechnical->save($TechnicalData);
            }
            return redirect()->to('/user');
        } else {
            //Group B Competency
            $company = $this->request->getVar('company');
            $CompanyCompetency = array_chunk($company, 2);
            foreach ($CompanyCompetency as $Company) {
                $CompanyData = [
                    'id_competency_company' => $Company[0],
                    'score_company' => $Company[1]
                ];
                $this->competencyCompany->save($CompanyData);
            }
            $soft = $this->request->getVar('soft');
            $SoftCompetency = array_chunk($soft, 2);
            foreach ($SoftCompetency as $Soft) {
                $SoftData = [
                    'id_competency_soft' => $Soft[0],
                    'score_soft' => $Soft[1]
                ];
                $this->competencySoft->save($SoftData);
            }
            $technicalB = $this->request->getVar('technicalB');
            $TechnicalBCompetency = array_chunk($technicalB, 2);
            foreach ($TechnicalBCompetency as $TechnicalB) {
                $TechnicalBData = [
                    'id_competency_technicalB' => $TechnicalB[0],
                    'score' => $TechnicalB[1]
                ];
                $this->competencyTechnicalB->save($TechnicalBData);
            }
            return redirect()->to('/user');
        }
    }


    public function getEducation()
    {
        // $id = $this->request->getPost('id_education');
        // $education = $this->education->getIdEducation($id);
        // echo json_encode($education);

    }

    // public function addIdEducation()
    // {
    // $id = $this->user->getIdUser();
    // $education = [];
    // foreach ($id as $ids) {
    // $data =
    // [
    // 'id_user' => $ids['id_user']
    // ];
    // $this->education->save($data);
    // }
    // // dd($education);
    // }

    // public function addIdEducation()
    // {
    // $id = $this->user->getIdUser();
    // $education = [];
    // foreach ($id as $ids) {
    // $data =
    // [
    // 'id_user' => $ids['id_user']
    // ];
    // $this->career->save($data);
    // }
    // // dd($education);
    // }

}