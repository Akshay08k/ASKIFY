<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'from_user',
        'question_id',
        'answer_id',
        'message',
        'created_at',
        'status',
    ];
}