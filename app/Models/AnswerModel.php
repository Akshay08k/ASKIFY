<?php

namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $table = 'answer';
    protected $primaryKey = 'id';

    protected $allowedFields = ['question_id', 'user_id', 'answer', 'likes', 'created_at', 'updated_at', 'vote'];

}