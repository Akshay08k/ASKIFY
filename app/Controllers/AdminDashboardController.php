<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnswerModel;
use App\Models\CategoryModel;
use App\Models\FeedbackModel;
use App\Models\NotificationModel;
use App\Models\QuestionModel;
use App\Models\UserModel;
use App\Models\ReportModel;

class AdminDashboardController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/admin');
        }

        $userModel = new UserModel();
        $CategoryModel = new CategoryModel();
        $ReportModel = new ReportModel();
        $FeedbackModel = new FeedbackModel();
        $QuestionModel = new QuestionModel();
        $AnswerModel = new AnswerModel();
        $NotificationModel = new NotificationModel();

        // Fetch the user data
        $data['users'] = $userModel->where('id', $userId)->findAll();

        $data['categories'] = $CategoryModel->findAll();
        // Fetch the total number of users
        $data['totalUsers'] = $userModel->countAll();
        $data['totalCategories'] = $CategoryModel->countAll();
        $data['totalReports'] = $ReportModel->countAll();
        $data['totalFeedbacks'] = $FeedbackModel->countAll();
        $data['totalQuestions'] = $QuestionModel->countAll();
        $data['totalAnswer'] = $AnswerModel->countAll();
        $recentFeedbacks = $FeedbackModel->orderBy('created_at', 'DESC')->findAll(3);

        $platformUpdateNotifications = $NotificationModel->where('is_platform_update', 1)->findAll();

        // Pass the notifications to the view
        $data['platformUpdateNotifications'] = $platformUpdateNotifications;
        // Pass the feedbacks to the view
        $data['recentFeedbacks'] = $recentFeedbacks;

        // Calculate the average UserRating
        $averageUserRating = $FeedbackModel->selectAvg('Userrating')->get()->getRowArray();
        $data['averageUserRating'] = round($averageUserRating['Userrating'], 1);




        return view("admin/dashboard", $data);
    }

    public function platform_updates()
    {
        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('/admin');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->where('id', $userId)->findAll(); {
            return view("admin/handle_updates", $data);
        }
    }
}