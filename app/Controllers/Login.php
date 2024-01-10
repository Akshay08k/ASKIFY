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

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return view("user/homepage");
            } else {
                
                return view("user/login");
            }
        } else {
            return view("user/register");
        }
    }
}
