<?php

namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $table = 'answer';
    protected $primaryKey = 'id';

    protected $allowedFields = ['question_id', 'user_id', 'answer', 'likes', 'created_at', 'updated_at'];

    // Increment the like count for a specific answer
    public function incrementLikes($answerId)
    {
        $this->where('id', $answerId)->set('likes', 'likes + 1', false)->update();
        return $this->getLikes($answerId);
    }

    // Decrement the like count for a specific answer
    public function decrementLikes($answerId)
    {
        $this->where('id', $answerId)->set('likes', 'likes - 1', false)->update();
        return $this->getLikes($answerId);
    }

    // Get the current like count for a specific answer
    public function getLikes($answerId)
    {
        return $this->where('id', $answerId)->get()->getRow('likes');
    }
}
