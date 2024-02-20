<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null) {
        if(!\App\Helpers\User::isLoggedIn()) {
            return redirect()->to('/');
        }else {
            if(!\App\Helpers\User::isAdmin()) {
                return redirect()->to('/')->with('flash-error', 'Nemáš dostatečná oprávnění!');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }
}
