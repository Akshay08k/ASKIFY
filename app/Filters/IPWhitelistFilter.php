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
        $allowedIPs = ['localhost', '::1', '51.20.71.103'];

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
