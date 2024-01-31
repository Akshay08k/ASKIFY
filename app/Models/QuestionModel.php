<?php

// app/Models/QuestionModel.php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'question';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'description',
        'media',
        'user_id',
        'likes',
        'views',
        'followers',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function incrementLikes($questionId)
    {
        $this->set('likes', 'likes + 1', false)
            ->where('id', $questionId)
            ->update();

        // Retrieve and return the updated like count
        $updatedLikes = $this->getLikeCount($questionId);
        return $updatedLikes;
    }

    public function decrementLikes($questionId)
    {
        $this->set('likes', 'likes - 1', false)
            ->where('id', $questionId)
            ->update();

        // Retrieve and return the updated like count
        $updatedLikes = $this->getLikeCount($questionId);
        return $updatedLikes;
    }

    private function getLikeCount($questionId)
    {
        return $this->select('likes')
            ->where('id', $questionId)
            ->get()
            ->getRow()
            ->likes;
    }
}