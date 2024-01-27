<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        $data['error'] = session()->getFlashdata('error');
        // Get the success message from the registration redirect, if any
        $data['successMessage'] = session()->getFlashdata('successMessage');

        return view('user/login', $data);
    }

    public function auth()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            return redirect()->to(base_url('/homepage'));
        } else {
            // Set flash data for the error
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to(base_url('/login'));
        }
    }
}
