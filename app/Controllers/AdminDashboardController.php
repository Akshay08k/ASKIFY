<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminDashboardController extends BaseController
{
    public function index()
    {
        return view("admin/dashboard");
    }
    public function platform_updates()
    {
        return view("admin/handle_updates");
    }
}
