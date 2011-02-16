<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowerModel extends Model
{
    protected $table            = 'follower';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id','follower_id','followed_at','unfollowed_at'];
    
}
