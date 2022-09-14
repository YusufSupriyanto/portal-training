<?php

namespace App\Models;

use CodeIgniter\Model;

class M_EvaluasiReaksi extends Model
{
    protected $table      = 'evaluasi_reaksi';
    // protected $useAutoIncrement = true;
    protected $primaryKey = 'id_reaksi';
    protected $allowedFields = [
        'id_tna', 'program', 'tampilan',
        'program_training', 'metode', 'penambahan_keterampilan', 'kelayakan',
        'kelayakan_akomodasi', 'harapan', 'perbaikan_program', 'instruktur_1',
        'instruktur_2', 'instruktur_3', 'instruktur_4', 'instruktur_5', 'pengetahuan1',
        'pengetahuan2', 'pengetahuan3', 'pengetahuan4', 'pengetahuan5', 'kemampuan1',
        'kemampuan2', 'kemampuan3', 'kemampuan4', 'kemampuan5', 'kemampuan_melibatkan1',
        'kemampuan_melibatkan2', 'kemampuan_melibatkan3', 'kemampuan_melibatkan4', 'kemampuan_melibatkan5',
        'kemampuan_menanggapi1', 'kemampuan_menanggapi2', 'kemampuan_menanggapi3', 'kemampuan_menanggapi4',
        'kemampuan_menanggapi5', 'kemampuan_mengendalikan1', 'kemampuan_mengendalikan2', 'kemampuan_mengendalikan3',
        'kemampuan_mengendalikan4', 'kemampuan_mengendalikan5', 'harapan_instruktur', 'peningkatan_instruktur', 'wawasan',
        'skill', 'rekomendasi', 'kebutuhan', 'status_evaluasi'
    ];

    public function getIdReaksi($id)
    {
        return $this->where(['id_tna' => $id])->first();
    }
}