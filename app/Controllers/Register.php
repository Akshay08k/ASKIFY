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

        $validation = \Config\Services::validation();
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
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'signup_ip' => $signupIp
        ];

        $model->insert($data);

        // Redirect to the login page with success message
        $successMessage = 'Registration successful! Please login with your credentials.';
        return redirect()->to(base_url('/login'))->with('successMessage', $successMessage);
    }
}
