<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'ip_address', 'timestamp'];
    public function trackVisitor($ipAddress)
    {
        // Check the visitor already stored in database
        $existingVisitor = $this->where('ip_address', $ipAddress)->first();

        if ($existingVisitor) {
            //update last visit of the visitor when he/she visits again
            $this->update($existingVisitor['id'], ['timestamp' => date('Y-m-d H:i:s')]);
        } else {
            // insert ip address
            $this->insert(['ip_address' => $ipAddress]);
        }
    }

    public function getTotalVisitors()
    {
        return $this->countAll();
    }
}
