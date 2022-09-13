<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterNotLogin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if ($session->get('log') == true || $session->get('level') == 'ADMIN') {
            return redirect()->to('/home');
        } elseif ($session->get('log') == true || $session->get('level') == 'USER') {
            return redirect()->to('/home_user');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}