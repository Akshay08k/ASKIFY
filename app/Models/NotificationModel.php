<?php
namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications'; 

    protected $primaryKey = 'id';

    protected $allowedFields = ['Recepient','question_id','answer_id','set_at','Seen','text'];
}