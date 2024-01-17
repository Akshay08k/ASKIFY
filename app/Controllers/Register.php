<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    public function index()
    {
        return view('user/register');
    }

    public function save()
    {
        // Load the validation library
        $validation = \Config\Services::validation();
        // Define validation rules here
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[5]',
            'confpassword' => 'matches[password]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('user/register', ['validation' => $validation]);
        }
        $signupIp = $this->request->getIPAddress();
        $model = new UserModel();

        $data = [
            'username' => $this->request->getPost('name'),
            'email' => $this->request->getPost('em`a`il'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'signup_ip' => $signupIp
        ];

        $model->insert($data);
        return redirect()->to(base_url('/login'));
    }
}
