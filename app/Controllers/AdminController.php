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
    public function updateProfile()
    {

        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You are not logged in.');
        }

        $userModel = new UserModel();
        $userData = $userModel->find($userId);

        if (empty($userData)) {
            return redirect()->to('/user/404page')->with('error', 'User not found.');
        }

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'username' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email',
                'name' => 'required|min_length[3]|max_length[50]',
                'categories' => 'permit_empty|max_length[255]',
                'birthdate' => 'required|valid_date[Y-m-d]',
                'location' => 'permit_empty|max_length[255]',
                'about' => 'permit_empty',
                'gender' => 'required|in_list[male,female,other]',
                'profile_photo' => 'max_size[profile_photo,10240]',
            ];
            //$this->request->do_upload()  is method to upload the file
            if ($this->validate($validationRules)) {
                $data = [
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'name' => $this->request->getPost('name'),
                    'categories' => $this->request->getPost('categories'),
                    'birthdate' => $this->request->getPost('birthdate'),
                    'location' => $this->request->getPost('location'),
                    'about' => $this->request->getPost('about'),
                    'gender' => $this->request->getPost('gender'),
                    'insgtagram' => $this->request->getPost('instagram'),
                    'discordlink' => $this->request->getPost('discord'),
                    'twitter' => $this->request->getPost('twitter'),
                    'github' => $this->request->getPost('github'),
                ];

                $profilePhoto = $this->request->getFile('profile_photo');

                if ($profilePhoto->isValid() && !$profilePhoto->hasMoved()) {
                    $newName = $userData['username'] . '.' . $profilePhoto->getExtension();
                    $profilePhoto->move(ROOTPATH . 'public/images/userprofilephoto', $newName);

                    // Update the 'profile_photo' column to store the image content as blob
                    $data['profile_photo'] = file_get_contents(ROOTPATH . 'public/images/userprofilephoto/' . $newName);
                }

                $userModel->update($userId, $data);

                // Remove the uploaded image file after updating the database
                // this is used to remove file from userprofilephoto 
                // unlink(ROOTPATH . 'public/images/userprofilephoto/' . $newName);

                return redirect()->to("admin/manage_accounts")->with('success', 'Profile updated successfully.');
            } else {
                return view('/admin/manage_accounts', ['validation' => $this->validator, 'userData' => $userData]);
            }
        }

        return view('admin/manage_accounts', ['userData' => $userData]);
    }
}
