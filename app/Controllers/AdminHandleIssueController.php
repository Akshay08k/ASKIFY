<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AdminHandleIssueController extends BaseController
{
    public function issues()
    {
        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('/admin');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->where('id', $userId)->findAll();
        return view("admin/handle_issues", $data);
    }
    public function feedbacks()
    {
        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('/admin');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->where('id', $userId)->findAll();
        return view("admin/feedbacks", $data);
    }
}
