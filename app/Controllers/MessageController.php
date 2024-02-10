<?php

namespace App\Controllers;

use App\Models\MessageModel;
use CodeIgniter\Controller;
use App\Models\CategoryModel;

class MessageController extends BaseController
{
    public function index()
    {
        return view('user/messages');
    }
}