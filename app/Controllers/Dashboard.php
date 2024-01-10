<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
  
class Dashboard extends Controller
{
    public function index()
    {
        $data = array();
    return view('dashboard');
    }
}