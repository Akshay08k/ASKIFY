<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IPWhitelistFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //ALLLOWED IPS
        $allowedIPs = ['::1', 'localhost'];

        //REQUESTED IP
        $clientIP = $request->getIPAddress();

        //VALIDATION
        if (!in_array($clientIP, $allowedIPs)) {
            return redirect('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // IF OKAY THEN GO \...
    }
}
