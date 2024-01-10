<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table      = 'question';
    protected $primaryKey = 'id'; 
    protected $allowedFields = [ 'title', 'description', 'media', 'user_id', 'likes', 'views', 'followers', 'created_at', 'updated_at', 'deleted_at'];

}
