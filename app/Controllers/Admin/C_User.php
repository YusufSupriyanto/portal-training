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
use PhpOffice\PhpSpreadsheet\Calculation\DateTime;

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
            'JABATAN' => $jabatan
        ];
        return view('admin/user', $data);
    }


    public function singleUser()
    {
        $level =   $this->request->getVar('level');
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
                    'profile' =>   $filepath,
                    'type_golongan' => $group,
                    'type_user' => $type_user
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
                    'type_user' => $type_user
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
                'major' => $this->request->getVar('major')

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
                            'score_astra' => 0
                        ];
                        // save d($Astra);
                        $this->competencyAstra->save($Astra);
                    }
                    $departmentUser = $this->technical->getDataTechnicalDepartemen($user['departemen']);
                    if (!isEmpty($departmentUser)) {
                        foreach ($departmentUser as $departmentUsers) {
                            $technical = [
                                'id_user' => $last->id_user,
                                'id_technical' => $departmentUsers['id_technical'],
                                'score_technical' => 0
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
                            'score_expert' => 0
                        ];
                        //save 
                        $this->competencyExpert->save($Expert);
                    }
                    $departmentUser = $this->technical->getDataTechnicalDepartemen($user['departemen']);
                    if (!isEmpty($departmentUser)) {
                        foreach ($departmentUser as $departmentUsers) {
                            $technical = [
                                'id_user' => $last->id_user,
                                'id_technical' => $departmentUsers['id_technical'],
                                'score_technical' => 0
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
                        'score_company' => 0
                    ];
                    //save
                    $this->competencyCompany->save($company);
                }
                $TechnicalBList = $this->technicalB->getDataTechnicalBDepartemen($user['departemen']);
                foreach ($TechnicalBList as $TBList) {
                    $TechnicalB = [
                        'id_user' => $last->id_user,
                        'id_technicalB' => $TBList['id_technicalB'],
                        'score' => 0
                    ];
                    // save
                    $this->competencyTechnicalB->save($TechnicalB);
                }
                $SoftList = $this->soft->getDataSoft();
                foreach ($SoftList as $SList) {
                    $Soft = [
                        'id_user' => $last->id_user,
                        'id_soft' => $SList['id_soft'],
                        'score_soft' => 0
                    ];
                    // save
                    $this->competencySoft->save($Soft);
                }
            }
        }
        session()->setFlashdata('success', 'Data Berhasil Di Simpan');
        return redirect()->to('/user');
    }

    public function addUser()
    {
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

        $user  = [];
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
                'nama_jabatan' => $sheet[$i][12]
            ];
            $this->user->save($data);
            $last = $this->user->getLastUser();
            $user = $this->user->getAllUser($last->id_user);
            //d($user);
            if ($user['type_golongan'] == 'A') {
                if ($user['type_user'] == 'REGULAR') {
                    $AstraList = $this->astra->getDataAstra();
                    // dd($AstraList);
                    foreach ($AstraList as $list) {
                        $Astra = [
                            'id_user' => $last->id_user,
                            'id_astra' => $list['id_astra'],
                            'score_astra' => 0
                        ];
                        // save d($Astra);
                        $this->competencyAstra->save($Astra);
                    }
                    $departmentUser = $this->technical->getDataTechnicalDepartemen($user['departemen']);
                    if (!isEmpty($departmentUser)) {
                        foreach ($departmentUser as $departmentUsers) {
                            $technical = [
                                'id_user' => $last->id_user,
                                'id_technical' => $departmentUsers['id_technical'],
                                'score_technical' => 0
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
                            'score_expert' => 0
                        ];
                        //save 
                        $this->competencyExpert->save($Expert);
                    }
                    $departmentUser = $this->technical->getDataTechnicalDepartemen($user['departemen']);
                    if (!isEmpty($departmentUser)) {
                        foreach ($departmentUser as $departmentUsers) {
                            $technical = [
                                'id_user' => $last->id_user,
                                'id_technical' => $departmentUsers['id_technical'],
                                'score_technical' => 0
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
                        'score_company' => 0
                    ];
                    //save
                    $this->competencyCompany->save($company);
                }
                $TechnicalBList = $this->technicalB->getDataTechnicalBDepartemen($user['departemen']);
                foreach ($TechnicalBList as $TBList) {
                    $TechnicalB = [
                        'id_user' => $last->id_user,
                        'id_technicalB' => $TBList['id_technicalB'],
                        'score' => 0
                    ];
                    // save
                    $this->competencyTechnicalB->save($TechnicalB);
                }
                $SoftList = $this->soft->getDataSoft();
                foreach ($SoftList as $SList) {
                    $Soft = [
                        'id_user' => $last->id_user,
                        'id_soft' => $SList['id_soft'],
                        'score_soft' => 0
                    ];
                    // save
                    $this->competencySoft->save($Soft);
                }
            }
        }
        //dd($user);

        session()->setFlashdata('success', 'Data Berhasil Di Import');
        return redirect()->to('/user');
    }


    public function update()
    {
        $id = $this->request->getVar('update');

        $data = [
            'tittle' => 'Edit User',
            'user' => $this->user->getAllUser($id),
            'education' => $this->education->getDataEducation($id),
            'career' => $this->career->getDataCareer($id)
        ];

        return view('admin/edituser', $data);
    }

    public function EditUser()
    {
        $dataFixes = [];
        $profile =  $this->request->getPost('individual');
        $tgl_masuk = date_create($profile[10]);
        $today = date('d-m-Y');
        $interval = date_diff($tgl_masuk, date_create($today));
        $interval->format('%R%y years %m months');
        $data = [
            'id_user' => $profile[0],
            'npk' => $profile[1],
            'nama' => $profile[2],
            'status' => $profile[3],
            'divisi' => $profile[4],
            'department' => $profile[5],
            'seksi' => $profile[6],
            'bagian' => $profile[7],
            'promosi_terakhir' => $profile[8],
            'golongan' => $profile[9],
            'tgl_masuk' => $profile[10],
            'tahun' => $interval->format('%y'),
            'bulan' => $interval->format('%m'),
            'email' => $profile[13],
        ];

        array_push($dataFixes, $data);
        $this->user->save($data);
        $old_education =  $this->request->getPost('education_old');
        if (!empty($old_education)) {
            $oldfix = [];
            foreach ($old_education as $old) {
                $education_old = [
                    'id_education' => $old[1],
                    'grade' => $old[0],
                    'year' => $old[2],
                    'institution' => $old[3],
                    'major' => $old[4]
                ];
                array_push($oldfix, $education_old);
                $this->education->save($education_old);
            }

            array_push($dataFixes, $oldfix);
        }
        $new_education =  $this->request->getPost('education_new');
        if (!empty($new_education)) {
            $newfix = [];
            foreach ($new_education as $new) {
                $education_new = [
                    'id_user' => $profile[0],
                    'grade' => $new[0],
                    'year' => $new[1],
                    'institution' => $new[2],
                    'major' => $new[3]
                ];
                array_push($newfix, $education_new);
                $this->education->save($education_new);
            }
            array_push($dataFixes, $newfix);
        }
        $old_career =  $this->request->getPost('career_old');
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
                    'company' => $old_career[6]
                ];
                array_push($oldfixCareer, $career_old);
                $this->career->save($career_old);
            }
            array_push($dataFixes, $oldfixCareer);
        }
        $new_career =  $this->request->getPost('career_new');
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
                    'company' => $new_careers[5]
                ];
                array_push($newfixCareer, $career_new);
                $this->career->save($career_new);
            }
            array_push($dataFixes, $newfixCareer);
        }
        echo json_encode($data);
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
            'major' => $this->request->getVar('major')

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
            'company' => $this->request->getVar('company')

        ];
        $this->career->save($data);
        session()->setFlashdata('success', 'Data Career Berhasil Di Simpan');
        return redirect()->to('/user');
    }


    public function EditCompetencyUser()
    {
        $id = $this->request->getPost('id');
        $user  = $this->user->getAllUser($id);
        $astra =  $this->competencyAstra->getProfileAstraCompetency($id);
        $technical = $this->competencyTechnical->getProfileTechnicalCompetency($id);
        //$company = $this->competencyCompany->getProfileCompanyCompetency($id);
        // $soft = $this->competencySoft->getProfileSoftCompetency($id);
        // $technicalB = $this->competencyTechnicalB->
        // if ($user['type_golongan'] == 'A') {
        //     if ($user['type_user'] == 'REGULAR') {
        //         $astra =  $this->competencyAstra->getProfileAstraCompetency($id);

        //     } else {
        //     }
        // } else {
        // }
        echo json_encode($id);
    }

    public function getEducation()
    {
        // $id = $this->request->getPost('id_education');
        // $education =  $this->education->getIdEducation($id);
        // echo json_encode($education);


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

    // public function addIdEducation()
    // {
    //     $id = $this->user->getIdUser();
    //     $education = [];
    //     foreach ($id as $ids) {
    //         $data =
    //             [
    //                 'id_user' => $ids['id_user']
    //             ];
    //         $this->career->save($data);
    //     }
    //     // dd($education);
    // }

}