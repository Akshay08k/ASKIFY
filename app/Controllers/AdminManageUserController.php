<?php

namespace App\Controllers;

use App\Models\FollowerModel;
use App\Models\UserModel;

use App\Controllers\BaseController;

class AdminManageUserController extends BaseController
{

    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('/admin');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->where('id', $userId)->findAll();
        return view("admin/manage_users", $data);
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
    // AdminManageUserController.php
    // AdminManageUserController.php
    public function banUser($userId)
    {
        $userModel = new UserModel();

        try {
            // Check if the user exists before attempting to ban/unban
            $user = $userModel->find($userId);

            if (!$user) {
                return $this->response->setStatusCode(404)->setJSON(['message' => 'User not found']);
            }

            // Toggle the user's ban status (you need to have a 'status' or 'role' column in your users table)
            $newStatus = $user['status'] === 'ban' ? 'active' : 'ban';

            // Update the user's status
            $userModel->update($userId, ['status' => $newStatus]);

            // Send email notification to the user
            $this->sendBanNotificationEmail($user['email'], $newStatus);

            return $this->response->setStatusCode(200)->setJSON(['message' => 'User ban status updated successfully']);

        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Error updating user ban status: ' . $e->getMessage());

            // Return a response indicating the error
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Internal Server Error']);
        }
    }

    // Function to send ban notification email// Function to send ban notification email
    private function sendBanNotificationEmail($userEmail, $newStatus)
    {
        // Load the email library
        $email = \Config\Services::email();

        // Email configuration (replace with your SMTP settings)

        // Initialize the email library with the configuration
        $email->setFrom('donateravengers@gmail.com', 'Askify Admin');
        $email->setTo($userEmail);

        // Set email subject and message based on the new status
        if ($newStatus === 'ban') {
            $email->setSubject('Notification of Account Suspension');
            $email->setMessage('<html>
        <head>
            <style>
                body {
                    font-family: "Helvetica Neue", Arial, sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Notification of Account Suspension</h2>
                <p>Dear User</p>
                <p>We regret to inform you that your account has been temporarily suspended due to a violation of our terms and conditions. Please review our policies to understand the reasons for this action.</p>
                <p>If you have any concerns or would like to appeal this decision, please contact our support team at <a href="mailto:donateravengers@gmail.com">support@example.com</a>.</p>
                <p>Sincerely,<br>Askify Admin</p>
            </div>
        </body>
        </html>');
        } else {
            $email->setSubject('Notification of Account Reinstatement');
            $email->setMessage('<html>
        <head>
            <style>
                body {
                    font-family: "Helvetica Neue", Arial, sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Notification of Account Reinstatement</h2>
                <p>Dear User</p>
                <p>We are pleased to inform you that the suspension on your account has been lifted. You can now regain access and continue using our services.</p>
                <p>If you have any questions or require further assistance, please feel free to contact our support team at <a href="mailto:donateravengers@gmail.com">support@example.com</a>.</p>
                <p>Welcome back!</p>
                <p>Sincerely,<br>Askify Admin</p>
            </div>
        </body>
        </html>');
        }


        // Send the email
        if ($email->send()) {
            // Success
            log_message('info', 'Ban notification email sent successfully to: ' . $userEmail);
        } else {
            // Error
            log_message('error', 'Error sending ban notification email to: ' . $userEmail . ', Error: ' . $email->printDebugger(['headers']));
        }
    }
    public function getUsers()
    {
        $userModel = new UserModel();

        // Fetch all followed users' ids

        // Fetch user details for the followed users    
        $users = $userModel->findAll();

        $userList = [];
        foreach ($users as $user) {
            $userList[] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'name' => $user['name'],
                'gender' => $user['gender'],
                'email' => $user['email'],
                'status' => $user['status']
            ];
        }
        echo json_encode($userList);

    }


}
