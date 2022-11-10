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
        'tujuan_training', 'notes', 'biaya', 'biaya_actual', 'status', 'kelompok_training'
    ];


    private UserModel $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function getTnaByid($id)
    {
        $this->select()->where('id_tna', $id);
        return $this->get()->getResultArray();
    }

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
            $this->select();
            return $this->get()->getResult();
        }
        return $this->where('id_tna', $id)->get()->getResult();
    }

    public function getTnaForRole($id)
    {
        $this->select()->where('id_tna', $id);
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
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
        $this->select()->where(['id_user' => $id])->where('kelompok_training', 'training');
        return $this->get()->getResultArray();
    }

    public function getUserTnaUnplanned($id)
    {
        $this->select()->where(['id_user' => $id])->where('kelompok_training', 'unplanned');
        return $this->get()->getResult();
    }

    public function getTnaFilter($id)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select()->where('dic', $user['dic'])->where('status', 'save')->where('kelompok_training', 'training');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select()->where('divisi', $user['divisi'])->where('status', 'save')->where('kelompok_training', 'training');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $this->select()->where('departemen', $user['departemen'])->where('status', 'save')->where('kelompok_training', 'training');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KASIE' || $user['bagian'] == 'STAFF 4UP') {
            $this->select()->where('seksi', $user['seksi'])->where('status', 'save')->where('kelompok_training', 'training');
            return $this->get()->getResult();
        } else {
            $this->select()->where('id_user', $user['id_user'])->where('status', 'save')->where('kelompok_training', 'training');
            return $this->get()->getResult();
        }
    }

    public function getTnaFilterUnplanned($id)
    {
        $user = $this->user->getAllUser($id);

        if ($user['bagian'] == 'BOD') {
            $this->select()->where('dic', $user['dic'])->where('status', 'save')->where('kelompok_training', 'unplanned');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADIV') {
            $this->select()->where('divisi', $user['divisi'])->where('status', 'save')->where('kelompok_training', 'unplanned');
            return $this->get()->getResult();
        } elseif ($user['bagian'] == 'KADEPT') {
            $this->select()->where('departemen', $user['departemen'])->where('status', 'save')->where('kelompok_training', 'unplanned');
            return $this->get()->getResult();
        } else {
            $this->select()->where('id_user', $user['id_user'])->where('status', 'save')->where('kelompok_training', 'unplanned');
            return $this->get()->getResult();
        }
    }

    public function getStatusWaitAdminDepartemen()
    {
        $this->select('tna.departemen')->where('tna.status', 'wait')->where('kelompok_training', 'training');
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->groupBy('tna.departemen');
        return $this->get()->getResult();
    }
    public function getStatusWaitAdmin($departemen)
    {
        $this->select()->where('tna.status', 'wait')->where('kelompok_training', 'training')->where('tna.departemen', $departemen);
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
        if ($bagian == 'BOD') {
            $status = ['wait', 'accept'];
            $this->select('tna.*,approval.*,user.bagian')->where('tna.dic', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $jabatan = ['KADIV'];
            $status = ['wait', 'accept'];
            $this->select('tna.*,approval.*,user.bagian')->where('tna.divisi', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $status = ['wait', 'accept'];
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('tna.departemen', $member)->whereIn('tna.status', $status)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KASIE') {
            // $status = ['wait', 'accept'];
            // $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('tna.seksi', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            $this->join('user', 'user.id_user = tna.id_user');
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
        $this->select()->where('status', 'accept')->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna'); //->where('status_approval_1', null)->orWhere('status_approval_1', 'reject')
        return $this->get()->getResultArray();
    }


    //function get Request Tna
    public function getRequestTna($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select()->where('dic', $member)->where('status', 'accept')->where('status_approval_0', 'accept')->where('status_approval_1', 'accept')->where('status_approval_2', 'accept')->where('status_approval_3', null)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select()->where('divisi', $member)->where('status', 'accept')->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', 'accept')->where('status_approval_1', null);
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $this->select()->where('departemen', $member)->where('status', 'accept')->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_0', null);
            return $this->get()->getResultArray();
        } else {
            return  $status  =  array();
        }
    }


    public function getKadivAccept($date)
    {

        $this->select()->where('mulai_training', $date)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'accept');
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



    public function getTrainingMonthly()
    {
        $sql = $this->query("select tna.mulai_training as 'Planing Training', count(distinct tna.training) as 'Jumlah Training',count(distinct approval.status_approval_2) as 'Admin Approval',count(distinct approval.status_approval_3) as 'BOD Approval'
            from tna join approval on approval.id_tna = tna.id_tna where tna.kelompok_training = 'training' and approval.status_approval_1 = 'accept' group by tna.mulai_training")->getResultArray();

        return $sql;
    }

    public function getTrainingDitolak()
    {
        $this->select();
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_1', 'reject')->orWhere('status_approval_2', 'reject')->orWhere('status_approval_3', 'reject');
        return $this->get()->getResultArray();
    }

    public function getAtmp()
    {
        $this->select('tna.*,approval.*,user.bagian,user.npk');
        $this->join('approval', 'approval.id_tna = tna.id_tna');
        $this->join('user', 'user.id_user = tna.id_user')->where('status_approval_3', 'accept');
        return $this->get()->getResultArray();
    }

    public function getMemberSchedule($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select('tna.*,approval.*,user.bagian')->where('tna.dic', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select('tna.*,approval.*,user.bagian')->where('tna.divisi', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('tna.departemen', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->whereIn('bagian', $jabatan);
            return $this->get()->getResultArray();
        } else {
            $this->select('tna.*,approval.*,user.bagian')->where('tna.seksi', $member)->where('kelompok_training', 'training');
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user');
            return $this->get()->getResultArray();
        }
    }

    public function getMemberHistory($bagian, $member)
    {
        if ($bagian == 'BOD') {
            $this->select('tna.*,approval.*,user.bagian')->where('tna.dic', $member);
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADIV');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADIV') {
            $this->select('tna.*,approval.*,user.bagian')->where('tna.divisi', $member);
            $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
            $this->join('user', 'user.id_user = tna.id_user')->where('bagian', 'KADEPT');
            return $this->get()->getResultArray();
        } elseif ($bagian == 'KADEPT') {
            $jabatan = ['STAFF', 'STAFF 4UP', 'KASIE'];
            $this->select('tna.*,approval.*,user.bagian')->where('tna.departemen', $member);
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

        $sql = $this->query("select id_training,metode_training,jenis_training, training as Training,COUNT(training) as Pendaftar,kategori_training,mulai_training,rencana_training,biaya_actual from tna where mulai_training = '$date' and kelompok_training = 'training' group by id_training,training,kategori_training,metode_training,jenis_training,mulai_training,rencana_training,biaya_actual");
        return  $sql->getResultArray();
    }

    public function getJadwalHomeVer($date)
    {
        $this->select()->where('mulai_training', $date)->where('kelompok_training', 'training');
        return $this->get()->getResultArray();
    }


    public function getSchedule()
    {
        $this->select('tna.*,approval.*,user.bagian,user.id_user')->where('tna.kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->where('status_training', null);
        $this->join('user', 'user.id_user = tna.id_user');
        return $this->get()->getResultArray();
    }

    public function getEvaluasiReaksi($id)
    {
        $this->select('tna.*,approval.*,user.bagian,user.id_user,evaluasi_reaksi.*')->where('user.id_user', $id)->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept')->where('status_training', 1);
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }

    public function getDataForEvaluation($id)
    {
        $this->select('tna.*,approval.*,user.bagian,user.id_user,user.npk')->where('tna.id_tna', $id);
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
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
        // $this->select('tna.*,approval.*,user.bagian,user.id_user,user.npk')->where('user.id_user', $id)->where('kelompok_training', 'unplanned');;
        // $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        // $this->join('user', 'user.id_user = tna.id_user');
        // return $this->get()->getResultArray();
    }

    public function getDataHistory($id)
    {
        $this->select()->where('tna.id_tna', $id);
        $this->join('history', 'history.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }

    // public function getDataHistory($id)
    // {
    //     $this->select('tna.*,approval.*,user.bagian,user.id_user,user.npk')->where('tna.id_tna', $id);
    //     $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
    //     $this->join('user', 'user.id_user = tna.id_user');
    //     return $this->get()->getResultArray();
    // }


    public function getDetailEvaluasiReaksi($id)
    {
        $this->select('tna.*,user.bagian,user.id_user,user.npk,evaluasi_reaksi.*')->where('tna.id_tna', $id);
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_reaksi', 'evaluasi_reaksi.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
    }


    public function getDataEfektivitas()
    {
        $this->select('tna.*,user.bagian,approval.*,user.id_user,user.npk,evaluasi_efektivitas.status_efektivitas')->where('kelompok_training', 'training');
        $this->join('approval', 'approval.id_tna = tna.id_tna')->where('status_approval_3', 'accept');
        $this->join('user', 'user.id_user = tna.id_user');
        $this->join('evaluasi_efektivitas', 'evaluasi_efektivitas.id_tna = tna.id_tna');
        return $this->get()->getResultArray();
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
}