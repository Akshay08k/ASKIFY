<?php

namespace App\Models;

use CodeIgniter\Model;

class HiddenQueModel extends Model
{

    protected $table = 'hidden_question';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'question_id', 'reason'];

    // Dates

    public function insertHiddenQuestion($qaId, $reason, $userId)
    {
        return $this->insert([
            'question_id' => $qaId,
            'reason' => $reason,
            'user_id' => $userId,
        ]);
    }
}
