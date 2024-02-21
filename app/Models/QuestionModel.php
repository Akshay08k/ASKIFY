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
        'Hidden',
        'category_id',
        'followers',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getLikes($questionId)
    {
        return $this->where('id', $questionId)->get()->getRow('likes');
    }

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
    public function updateQuestionStatus($qaId)
    {
        return $this->set(['Hidden' => 1])->where('id', $qaId)->update();
    }
    public function isQuestionStatusUpdated($qaId)
    {
        // Check if the question status is already updated in the database
        $result = $this->where('id', $qaId)
            ->where('Hidden', 1)
            ->countAllResults();

        return $result > 0;
    }
 

}