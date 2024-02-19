<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\NotificationModel;

class NotificationController extends BaseController
{
    // NotificationController.php

    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            session()->setFlashdata('error', 'Please Login To Continue');
            return redirect()->to('login');

        }
        $model = new NotificationModel();
        $categoryModel = new CategoryModel();


        // Fetch all notifications for the current user excluding those with 'seen' set to true
        $data['allNotifications'] = $model->where('recipient_id', $userId)
            ->where('seen', false) // Exclude seen notifications
            ->findAll();

        // If you only want to load notifications with is_platform_update set to TRUE
        $data['PlatFromUpdates'] = $model->where('is_platform_update', 1)
            ->orderBy('created_at', 'asc')
            ->findAll();
        $data['readNotifications'] = $model->where('recipient_id', $userId)
            ->where('seen', true)
            ->findAll();
        $data['categories'] = $categoryModel->findAll();

        // Load the view and pass the data
        return view('user/notification', $data);
    }

    // NotificationController.php

    // NotificationController.php

    // NotificationController.php

    public function markAsSeen($id)
    {
        $model = new NotificationModel();

        // Assuming you have authentication implemented
        $userId = session()->get("user_id");

        // Check if the notification exists and belongs to the current user
        $notification = $model->where('id', $id)
            ->where('recipient_id', $userId)
            ->first();

        if ($notification) {
            $model->update($id, ['seen' => true]);

            return redirect()->to(previous_url());
        } else {

            return redirect()->to(previous_url())->with('error', 'Invalid notification.');
        }
    }



}
