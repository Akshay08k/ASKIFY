<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['sender_id', 'receiver_id', 'message', 'media', 'seen', 'created_at', 'received_at', 'updated_at'];
}