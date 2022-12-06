<?php

namespace App\Models;

use CodeIgniter\Model;

class M_EvaluasiEfektifitas extends Model
{
    protected $table      = 'evaluasi_efektivitas';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_efektivitas';
    protected $allowedFields = [
        'id_tna', 'id_user', 'pengetahuan', 'keterampilan', 'performance', 'perubahan',
        'pelatihan', 'kompetensi1', 'kompetensi2', 'kompetensi3', 'kompetensi4', 'kompetensi5', 'perubahan1', 'perubahan2',
        'perubahan3', 'perubahan4', 'perubahan5', 'keterangan1', 'keterangan2', 'keterangan3', 'keterangan4', 'keterangan5',
        'note1', 'note2', 'note3', 'note4', 'note5', 'status_efektivitas', 'score'
    ];


    public function getIdEfektivitas($id)
    {
        $this->select()->where(['evaluasi_efektivitas.id_tna' => $id]);
        $this->join('nilai', 'nilai.id_tna = evaluasi_efektivitas.id_tna');
        return $this->get()->getResultArray();
    }
}