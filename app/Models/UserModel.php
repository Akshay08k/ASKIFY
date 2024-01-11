<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'email','name','is_admin','signup_stamp','signup_ip', 'categories','password_reset_hash','actvation_hash','status','birthdate','location','about','profile_photo','gender','lsat_visit','created_at','updated_at'];
}