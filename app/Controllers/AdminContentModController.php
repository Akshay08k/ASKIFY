<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminContentModController extends BaseController
{
    public function index()
    {
        return view("admin/moderate_content");
    }
}
