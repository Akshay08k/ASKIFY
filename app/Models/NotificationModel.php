<?php
namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $allowedFields = ['recipient_id', 'question_id', 'answer_id', 'text', 'is_platform_update', 'seen'];

    public function SendModerationUpdate($userId, $Title, $reason, $qaId)
    {
        $data = [
            'recipient_id' => $userId,
            'question_id' => $qaId,
            'text' => "Moderation Update : Your question with title '{$Title}' is deleted by Moderator. Reason: {$reason}",
        ];
        return $this->insert($data);
    }
}