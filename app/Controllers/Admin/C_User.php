<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Career;
use App\Models\M_Education;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Calculation\DateTime;

class C_User extends BaseController
{
    private UserModel $user;

    private M_Education $education;
    private M_Career $career;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->career = new M_Career();
        $this->education = new M_Education();
    }
    public function index()
    {
        $user = $this->user->getAllUser();
        $seksi = $this->user->DistinctSeksi();
        $dic = $this->user->DistinctDic();
        $divisi = $this->user->DistinctDivisi();
        $departemen = $this->user->DistinctDepartemen();
        //dd($seksi);
        $data = [
            'tittle' => 'User',
            'user' => $this->user->getAllUser(),
            'SEKSI' => $seksi,
            'DIC' => $dic,
            'DIVISI' => $divisi,
            'DEPARTEMEN' => $departemen
        ];
        return view('admin/user', $data);
    }


    public function singleUser()
    {
        $image = $this->request->getFile('image');
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
            'profile' =>   $filepath
        ];
        $this->user->save($data);
        $last = $this->user->getLastUser();
        $education = [
            'id_user' => $last,
            'grade' => $this->request->getVar('grade'),
            'year' => $this->request->getVar('year'),
            'institution' => $this->request->getVar('institution'),
            'major' => $this->request->getVar('major')

        ];
        $career = [
            'id_user' => $last,
            'year_start' => $this->request->getVar('year_start'),
            'year_end' => $this->request->getVar('year_end'),
            'position' => $this->request->getVar('position'),
            'department' => $this->request->getVar('department'),
            'division' => $this->request->getVar('division'),
            'company' => $this->request->getVar('company'),
        ];
        $this->education->save($education);
        $this->career->save($career);
        // d($data);
        // d($career);
        // d($education);
        session()->setFlashdata('success', 'Data Berhasil Di Simpan');
        return redirect()->to('/user');
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


        $user  = [];

        for ($i = 1; $i < count($sheet); $i++) {
            // var_dump($sheet[$i][1]);
            $data = [
                'npk' => $sheet[$i][1],
                'nama' => $sheet[$i][2],
                'status' => $sheet[$i][3],
                'dic' => $sheet[$i][4],
                'divisi' => $sheet[$i][5],
                'departemen' => $sheet[$i][6],
                'seksi' => $sheet[$i][7],
                'bagian' => $sheet[$i][8],
                'username' => $sheet[$i][9],
                'password' => password_hash($sheet[$i][10], PASSWORD_DEFAULT),
                'level' => $sheet[$i][11],

            ];
            array_push($user, $data);
        }
        //  dd($user);
        $this->user->save($data);
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