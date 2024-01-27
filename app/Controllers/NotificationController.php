<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\NotificationModel;

class NotificationController extends BaseController
{
    public function index()
    {
        $model = new NotificationModel();

        // Fetch all data from the notifications table
        $data['notifications'] = $model->findAll();
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();

        // Load the view and pass the data
        return view('user/notification', $data);
    }
}