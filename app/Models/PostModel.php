<?php
namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts'; // Your posts table name
    protected $allowedFields = ['user_id', 'post_caption', 'post_image']; // Fields you can insert/update

}
