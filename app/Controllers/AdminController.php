<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $data['error'] = session()->getFlashdata('error');
        // Get the success message from the registration redirect, if any
        $data['successMessage'] = session()->getFlashdata('successMessage');

        return view('admin/login', $data);
    }

    public function auth()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['is_admin']) {
                // User is an admin, set user_id in session
                session()->set('user_id', $user['id']);
                return redirect()->to(base_url('/admin/dashboard'));
            } else {
                // User is not an admin, throw error
                session()->setFlashdata('error', 'You are not authorized as an admin');
                return redirect()->to(base_url('/admin'));
            }
        } else {
            // Set flash data for the error
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to(base_url('/admin'));
        }
    }



    public function AdminProfile()
    {
        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('/admin');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->where('id', $userId)->findAll();
        return view("admin/manage_account", $data);
    }
}
