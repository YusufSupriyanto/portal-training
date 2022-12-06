<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_Astra;
use App\Models\M_Career;
use App\Models\M_CompetencyAstra;
use App\Models\M_CompetencyCompany;
use App\Models\M_CompetencyExpert;
use App\Models\M_CompetencySoft;
use App\Models\M_CompetencyTechnical;
use App\Models\M_CompetencyTechnicalB;
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

    private M_CompetencyExpert $competencyExpert;
    private M_CompetencySoft $competencySoft;
    private M_CompetencyCompany $competencyCompany;

    private M_CompetencyTechnicalB $competencyTechnicalB;


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
        $this->competencyExpert = new M_CompetencyExpert();
        $this->competencySoft = new M_CompetencySoft();
        $this->competencyCompany = new M_CompetencyCompany();
        $this->competencyTechnicalB = new M_CompetencyTechnicalB();
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
            'technical' => $technicalCompetency,
            'id' => $id
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

    public function CompetencyProfile()
    {
        $id = $this->request->getPost('id');
        $user = $this->user->getAllUser($id);
        if ($user['type_golongan'] == 'A         ' && $user['type_user'] == 'REGULAR             ') {
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
         ' . $Astra['score_astra'] . '
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
' . $technicals['score_technical'] . '
</tr>';
            }

            echo '                           </tbody>
                        </table>
                        </div>
                         </div>
               ';
        } elseif ($user['type_golongan'] == 'A         ' && $user['type_user'] == 'EXPERT              ') {
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
' . $experts['score_expert'] . '
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
' . $technicals['score_technical'] . '
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
                                    <th>Company Competency</th>
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
' . $companies['score_company'] . '
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
<td>' . $technical['score'] . '
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
' . $softy['score_soft'] . '
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
}