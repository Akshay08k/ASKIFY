<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'text',
        'created_at',
        'UserRating'
    ];
}