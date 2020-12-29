<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Mdata;

class Authf implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->mdata = new Mdata;
        $session = session();
        $nama = $session->nama;
        $id = $session->id;
        $user = ['account_id' => $id, 'account_name' => $nama];

        $ff = $this->mdata->cc($user, 'tb_account');
        if (!$ff) {
            return redirect('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
