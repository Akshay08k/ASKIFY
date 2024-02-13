<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminManageUserController extends BaseController
{
    public function index()
    {
        return view("admin/manage_users");
    }
}
