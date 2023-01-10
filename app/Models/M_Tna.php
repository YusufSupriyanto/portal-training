<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Tna extends Model
{
    protected $table      = 'tna';
    protected $primaryKey = 'id_tna';
    // protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_user', 'id_training', 'dic', 'divisi',
        'departemen', 'nama', 'jabatan', 'golongan', 'seksi', 'jenis_training',
        'kategori_training', 'training', 'vendor', 'tempat', 'metode_training', 'request_training', 'mulai_training', 'rencana_training',
        'tujuan_training', 'notes', 'biaya', 'biaya_actual', 'status', 'kelompok_training', 'id_budget', 'id_competency', 'type_competency', 'year'
    ];


    private UserModel $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }
    // public function getTnaByid($id)
    // {
    //     $this->select()->where('id_tna', $id);
    //     return $this->get()->getResultArray();
    // }

    public function getTnaUser($id)
    {
        $this->selectCount('id_user')->where('id_user', $id)->where('kelompok_training', 'training');;
        return $this->get()->getResultArray();
    }

    public function getTnaUserHistory($id)
    {
        $this->selectCount('id_user')->where('id_user', $id);;
        return $this->get()->getResultArray();
    }

    public function getDetailHistory($id)
    {
        $this->select()->where('id_user', $id);
        $this->join('history', 'history.id_tna=tna.id_tna');
        return $this->get()->getResultArray();
    }

    public function getAllTna($id = false)
    {
        if ($id == false) {
            $this->select('tna.*,user.*');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        }
        $this->where('id_tna', $id);
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResult();
    }

    public function getTnaForRole($id)
    {
        $this->select()->where('id_tna', $id);
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    // public function getAllSave($id = false)
    // {
    //     if ($id == false) {
    //         $this->select()->where('status', 'save');
    //         return $this->get()->getResult();
    //     }
    //     return $this->where(['id_tna' => $id])->get()->getResult();
    // }

    public function getUserTna($id)
    {
        $this->select()->where(['id_user' => $id])->where('kelompok_training', 'training');
        return $this->get()->getResultArray();
    }

    // public function getUserTnaUnplanned($id)
    // {
    //     $this->select()->where(['id_user' => $id])->where('kelompok_training', 'unplanned');
    //     return $this->get()->getResult();
    // }

    public function getTnaFilterDistinct($id)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select('user.departemen')->where('user.dic', $user['dic'])->where('tna.status', 'save')->where('kelompok_training', 'training')->distinct()->where('bagian', 'KADIV');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select('user.departemen')->where('user.divisi', $user['divisi'])->where('tna.status', 'save')->where('kelompok_training', 'training')->distinct()->where('bagian', 'KADEPT');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select('user.departemen')->where('user.departemen', $user['departemen'])->where('tna.status', 'save')->where('kelompok_training', 'training')->distinct()->whereIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KASIE' || $user['bagian'] == 'STAFF 4UP') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select('user.departemen')->where('user.seksi', $user['seksi'])->where('tna.status', 'save')->where('kelompok_training', 'training')->distinct()->WhereNotIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } else {
            $this->select('user.departemen')->where('tna.id_user', $user['id_user'])->where('tna.status', 'save')->where('kelompok_training', 'training')->distinct();
            return $this->get()->getResult();
        }
    }

    public function getTnaFilterKadept($id, $departemen = false)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select()->where('user.dic', $user['dic'])->where('user.departemen', $departemen)->where('tna.status', 'save')->where('kelompok_training', 'training')->where('bagian', 'KADIV');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select()->where('user.divisi', $user['divisi'])->where('user.departemen', $departemen)->where('tna.status', 'save')->where('kelompok_training', 'training')->where('bagian', 'KADEPT');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select()->where('user.departemen', $departemen)->where('tna.status', 'save')->where('kelompok_training', 'training')->whereIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KASIE' || $user['bagian'] == 'STAFF 4UP') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select()->where('user.seksi', $user['seksi'])->where('user.departemen', $departemen)->where('tna.status', 'save')->where('kelompok_training', 'training')->WhereNotIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } else {
            $this->select()->where('id_user', $user['id_user'])->where('departemen', $departemen)->where('status', 'save')->where('kelompok_training', 'training');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        }
    }

    public function getTnaFilter($id)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select()->where('user.dic', $user['dic'])->where('tna.status', 'save')->where('kelompok_training', 'training')->where('bagian', 'KADIV');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select()->where('user.divisi', $user['divisi'])->where('tna.status', 'save')->where('kelompok_training', 'training')->where('bagian', 'KADEPT');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select()->where('user.departemen', $user['departemen'])->where('tna.status', 'save')->where('kelompok_training', 'training')->whereIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KASIE' || $user['bagian'] == 'STAFF 4UP') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select()->where('user.seksi', $user['seksi'])->where('tna.status', 'save')->where('kelompok_training', 'training')->WhereNotIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } else {
            $this->select()->where('tna.id_user', $user['id_user'])->where('tna.status', 'save')->where('kelompok_training', 'training');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        }
    }

    // public function getTnaFilterUnplanned($id)
    // {
    //     $user = $this->user->getAllUser($id);

    //     if ($user['bagian'] == 'BOD') {
    //         $this->select()->where('dic', $user['dic'])->where('status', 'save')->where('kelompok_training', 'unplanned');
    //         return $this->get()->getResult();
    //     } elseif ($user['bagian'] == 'KADIV') {
    //         $this->select()->where('divisi', $user['divisi'])->where('status', 'save')->where('kelompok_training', 'unplanned');
    //         return $this->get()->getResult();
    //     } elseif ($user['bagian'] == 'KADEPT') {
    //         $this->select()->where('departemen', $user['departemen'])->where('status', 'save')->where('kelompok_training', 'unplanned');
    //         return $this->get()->getResult();
    //     } else {
    //         $this->select()->where('id_user', $user['id_user'])->where('status', 'save')->where('kelompok_training', 'unplanned');
    //         return $this->get()->getResult();
    //     }
    // }

    public function getStatusWaitAdminDepartemen()
    {
        $this->select('user.departemen')->where('tna.status', 'wait')->where('kelompok_training', 'training');
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->groupBy('user.departemen');
        return $this->get()->getResult();
    }
    public function getStatusWaitAdmin($departemen)
    {
        $this->select('tna.*,user.*')->where('tna.status', 'wait')->where('kelompok_training', 'training')->where('user.departemen', $departemen);
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        return $this->get()->getResult();
    }

    public function getStatusPersonal($id)
    {
        $this->select('tna.*,approval.*,user.bagian')->where('user.id_user', $id)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }
    public function getStatusPersonalUnplanned($id)
    {
        $this->select('tna.*,approval.*,user.bagian')->where('user.id_user', $id)->where('kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getStatusWaitUser($bagian, $member, $id = null)
    {
        $status = ['wait', 'accept'];
        if ($bagian == 'BOD') {

            $this->select('tna.*,approval.*,user.bagian')->where('user.dic', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $jabatan = ['KADIV'];

            $this->select('tna.*,approval.*,user.bagian')->where('user.divisi', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('user.departemen', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KASIE') {
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('user.seksi', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->whereNotIn('user.bagian', $jabatan);
            return $this->get()->getResultArray();
        } else {
            $this->select('tna.*,approval.*,user.bagian')->where('tna.id_user', $id)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        }
    }

    //function untuk menampilkan data tna yang sudah di accept
    public function getKadivStatus()
    {
        $this->select('tna.*,user.*,approval.*')->where('tna.status', 'accept')->where('kelompok_training', 'training');
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('approval', 'approval.id_tna = tna.id_tna'); //->where('status_approval_1', null)->orWhere('status_approval_1', 'reject')
        return $this->get()->getResultArray();
    }


    //function get Request Tna
    public function getRequestTna($bagian, $member, $depertemen)
    {
        if ($bagian == 'BOD') {
            $this->select('tna.*,user.*,approval.*')->where('user.dic', $member)->where('user.departemen', $depertemen)->where('tna.status', 'accept')->where('status_approval_0', 'accept')->where('status_approval_1', 'accept')->where('status_approval_2', 'accept')->where('status_approval_3', null)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select('tna.*,user.*,approval.*')->where('user.divisi', $member)->where('user.departemen', $depertemen)->where('tna.status', 'accept')->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', 'accept')->where('status_approval_1', null);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $this->select('tna.*,user.*,approval.*')->where('tna.status', 'accept')->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', null);
            $this->join('user', 'user.id_user = tna.id_user')->where('user.departemen', $member)->where('user.departemen', $depertemen);
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }
    }
    public function getRequestTnaDisntinct($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select('user.departemen')->where('user.dic', $member)->where('tna.status', 'accept')->where('status_approval_0', 'accept')->where('status_approval_1', 'accept')->where('status_approval_2', 'accept')->where('status_approval_3', null)->where('kelompok_training', 'training')->distinct();
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select('user.departemen')->where('user.divisi', $member)->where('tna.status', 'accept')->where('kelompok_training', 'training')->distinct();
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', 'accept')->where('status_approval_1', null);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $this->select('user.departemen')->where('user.departemen', $member)->where('tna.status', 'accept')->where('kelompok_training', 'training')->distinct();
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', null);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }
    }




    public function getKadivAccept($date, $year, $departemen)
    {
        $this->select('tna.*,user.*,approval.*')->where('month(mulai_training)', $date)->where('tna.year', $year)->where('user.departemen', $departemen)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getKadivAcceptDistinct($date, $year)
    {

        $this->select('user.departemen')->where("Month(mulai_training)", $date)->where('tna.year', $year)->where('kelompok_training', 'training')->distinct();
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getIdTna()
    {
        $this->select();
        return $this->get()->getLastRow();
    }

    public function getDetailReject($id)
    {
        $this->select('tna.*,approval.*,user.bagian')->where('tna.id_tna', $id);
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getDateTraining()
    {
        $this->select('tna.rencana_training,tna.training,approval.status_approval_1,approval.status_approval_2,approval.status_approval_3')->distinct();
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        return $this->get()->getResult();
    }



    public function getTrainingMonthly($date)
    {
        // $sql = $this->query("select MONTH(tna.mulai_training) as 'Planing Training', count(distinct tna.training) as 'Jumlah Training',count(distinct approval.status_approval_2) as 'Admin Approval',count(distinct approval.status_approval_3) as 'BOD Approval'
        //     from tna join approval on approval.id_tna = tna.id_tna where tna.kelompok_training = 'training' and approval.status_approval_1 = 'accept' group by MONTH(tna.mulai_training)")->getResultArray();
        $sql = $this->query("select	MONTH(tna.mulai_training) as 'Planing Training',
		count(tna.training) as 'Jumlah Training',
		count(case when approval.status_approval_2 = 'accept' then 1 else null end) as 'Admin Approval',
		count(case when approval.status_approval_3 = 'accept' then 1 else null end) as 'BOD Approval' ,
		sum(case when approval.status_approval_2='reject' then 1 when approval.status_approval_3='reject' then 1 else 0 end) as 'Reject'
from	tna  join	approval on approval.id_tna = tna.id_tna 
where	tna.kelompok_training = 'training' and tna.year = $date and status_approval_0 ='accept'
group by MONTH(tna.mulai_training)")->getResultArray();

        return $sql;
    }

    public function getTrainingDitolak()
    {
        $this->select();
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'reject')->orWhere('status_approval_2', 'reject')->orWhere('status_approval_3', 'reject');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getAtmp()
    {
        $this->select('tna.*,approval.*,user.*');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('user', 'user.id_user = tna.id_user')->where('status_approval_3', 'accept');
        return $this->get()->getResultArray();
    }

    public function getMemberSchedule($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select('tna.*,approval.*,user.*')->where('user.dic', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select('tna.*,approval.*,user.*')->where('user.divisi', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.*')->where('user.departemen', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
            return $this->get()->getResultArray();
        } else {
            $this->select('tna.*,approval.*,user.*')->where('user.seksi', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        }
    }

    public function getMemberHistory($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select('tna.*,approval.*,user.*')->where('user.dic', $member);
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select('tna.*,approval.*,user.bagian')->where('user.divisi', $member);
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('user.departemen', $member);
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }
    }

    public function getPersonalSchedule($id)
    {
        $this->select('tna.*,approval.*,user.bagian,user.id_user')->where('user.id_user', $id)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getDataHome()
    {
        $this->select('tna.mulai_training,tna.rencana_training,tna.kategori_training')->distinct()->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getDataJadwalHome($date)
    {

        $sql = $this->query("select id_training,metode_training,jenis_training, training as Training,COUNT(training) as Pendaftar,kategori_training,mulai_training,rencana_training,biaya_actual from tna where mulai_training = '$date'  group by id_training,training,kategori_training,metode_training,jenis_training,mulai_training,rencana_training,biaya_actual");
        return  $sql->getResultArray();
    }

    public function getJadwalHomeVer($date)
    {
        $this->select()->where('mulai_training', $date)->where('kelompok_training', 'training');
        return $this->get()->getResultArray();
    }


    public function getSchedule()
    {
        $this->select('tna.*,approval.*,user.*')->where('tna.kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->where('status_training', null);
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getEvaluasiReaksi($id)
    {
        $this->select('tna.*,approval.*,user.*,evaluasi_reaksi.*')->where('user.id_user', $id)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->where('status_training', 1);
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }

    public function getDataForEvaluation($id)
    {
        $this->select('tna.*,approval.*,user.*,nilai.*,evaluasi_efektivitas.*')->where('tna.id_tna', $id);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('nilai', 'nilai.id_tna = tna.id_tna');
        $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }
    public function getDataForEvaluationTraining($id)
    {
        $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('user.id_user', $id)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }
    public function getDataForEvaluationUnplanned($id)
    {
        $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('user.id_user', $id)->where('kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }

    // public function getDataHistory($id)
    // {
    //     $this->select()->where('tna.id_tna', $id);
    //     $this->join('history', 'history.id_tna = tna.id_tna');
    //     return $this->get()->getResultArray();
    // }

    // public function getDataHistory($id)
    // {
    //     $this->select('tna.*,approval.*,user.bagian,user.id_user,user.npk')->where('tna.id_tna', $id);
    //     $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
    //     $this->join('user', 'user.id_user = tna.id_user');
    //     return $this->get()->getResultArray();
    // }


    public function getDetailEvaluasiReaksi($id)
    {
        $this->select('tna.*,user.bagian,user.id_user,user.npk,user.departemen,evaluasi_reaksi.*')->where('tna.id_tna', $id);
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }


    public function getDataEfektivitas($id)
    {
        $user = $this->user->getAllUser($id);
        $status = [0];

        if ($user['bagian'] == "BOD") {
            $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->whereNotIn('status_training', $status);
            $this->join('user', 'user.id_user = tna.id_user')->where('user.bagian', 'KADIV')->where('user.dic', $user['dic']);
            $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($user['bagian'] == "KADIV") {
            $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->whereNotIn('status_training', $status);
            $this->join('user', 'user.id_user = tna.id_user')->where('user.bagian', 'KADEPT')->where('user.divisi', $user['divisi']);
            $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($user['bagian']  == "KADEPT") {
            $bagian = ['KASIE', 'STAFF 4UP', 'STAFF'];
            $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->whereNotIn('status_training', $status);
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('user.bagian', $bagian)->where('user.departemen', $user['departemen'])->where('user.level', 'USER');
            $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($user['bagian']  == "KASIE" || $user['bagian']  == "STAFF 4UP") {
            $bagian = ['STAFF 4UP', 'KASIE'];

            $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->whereNotIn('status_training', $status);
            $this->join('user', 'user.id_user = tna.id_user')->where('user.seksi', $user['seksi'])->where('user.level', 'USER')->whereNotIn('user.bagian', $bagian);
            $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } else {
            return 'E';
        }
    }



    public function getNotifEmailTraining()
    {
        $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }

    // public function getMemberHistory($bagian, $member)
    // {
    //     if ($bagian == 'BOD') {
    //         $this->select('tna.*,approval.*,user.bagian')->where('tna.dic', $member)->where('kelompok_training', 'training');
    //         $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
    //         $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
    //         return $this->get()->getResultArray();
    //     } elseif ($bagian == 'KADIV') {
    //         $this->select('tna.*,approval.*,user.bagian')->where('tna.divisi', $member)->where('kelompok_training', 'training');
    //         $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
    //         $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
    //         return $this->get()->getResultArray();
    //     } elseif ($bagian == 'KADEPT') {
    //         $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
    //         $this->select('tna.*,approval.*,user.bagian')->select('tna.id_user,tna.nama')->where('tna.departemen', $member)->where('kelompok_training', 'training');
    //         $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
    //         $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
    //         return $this->get()->getResult();
    //     } else {
    //         return  $status  =  array();
    //     }
    // }


    public function getHistoryTna($id)
    {
        $this->select()->where('tna.id_user', $id)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna')->where('status_evaluasi', '1');
        return $this->get()->getResult();
    }
    public function getTnaTerdaftar($id)
    {
        $this->select()->where('tna.id_user', $id)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna')->where('status_evaluasi', null);
        return $this->get()->getResult();
    }

    //Dashboard Function Model


    public function getCountTrainingByYear($year)
    {
        $this->selectCount('tna.id_tna')->where('year', $year);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('year', $year);
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getJenisTraining()
    {
        $this->select('tna.jenis_training')->Distinct();
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna')->where('status_evaluasi', '1');
        return $this->get()->getResult();
    }

    public function CountJenisTraining($jenis, $date)
    {
        $this->selectCount('tna.jenis_training')->where('tna.jenis_training', $jenis)->where('tna.year', $date);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna')->where('status_evaluasi', '1');
        return $this->get()->getResult();
    }

    public function getCategory()
    {
        $this->select('tna.kategori_training')->Distinct();
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna')->where('status_training', '1');
        return $this->get()->getResult();
    }

    public function CountCategory($category, $date)
    {
        $this->selectCount('tna.kategori_training')->where('tna.kategori_training', $category)->where('tna.year', $date);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna')->where('status_training', '1');
        return $this->get()->getResult();
    }


    public function DashboardTraining($date)
    {
        // $sql =  $this->query("Select count(mulai_training) as counted_leads,mulai_training as count_date from tna group by mulai_training")->getResultArray();
        $sql =  $this->query("SELECT MONTH(mulai_training) as Bulan,COUNT(mulai_training) as total  FROM  tna join approval on approval.id_tna = tna.id_tna where status_approval_3 = 'accept' and YEAR(mulai_training) = $date GROUP BY  MONTH(mulai_training)")->getResultArray();
        return $sql;
    }

    public function DashboardTrainingLine($date)
    {
        // $sql =  $this->query("Select count(mulai_training) as counted_leads,mulai_training as count_date from tna group by mulai_training")->getResultArray();
        $sql =  $this->query("SELECT MONTH(mulai_training) as Bulan,COUNT(mulai_training) as total  FROM  tna join approval on approval.id_tna = tna.id_tna where status_approval_3 = 'accept'and status_training = 1 and YEAR(mulai_training) = $date GROUP BY  MONTH(mulai_training)")->getResultArray();

        return $sql;
    }


    //Departemen Dashboard

    public function DashboardTrainingDepartment($date, $department)
    {
        // $sql =  $this->query("Select count(mulai_training) as counted_leads,mulai_training as count_date from tna group by mulai_training")->getResultArray();
        $sql =  $this->query("SELECT MONTH(mulai_training) as Bulan,COUNT(mulai_training) as total  FROM  tna join approval on approval.id_tna = tna.id_tna join [dbo].[user] on [dbo].[user].id_user = tna.id_user where status_approval_3 = 'accept' and departemen = '$department' and YEAR(mulai_training) = $date GROUP BY  MONTH(mulai_training)")->getResultArray();

        return $sql;
    }

    public function DashboardTrainingLineDepartment($date, $department)
    {
        //$sql =  $this->query("SELECT MONTH(mulai_training) as Bulan,COUNT(mulai_training) as total  FROM  tna join approval on approval.id_tna = tna.id_tna join [user] on [user].id_user = tna.id_user where status_approval_3 = 'accept' and departemen = $department and status_training = 1 and YEAR(mulai_training) = $date GROUP BY  MONTH(mulai_training)")->getResultArray();
        $sql =  $this->query("SELECT MONTH(mulai_training) as Bulan,COUNT(mulai_training) as total  FROM  tna join approval on approval.id_tna = tna.id_tna join [dbo].[user] on [dbo].[user].id_user = tna.id_user where status_approval_3 = 'accept' and departemen = '$department' and status_training = 1 and YEAR(mulai_training) = $date GROUP BY  MONTH(mulai_training)")->getResultArray();

        return $sql;
    }


    public function getDashboardTrainingReject($year)
    {
        $this->selectCount('tna.id_tna')->where('year', $year);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'reject')->orWhere('status_approval_2', 'reject')->orWhere('status_approval_3', 'reject');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }


    public function getDashboardTrainingApproved($year)
    {
        $this->selectCount('tna.id_tna')->where('year', $year);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }

    public function getDashboardTrainingNeedApproval($year)
    {
        $this->selectCount('tna.id_tna')->where('year', $year);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->Where('status_approval_1', NULL)->orWhere('status_approval_3', NULL);
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function CountAllTraining($year)
    {
        $this->selectCount('training')->where('year', $year);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        return $this->get()->getResultArray();
    }


    public function CountTrainingImplemented($year)
    {
        $this->selectCount('training')->where('year', $year);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_training', 1);
        return $this->get()->getResultArray();
    }


    public function CountTrainingNotImplemented($year)
    {
        $this->selectCount('training')->where('year', $year);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->where('status_training', 0);
        return $this->get()->getResultArray();
    }

    public function getTrainingNotImplemented()
    {
        $this->select()->where('status_training', 0);
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }

    // public function getDasboardTrainingNeedApproved($year)
    // {
    //     $this->selectCount('tna.id_tna')->where('year', $year);
    //     $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', NULL)->orWhere('status_approval_2', NULL)->orWhere('status_approval_3', NULL);
    //     $this->join('user', 'user.id_user = tna.id_user');
    //     return $this->get()->getResultArray();
    //}
}