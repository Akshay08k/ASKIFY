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
            // Check if the user is banned
            if ($user['status'] === 'ban') {
                session()->setFlashdata('error', 'Your account has been banned. Please contact support for further assistance.');
                return redirect()->to(base_url('/login'));
            }

            // Set the user_id in the session
            session()->set('user_id', $user['id']);

            // Check if it's the user's first login
            if ($user['first_login']) {
                // Update the first_login flag in the database
                $model->update($user['id'], ['first_login' => false]);

                // Redirect to a different location for first-time login
                return redirect()->to(base_url('/updatecategory'));
            } else {
                // Redirect to the homepage
                return redirect()->to(base_url('/homepage'));
            }
        } else {
            // Set flash data for the error
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to(base_url('/login'));
        }
    }

}
