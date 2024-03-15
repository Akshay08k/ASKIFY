<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IPWhitelist implements FilterInterface
{
    use ResponseTrait;

    // Define the list of allowed IP addresses
    public $allowedIPs = ['127.0.0.1']; // Add your allowed IP addresses here

    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the IP address of the incoming request
        $ip = $request->getIPAddress();

        // Check if the IP address is in the whitelist
        if (!in_array($ip, $this->allowedIPs)) {
            // Unauthorized access
            return $this->failUnauthorized('Unauthorized access.');
        }

        // Proceed with the request
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // We don't need to do anything after the request is processed
        return $response;
    }
}