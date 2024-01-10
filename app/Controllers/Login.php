<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        return view('user/login');
    }

    public function auth()
{
    $model = new UserModel();

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $model->where('email', $email)->first();

    if ($user && password_verify($password, $user['password'])) {
        // Set user ID in session upon successful login
        session()->set('user_id', $user['id']);
        return redirect()->to(base_url('homepage'));
    } else {
        return redirect()->to(base_url('user/login'));
    }
}

    
}
