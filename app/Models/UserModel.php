<?php

namespace App\Models;

use CodeIgniter\Model;

class UpdateDetailsModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['name', 'gender', 'bio', 'role', 'categories']; 
}
