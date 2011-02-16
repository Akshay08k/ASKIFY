<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeAnswerModel extends Model
{
    protected $table            = 'liked_answer';
    protected $primaryKey       = 'id';
    protected $allowedFields  = ['answer_id','user_id','liked_at'];
}
