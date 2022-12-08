<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Career;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyTechnical;
use App\Models\M_Contact;
use App\Models\M_Education;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Tna;
use App\Models\UserModel;


class Competency extends BaseController
{

    private M_CompetencyAstra $competencyAstra;
    private M_CompetencyTechnical $competencyTechnical;
    private UserModel $user;
    private M_Education $education;
    private M_Career $career;

    public function __construct()
    {
        $this->competencyAstra = new M_CompetencyAstra();
        $this->competencyTechnical = new M_CompetencyTechnical();
        $this->user = new UserModel();
        $this->education = new M_Education();
        $this->career = new M_Career();
    }

    public function index()
    {

        $id = session()->get('id');
        $user = $this->user->filter($id);
        $data = [
            'tittle' => 'Data Member',
            'user' => $user
        ];
        return view('user/membercompetency', $data);
    }


    public function MemberProfile()
    {
        $id = $this->request->getVar('member');
        $user = $this->user->getAllUser($id);
        $education = $this->education->getDataEducation($id);
        $career = $this->career->getDataCareer($id);
        $astraCompetency = $this->competencyAstra->getProfileAstraCompetency($id);
        $technicalCompetency = $this->competencyTechnical->getProfileTechnicalCompetency($id);
        // dd($technicalCompetency);

        //dd($astraCompetency);

        $data = [
            'tittle' => 'Profile',
            'person' => $user,
            'education' => $education,
            'career' => $career,
            'astra' => $astraCompetency,
            'technical' => $technicalCompetency,
            'id' => $id
        ];
        return view('user/profile', $data);
    }
}