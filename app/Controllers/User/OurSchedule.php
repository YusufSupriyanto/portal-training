<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class OurSchedule extends BaseController
{

    public function __construct()
    {
    }
    public function member()
    {

        $data = [
            'tittle' => 'Jadwal Training Member'
        ];
        return view('user/memberschedule', $data);
    }
}