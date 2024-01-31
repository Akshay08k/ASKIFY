<?php

// AnswerLikeModel.php

namespace App\Models;

use CodeIgniter\Model;

class AnswerLikeModel extends Model
{
    protected $table = 'answer_likes';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'answer_id',
        'created_at'
    ];



    public function addLike($userId, $answerId)
    {
        $data = [
            'user_id' => $userId,
            'answer_id' => $answerId,
        ];

        $this->insert($data);
    }

    public function removeLike($userId, $answerId)
    {
        $this->where(['user_id' => $userId, 'answer_id' => $answerId])->delete();
    }
    /**
     * Check if a user has liked a specific answer.
     *
     * @param int $userId    The ID of the user
     * @param int $answerId  The ID of the answer
     * @return bool          True if the user has liked the answer, false otherwise
     */
    public function userLikedAnswer($userId, $answerId)
    {
        $like = $this->where(['user_id' => $userId, 'answer_id' => $answerId])->first();

        return $like !== null;
    }

}