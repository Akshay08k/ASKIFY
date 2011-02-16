<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['user_id', 'activity_type', 'target_id', 'timestamp'];

    public function getRecentActivityForUser($userId, $limit = 5)
    {
        $result = $this->where('user_id', $userId)
            ->orderBy('timestamp', 'DESC')
            ->limit($limit)
            ->findAll();

        // Log or print the result for debugging
        service('logger')->info(print_r($result, true));

        return $result;
    }
}
