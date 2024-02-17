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

        // Loading All Important Variabless

        $data['users'] = $userModel->where('id', $userId)->findAll();
        $data['categories'] = $CategoryModel->findAll();
        $data['totalUsers'] = $userModel->countAll();
        $data['totalCategories'] = $CategoryModel->countAll();
        $data['totalReports'] = $ReportModel->countAll();
        $data['totalFeedbacks'] = $FeedbackModel->countAll();
        $data['totalQuestions'] = $QuestionModel->countAll();
        $data['totalAnswer'] = $AnswerModel->countAll();
        //Finding Platform Updates From Notification
        $recentFeedbacks = $FeedbackModel->orderBy('created_at', 'DESC')->findAll(3);
        $platformUpdateNotifications = $NotificationModel->where('is_platform_update', 1)->findAll();
        $data['platformUpdateNotifications'] = $platformUpdateNotifications;
        $data['recentFeedbacks'] = $recentFeedbacks;

        //Returning View With Data
        return view("admin/dashboard", $data);
    }
    public function platform_updates()
    {
        $NotificationModel = new NotificationModel();
        $data['notifications'] = $NotificationModel->where('is_platform_update', true)->findAll();
        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('/admin');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->where('id', $userId)->findAll(); {
            return view("admin/handle_updates", $data);
        }
    }
    public function SendFeedback()
    {
        $NotificationModel = new NotificationModel();
        $text = $this->request->getPost("updateDescription");
        $data = [
            'text' => $text,
            'is_platform_update' => true,
        ];
        $NotificationModel->insert($data);
        return redirect("admin/handle_updates");
    }
}