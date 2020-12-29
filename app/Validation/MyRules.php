<?php

namespace App\Validation;

use App\Models\Mdata;

class MyRules
{


    public function cek(string $n, string &$error = null): bool
    {
        $this->request = \Config\Services::request();
        $nis = trim($this->request->getPost('nis'));
        $date = $this->request->getPost('date');
        $dt1 = date('Y-m-d', strtotime($date));

        $wh = ['al_nis' => $nis, 'al_birth' => $dt1];

        $this->mdata = new Mdata;
        $cc = $this->mdata->cc($wh, 'tb_al');

        if ($cc) {
            return true;
            // $error = lang($date); // direct message    
        } else {
            return false;
            $error = lang($date); // direct message    
        }
    }
}
