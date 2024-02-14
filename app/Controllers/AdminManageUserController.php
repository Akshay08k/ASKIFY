<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Controllers\BaseController;

class AdminManageUserController extends BaseController
{

    public function index()
    {
        return view("admin/manage_users");
    }

    // Controller function
    public function deleteUser($userId)
    {
        $userModel = new UserModel();

        try {
            // Check if the user exists before attempting to delete
            $user = $userModel->find($userId);

            if (!$user) {
                return $this->response->setStatusCode(404)->setJSON(['message' => 'User not found']);
            }

            // Get the email address before deleting
            $userEmail = $user['email'];

            // Delete the user
            $userModel->delete($userId);

            // Send an email to the user
            $this->sendUserDeletionEmail($userEmail);

            return $this->response->setStatusCode(200)->setJSON(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Error deleting user: ' . $e->getMessage());

            // Return a response indicating the error
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Internal Server Error']);
        }
    }

    // Email sending function
    private function sendUserDeletionEmail($userEmail)
    {
        // Load the email library
        $email = \Config\Services::email();

        // Email configuration (replace with your SMTP settings)
        $config = [
            'protocol' => 'smtp',
            'SMTPHost' => 'smtp.gmail.com',
            'SMTPUser' => 'donateravengers@gmail.com',
            'SMTPPass' => 'ozfw cluc mqqo lgsf',
            'SMTPPort' => 587, // Adjust the port as needed
            'SMTPCrypto' => 'tls', // 'ssl' or 'tls'
            'mailType' => 'html', // You can change this to 'text' if needed
            'charset' => 'utf-8',
            'wordWrap' => true,
        ];

        // Initialize the email library with the configuration
        $email->initialize($config);
        $email->setFrom('donateravengers@gmail.com', 'Askify Admin');
        $email->setTo($userEmail);
        $email->setSubject('Account Deletion Notification');
        $email->setMessage('
    <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }
                .container {
                    width: 70%;
                    margin: auto;
                    overflow: hidden;
                }
                main {
                    padding: 20px 0;
                }
                footer {
                    background: #333;
                    color: #fff;
                    text-align: center;
                    padding: 10px 0;
                    position: fixed;
                    bottom: 0;
                    width: 100%;
                }
            </style>
        </head>
        <body>
            <main>
                <div class="container">
                    <p>Hello there,</p>
                    <p>We have noticed that you have violated our terms and conditions on Askify, leading to the decision to delete your account.</p>
                    <p>If you have any questions or concerns, please feel free to contact our support team.</p>
                    <p>Thank you for your understanding.</p>
                </div>
            </main>
            <footer>
                <div class="container">
                    <p>&copy; 2024 Askify</p>
                </div>
            </footer>
        </body>
    </html>'
        );

        // Send the email
        if ($email->send()) {
            // Success
            log_message('info', 'Email sent successfully to: ' . $userEmail);
        } else {
            // Error
            log_message('error', 'Error sending email to: ' . $userEmail . ', Error: ' . $email->printDebugger(['headers']));
        }
    }




}
