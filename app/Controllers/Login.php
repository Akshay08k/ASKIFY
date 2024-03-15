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

        // Validate email and password
        if (empty($email) || empty($password)) {
            session()->setFlashdata('error', 'Please provide both email and password.');
            return redirect()->to(base_url('/login'));
        }

        // Check if user exists
        $user = $model->where('email', $email)->first();
        if (!$user || !password_verify($password, $user['password'])) {
            // Invalid email or password
            session()->setFlashdata('error', 'Invalid email or password.');
            return redirect()->to(base_url('/login'));
        }

        session()->set('user_id', $user['id']);
        // Check if the user is banned
        if ($user['first_login'] == true) {
            // Set the data to update
            // Set the data to update
            $data = [
                'first_login' => false// Ensure this matches your database enum or boolean value
            ];

            // Attempt to update the first_login flag
            try {
                // Update the first_login flag in the database
                $updated = $model->updateUser($user['id'], $data);

                // Check if the update was successful
                if (!$updated) {
                    throw new \Exception('Failed to update first_login flag.');
                }
            } catch (\Exception $e) {
                // Log the error
                log_message('error', 'Error updating first_login flag: ' . $e->getMessage());

                // Set flash message for the user
                session()->setFlashdata('error', $e->getMessage());

                // Redirect the user back to the login page
                return redirect()->to(base_url('/login'));
            }


            // Redirect to a different location for first-time login
            return redirect()->to(base_url('/updatecategory'));
        }
        return redirect()->to('/homepage');
    }


}
