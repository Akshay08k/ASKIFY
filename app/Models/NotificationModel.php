<?php
namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $allowedFields = ['recipient_id', 'question_id', 'answer_id', 'text', 'is_platform_update', 'seen'];
}