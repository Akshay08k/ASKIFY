<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminHandleIssueController extends BaseController
{
    public function issues()
    {
        return view("admin/handle_issues");
    }
    public function feedbacks()
    {
        return view("admin/feedbacks");
    }
}
