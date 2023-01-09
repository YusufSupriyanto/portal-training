<?php

namespace App\Models;

use CodeIgniter\Model;

class M_TnaUnplanned extends Model
{
    protected $table      = 'tna';
    protected $primaryKey = 'id_tna';
    // protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_user', 'id_training', 'dic', 'divisi',
        'departemen', 'nama', 'jabatan', 'golongan', 'seksi', 'jenis_training',
        'kategori_training', 'training', 'vendor', 'tempat', 'metode_training', 'mulai_training', 'rencana_training',
        'tujuan_training', 'notes', 'biaya', 'biaya_actual', 'status', 'kelompok_training'
    ];


    private UserModel $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }


    public function getTnaUser($id)
    {
        $this->selectCount('id_user')->where('id_user', $id)->where('kelompok_training', 'unplanned');
        return $this->get()->getResultArray();
    }

    public function getDetailHistory($id)
    {
        $this->select()->where('id_user', $id)->where('kelompok_training', 'unplanned');
        $this->join('history', 'history.id_tna=tna.id_tna');
        return $this->get()->getResultArray();
    }

    public function getAllTna($id = false)
    {
        if ($id == false) {
            $this->select();
            return $this->get()->getResult();
        }
        return $this->where('id_tna', $id)->get()->getResult();
    }
    public function getAllSave($id = false)
    {
        if ($id == false) {
            $this->select()->where('status', 'save');
            return $this->get()->getResult();
        }
        return $this->where(['id_tna' => $id])->get()->getResult();
    }

    public function getUserTna($id)
    {
        $this->select()->where(['id_user' => $id])->where('kelompok_training', 'unplanned');
        return $this->get()->getResultArray();
    }

    public function getUserTnaUnplanned($id)
    {
        $this->select()->where('id_user', $id)->where('kelompok_training', 'unplanned');
        return $this->get()->getResult();
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
    //     } elseif ($user['bagian'] == 'KASIE' || $user['bagian'] == 'STAFF 4UP') {
    //         $this->select()->where('seksi', $user['seksi'])->where('status', 'save')->where('kelompok_training', 'unplanned');
    //         return $this->get()->getResult();
    //     } else {
    //         $this->select()->where('id_user', $user['id_user'])->where('status', 'save')->where('kelompok_training', 'unplanned');
    //         return $this->get()->getResult();
    //     }
    // }




    public function getTnaFilterDistinct($id)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select('user.departemen')->where('user.dic', $user['dic'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->distinct()->where('bagian', 'KADIV');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select('user.departemen')->where('user.divisi', $user['divisi'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->distinct()->where('bagian', 'KADEPT');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select('user.departemen')->where('user.departemen', $user['departemen'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->distinct()->whereIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KASIE' || $user['bagian'] == 'STAFF 4UP') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select('user.departemen')->where('user.seksi', $user['seksi'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->distinct()->WhereNotIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } else {
            $this->select('user.departemen')->where('tna.id_user', $user['id_user'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->distinct();
            return $this->get()->getResult();
        }
    }

    public function getTnaFilterKadept($id, $departemen = false)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select()->where('user.dic', $user['dic'])->where('user.departemen', $departemen)->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->where('bagian', 'KADIV');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select()->where('user.divisi', $user['divisi'])->where('user.departemen', $departemen)->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->where('bagian', 'KADEPT');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select()->where('user.departemen', $departemen)->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->whereIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KASIE' || $user['bagian'] == 'STAFF 4UP') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select()->where('user.seksi', $user['seksi'])->where('user.departemen', $departemen)->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->WhereNotIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } else {
            $this->select()->where('tna.id_user', $user['id_user'])->where('departemen', $departemen)->where('status', 'save')->where('kelompok_training', 'unplanned');
            return $this->get()->getResult();
        }
    }

    public function getTnaFilterUnplanned($id)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select('tna.*,user.*')->where('user.dic', $user['dic'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->where('bagian', 'KADIV');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select('tna.*,user.*')->where('user.divisi', $user['divisi'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->where('bagian', 'KADEPT');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select('tna.*,user.*')->where('user.departemen', $user['departemen'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->whereIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KASIE' || $user['bagian'] == 'STAFF 4UP') {
            $bagian = ['KASIE', 'STAFF 4UP'];
            $this->select('tna.*,user.*')->where('user.seksi', $user['seksi'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned')->WhereNotIn('bagian', $bagian);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResult();
        } else {
            $this->select()->where('tna.id_user', $user['id_user'])->where('tna.status', 'save')->where('kelompok_training', 'unplanned');
            return $this->get()->getResult();
        }
    }
    public function getStatusWaitAdminUnplannedDistinct()
    {
        $this->select('user.departemen')->where('tna.status', 'wait')->where('kelompok_training', 'unplanned')->distinct();
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResult();
    }
    public function getStatusWaitAdminUnplanned($departemen)
    {
        $this->select()->where('tna.status', 'wait')->where('kelompok_training', 'unplanned');
        $this->join('user', 'user.id_user = tna.id_user')->where('user.departemen', $departemen);
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        return $this->get()->getResult();
    }

    // public function getStatusWaitAdminUnplanned()
    // {
    //     $this->select()->where('status', 'wait')->where('kelompok_training', 'unplanned');
    //     $this->join('approval', 'approval.id_tna = tna.id_tna');
    //     return $this->get()->getResult();
    // }

    public function getStatusWaitUser($bagian, $member, $id = null)
    {
        if ($bagian == 'BOD') {
            $status = ['wait', 'accept'];
            $this->select('tna.*,approval.*,user.bagian')->where('user.dic', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $jabatan = ['KADIV'];
            $status = ['wait', 'accept'];
            $this->select('tna.*,approval.*,user.bagian')->where('user.divisi', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $status = ['wait', 'accept'];
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('user.departemen', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KASIE') {
            // $status = ['wait', 'accept'];
            // $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('user.seksi', $member)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } else {
            $this->select('tna.*,approval.*,user.bagian')->where('tna.id_user', $id)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        }
    }

    //function untuk menampilkan data tna yang sudah di accept
    public function getKadivStatusUnplanned()
    {
        $this->select()->where('tna.status', 'accept')->where('kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna'); //->where('status_approval_1', null)->orWhere('status_approval_1', 'reject')
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }


    //function get Request Tna
    public function getRequestTnaUnplannedDistinct($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select('user.departemen')->where('user.dic', $member)->where('tna.status', 'accept')->where('status_approval_0', 'accept')->where('status_approval_1', 'accept')->where('status_approval_2', 'accept')->where('status_approval_3', null)->where('kelompok_training', 'unplanned')->distinct();
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select('user.departemen')->where('user.divisi', $member)->where('tna.status', 'accept')->where('kelompok_training', 'unplanned')->distinct();
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', 'accept')->where('status_approval_1', null);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $this->select('user.departemen')->where('user.departemen', $member)->where('tna.status', 'accept')->where('kelompok_training', 'unplanned')->distinct();
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', null);
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }
    }

    public function getRequestTnaUnplanned($bagian, $member, $departemen)
    {
        if ($bagian == 'BOD') {
            $this->select()->where('user.dic', $member)->where('user.departemen', $departemen)->where('tna.status', 'accept')->where('status_approval_0', 'accept')->where('status_approval_1', 'accept')->where('status_approval_2', 'accept')->where('status_approval_3', null)->where('kelompok_training', 'unplanned');
            $this->join('user', 'user.id_user = tna.id_user');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select()->where('user.divisi', $member)->where('user.departemen', $departemen)->where('tna.status', 'accept')->where('kelompok_training', 'unplanned');
            $this->join('user', 'user.id_user = tna.id_user');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', 'accept')->where('status_approval_1', null);
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $this->select()->where('user.departemen', $member)->where('user.departemen', $departemen)->where('tna.status', 'accept')->where('kelompok_training', 'unplanned');
            $this->join('user', 'user.id_user = tna.id_user');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', null);
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }
    }

    // public function getRequestTnaUnplanned($bagian, $member)
    // {
    //     if ($bagian == 'BOD') {
    //         $this->select()->where('dic', $member)->where('status', 'accept')->where('status_approval_0', 'accept')->where('status_approval_1', 'accept')->where('status_approval_2', 'accept')->where('status_approval_3', null)->where('kelompok_training', 'unplanned');
    //         $this->join('approval', 'approval.id_tna = tna.id_tna');
    //         return $this->get()->getResultArray();
    //     } elseif ($bagian == 'KADIV') {
    //         $this->select()->where('divisi', $member)->where('status', 'accept')->where('kelompok_training', 'unplanned');
    //         $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', 'accept')->where('status_approval_1', null);
    //         return $this->get()->getResultArray();
    //     } elseif ($bagian == 'KADEPT') {
    //         $this->select()->where('departemen', $member)->where('status', 'accept')->where('kelompok_training', 'unplanned');
    //         $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', null);
    //         return $this->get()->getResultArray();
    //     } else {
    //         return  $status  =  array();
    //     }
    // }


    public function getKadivAcceptDistinct($date, $year)
    {

        $this->select('user.departemen')->where("Month(mulai_training)", $date)->where('tna.year', $year)->where('kelompok_training', 'unplanned')->distinct();
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getKadivAccept($date, $year, $departemen)
    {

        $this->select('tna.*,user.*,approval.*')->where('month(mulai_training)', $date)->where('tna.year', $year)->where('user.departemen', $departemen)->where('kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    // public function getIdTna()
    // {
    //     $this->select();
    //     return $this->get()->getLastRow();
    // }

    // public function getDetailReject($id)
    // {
    //     $this->select('tna.*,approval.*,user.bagian')->where('tna.id_tna', $id);
    //     $this->join('approval', 'approval.id_tna = tna.id_tna');
    //     $this->join('user', 'user.id_user = tna.id_user');
    //     return $this->get()->getResultArray();
    // }

    // public function getDateTraining()
    // {
    //     $this->select('tna.rencana_training,tna.training,approval.status_approval_1,approval.status_approval_2,approval.status_approval_3')->distinct();
    //     $this->join('approval', 'approval.id_tna = tna.id_tna');
    //     return $this->get()->getResult();
    // }



    public function getUnplannedMonthly($date)
    {
        $sql = $this->query("select	MONTH(tna.mulai_training) as 'Planing Training',
		count(tna.training) as 'Jumlah Training',
		count(case when approval.status_approval_2 = 'accept' then 1 else null end) as 'Admin Approval',
		count(case when approval.status_approval_3 = 'accept' then 1 else null end) as 'BOD Approval' ,
		sum(case when approval.status_approval_2='reject' then 1 when approval.status_approval_3='reject' then 1 else 0 end) as 'Reject'
from	tna  join	approval on approval.id_tna = tna.id_tna 
where	tna.kelompok_training = 'unplanned' and tna.year = $date and status_approval_0 ='accept'
group by MONTH(tna.mulai_training)")->getResultArray();

        return $sql;
    }

    // public function getTrainingDitolak()
    // {
    //     $this->select();
    //     $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'reject')->orWhere('status_approval_2', 'reject')->orWhere('status_approval_3', 'reject');
    //     return $this->get()->getResultArray();
    // }

    // public function getAtmp()
    // {
    //     $this->select('tna.*,approval.*,user.bagian,user.npk');
    //     $this->join('approval', 'approval.id_tna = tna.id_tna');
    //     $this->join('user', 'user.id_user = tna.id_user')->where('status_approval_3', 'accept');
    //     return $this->get()->getResultArray();
    // }

    public function getMemberSchedule($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select('tna.*,approval.*,user.bagian')->where('user.dic', $member)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select('tna.*,approval.*,user.bagian')->where('user.divisi', $member)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('user.departemen', $member)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
            return $this->get()->getResultArray();
        } else {
            $this->select('tna.*,approval.*,user.bagian')->where('user.seksi', $member)->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        }
    }

    public function getPersonalSchedule($id)
    {
        $this->select('tna.*,approval.*,user.bagian,user.id_user')->where('user.id_user', $id)->where('kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    // public function getDataHome()
    // {
    //     $this->select('tna.rencana_training,tna.kategori_training')->distinct();
    //     $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
    //     $this->join('user', 'user.id_user = tna.id_user');
    //     return $this->get()->getResultArray();
    // }

    // public function getDataJadwalHome($date)
    // {
    //     $this->select('training as Training,COUNT(training) as Pendaftar')->where('rencana_training', $date);
    //     $this->groupBy('training');
    //     return $this->get()->getResultArray();
    // }

    // public function getJadwalHomeVer($training, $date)
    // {
    //     $this->select('kategori_training,rencana_training')->where('rencana_training', $date)->where('training', $training);
    //     return $this->get()->getResultArray();
    // }


    public function getSchedule()
    {
        $this->select('tna.*,approval.*,user.bagian,user.departemen,user.id_user')->where('tna.kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->where('status_training', null);
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getEvaluasiReaksi($id)
    {
        $this->select('tna.*,approval.*,user.bagian,user.id_user,user.departemen,evaluasi_reaksi.*')->where('user.id_user', $id)->where('kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->where('status_training', 1);
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }

    // public function getDataForEvaluation($id)
    // {
    //     $this->select('tna.*,approval.*,user.bagian,user.id_user,user.npk')->where('tna.id_tna', $id);
    //     $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
    //     $this->join('user', 'user.id_user = tna.id_user');
    //     return $this->get()->getResultArray();
    // }

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
            $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->whereNotIn('status_training', $status);
            $this->join('user', 'user.id_user = tna.id_user')->where('user.bagian', 'KADIV')->where('user.dic', $user['dic']);
            $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($user['bagian'] == "KADIV") {
            $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->whereNotIn('status_training', $status);
            $this->join('user', 'user.id_user = tna.id_user')->where('user.bagian', 'KADEPT')->where('user.divisi', $user['divisi']);
            $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($user['bagian']  == "KADEPT") {
            $bagian = ['KASIE', 'STAFF 4UP', 'STAFF'];
            $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->whereNotIn('status_training', $status);
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('user.bagian', $bagian)->where('user.departemen', $user['departemen'])->where('user.level', 'USER');
            $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($user['bagian']  == "KASIE" || $user['bagian']  == "STAFF 4UP") {
            $bagian = ['STAFF 4UP', 'KASIE'];
            $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'unplanned');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->whereNotIn('status_training', $status);
            $this->join('user', 'user.id_user = tna.id_user')->where('user.seksi', $user['seksi'])->where('user.level', 'USER')->whereNotIn('user.bagian', $bagian);
            $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } else {
            return 'E';
        }

        // $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'unplanned');
        // $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        // $this->join('user', 'user.id_user = tna.id_user');
        // $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
        // return $this->get()->getResultArray();
    }
    public function getHistoryUnplanned($id)
    {
        $this->select()->where('tna.id_user', $id)->where('kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna')->where('status_evaluasi', '1');
        return $this->get()->getResult();
    }
    public function getUnplannedTerdaftar($id)
    {
        $this->select()->where('tna.id_user', $id)->where('kelompok_training', 'unplanned');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna')->where('status_evaluasi', null);
        return $this->get()->getResult();
    }
}