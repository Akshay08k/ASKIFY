<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use App\Models\NotificationModel;
use App\Models\ReportModel;
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
        $reportModel = new ReportModel();

        // Fetch reported issues from the database
        $reportedIssues = $reportModel->findAll();

        // Pass the data to the view
        $data['reportedIssues'] = $reportedIssues;

        $data['users'] = $userModel->where('id', $userId)->findAll();
        return view("admin/handle_issues", $data);
    }
    public function resolveIssue($issueId)
    {

        $reportModel = new ReportModel();
        $notificationModel = new NotificationModel();

        // Get the reported issue
        $reportedIssue = $reportModel->find($issueId);

        if ($reportedIssue) {
            $reportModel->update($issueId, ['status' => 'Resolved']);

            // Send notification to the user
            $notificationData = [
                'recipient_id' => $reportedIssue['from_user'],
                'text' => 'Issue Resolved: Your reported concern "' . $reportedIssue['message'] . '" has been solved. Thank you for your valuable feedback.',
            ];

            $notificationModel->insert($notificationData);
        }

        return redirect()->to('/admin/handle_issues');
    }

    public function feedbacks()
    {
        $feedbackModel = new FeedbackModel();
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/admin');
        }

        $userModel = new UserModel();
        $feedbackData = $feedbackModel->findAll();

        // Fetch user names for each feedback
        $data['feedbacks'] = [];
        foreach ($feedbackData as $feedback) {
            $user = $userModel->find($feedback['user_id']);

            // Assuming 'name' is the field you want from the user table
            $feedback['user_name'] = $user['name'];

            $data['feedbacks'][] = $feedback;
        }

        // You may want to fetch user data separately as well
        $data['users'] = $userModel->where('id', $userId)->findAll();

        return view("admin/feedbacks", $data);
    }
}
