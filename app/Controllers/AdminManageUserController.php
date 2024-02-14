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

    public function deleteUser($userId)
    {
        $userModel = new UserModel();

        try {
            // Check if the user exists before attempting to delete
            $user = $userModel->find($userId);

            if (!$user) {
                return $this->response->setStatusCode(404)->setJSON(['message' => 'User not found']);
            }

            // Delete the user
            $userModel->delete($userId);

            return $this->response->setStatusCode(200)->setJSON(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Error deleting user: ' . $e->getMessage());

            // Return a response indicating the error
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Internal Server Error']);
        }
    }



}
