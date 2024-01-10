<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user2';
    protected $allowedFields = ['name', 'email', 'password', 'created_at'];
}