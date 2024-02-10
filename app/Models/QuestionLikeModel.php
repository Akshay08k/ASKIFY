<?php

// QuestionLikeModel.php

namespace App\Models;

use CodeIgniter\Model;

class QuestionLikeModel extends Model
{
    protected $table = 'question_likes';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'question_id',
        'created_at'
    ];



    public function addLike($userId, $questionId)
    {
        $data = [
            'user_id' => $userId,
            'question_id' => $questionId,
        ];

        $this->insert($data);
    }

    public function removeLike($userId, $questionId)
    {
        $this->where(['user_id' => $userId, 'question_id' => $questionId])->delete();
    }
    public function userLikedQuestion($userId, $questionId)
    {
        $like = $this->where(['user_id' => $userId, 'question_id' => $questionId])->first();

        return $like !== null;
    }
}
