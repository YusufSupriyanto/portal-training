<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Astra;
use App\Models\M_Career;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyTechnical;
use App\Models\M_Education;
use App\Models\M_EvaluasiReaksi;
use App\Models\M_Technical;
use App\Models\M_Tna;
use App\Models\M_TnaUnplanned;
use App\Models\UserModel;

class User extends BaseController
{
    private M_Tna $tna;
    private UserModel $user;
    private M_TnaUnplanned $unplanned;
    private M_Education $education;
    private M_Career $career;

    private M_Astra $astra;
    private M_CompetencyAstra $competencyAstra;
    private M_Technical $technical;
    private M_CompetencyTechnical $competencyTechnical;


    public function __construct()
    {
        $this->tna = new M_Tna();
        $this->user = new UserModel();
        $this->unplanned = new M_TnaUnplanned();
        $this->education = new M_Education();
        $this->career = new M_Career();
        $this->astra = new M_Astra();
        $this->competencyAstra = new M_CompetencyAstra();
        $this->technical = new M_Technical();
        $this->competencyTechnical = new M_CompetencyTechnical();
    }

    public function index()
    {
        $id = session()->get('id');
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
            'technical' => $technicalCompetency
        ];
        return view('user/profile', $data);
    }

    public function UpdateProfile()
    {
        $image =  $this->request->getFile('foto');
        // dd($image);
        $image->getName();
        $image->getClientExtension();
        $newName = $image->getRandomName();
        $image->move("../public/profile", $newName);
        $filepath = "/profile/" . $newName;
        $data = [
            'id_user' => session()->get('id'),
            'profile' => $filepath,
        ];

        $this->user->save($data);
        return redirect()->to('/user_profile');
    }
}