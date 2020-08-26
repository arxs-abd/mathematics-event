<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        // Do something here
        $session = \Config\Services::session();
        if (!session()->get('name')) {
            $session->setFlashdata('loginfail', 'Anda Tidak Boleh Mengakses Halaman Tersebut');
            return redirect()->to(base_url('/login'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
