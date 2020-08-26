<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthAccess implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        // Do something here
        // dd($request);
        helper('custom');
        $session = \Config\Services::session();
        $menu = getMenu($session->get('level'));
        $req = \Config\Services::request();
        $access = $req->uri->getSegment(1);
        $giveAccess = false;
        foreach ($menu as $m) {
            if ($m['url'] == '/' . $access) {
                $giveAccess = true;
            }
        }

        if (!$giveAccess) {
            if ($session->get('level') == 'peserta') {
                $session->setFlashdata('fail', 'Anda Tidak Bisa Mengakses Halaman Tersebut');
                return redirect()->to(base_url('/peserta_info'));
            }
            $session->setFlashdata('fail', 'Anda Tidak Bisa Mengakses Halaman Tersebut');
            return redirect()->to(base_url('/peserta'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
