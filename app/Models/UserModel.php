<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'email', 'name', 'is_admin', 'signup_ip', 'password_reset_hash', 'status', 'birthdate', 'location', 'about', 'profile_photo', 'gender', 'created_at', 'updated_at', 'first_login'];

    public function searchUsers($searchTerm)
    {
        $query = $this->select('id, name,username')->like('name', $searchTerm)->findAll();
        return $query;

    }
    public function updateUser($userId, $data)
    {
        // Check if the user exists
        $user = $this->find($userId);
        if (!$user) {
            return false; // User not found
        }

        // Attempt to update the user record
        try {
            $this->update($userId, $data);
            return true; // Update successful
        } catch (\Exception $e) {
            // Log the error or handle it appropriately
            log_message('error', 'Error updating user: ' . $e->getMessage());
            return false; // Update failed
        }
    }
}