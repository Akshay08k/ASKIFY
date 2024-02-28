<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        $data["ErrorMessage"] = session()->getFlashdata('User Not Found');
        return view('user/Forgotpass', $data);
    }
    public function ResetPass()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $user = $userModel->where('email', $email)->first();
        if ($user == null) {
            $error = "User Not Found With This Email Id";
            session()->setFlashdata('error', $error);
            return redirect()->to('/forgotpassword');
        }

        $userName = $user['name'];

        if ($user) {
            $newPassword = $this->generateRandomPassword();
            $encryptedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $userModel->update($user['id'], ['password' => $encryptedPassword]);
            $this->sendNewPasswordEmail($userName, $email, $newPassword);
            $data['successMessage'] = "Password reset successfully. Check your email for the new password.";
        } else {
            $data['errorMessage'] = "Email not found. Please check your email address and try again.";
        }

        // Load the view with the data
        return view('user/login', $data);
    }
    private function generateRandomPassword($length = 10)
    {
        // Generate a random password using a combination of letters, numbers, and symbols
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+=-';
        $randomPassword = '';

        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomPassword;
    }

    private function sendNewPasswordEmail($userName, $useremail, $newPassword)
    {
        // Use CodeIgniter's email class
        $email = \Config\Services::email();

        // Email configuration
        $email->setFrom('donateravengers@gmail.com', 'Askify ADMIN');
        $email->setTo($useremail);
        $email->setSubject('Password Reset');

        // Email content with HTML template
        $message = "
        <!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Password Reset Confirmation</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f5f5f5;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 50px auto;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                }
                h1 {
                    color: #3498db;
                }
                p {
                    line-height: 1.6;
                }
                strong {
                    color: #e74c3c;
                }
                .footer {
                    margin-top: 20px;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                    text-align: center;
                    color: #777;
                }
            </style>
        </head>
        <body>
            <div class=\"container\">
                <h1>Password Reset Confirmation</h1>
                <p>Hello  $userName</p>
                <p>Your password has been successfully reset. Here is your new password: <strong>{$newPassword}</strong>.</p>
                <p>Thank you,</p>
                <p>Askify</p>
            </div>
            <div class=\"footer\">
                &copy;Askify. All rights reserved.
            </div>
        </body>
        </html>
        ";
        $email->setMessage($message);
        $email->setMailType('html');

        // Send email
        if (!$email->send()) {
            // Log or handle email sending error
            echo $email->printDebugger(['headers']);
        }
    }
}
