<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HiddenQueModel;
use App\Models\NotificationModel;
use App\Models\QuestionModel;
use App\Models\UserModel;

class AdminContentModController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('/admin');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->where('id', $userId)->findAll(); {
            return view("admin/moderate_content", $data);
        }
    }
    // Example Controller method
    // Example Controller method
    public function updateQuestionStatus()
    {
        try {
            $QuestionModel = new QuestionModel();
            $HiddenQueModel = new HiddenQueModel();
            $NotificationModel = new NotificationModel();

            $request = $this->request->getJSON();
            $qaId = $request->qaId;
            $reason = $request->reason;
            $userId = $request->userId;
            $Title = $request->title;

            // Check if the same data already exists in the database
            if (!$QuestionModel->isQuestionStatusUpdated($qaId)) {
                // Update the question status using the QuestionModel
                $NotificationModel->SendModerationUpdate($userId, $Title, $reason, $qaId);
                $QuestionModel->updateQuestionStatus($qaId);

                // Insert information into the hidden_question table using the HiddenQueModel
                $HiddenQueModel->insertHiddenQuestion($qaId, $reason, $userId);

                return $this->response->setJSON(['status' => 'success']);
            } else {
                // If the data already exists, you can choose to do nothing or return a specific response

                log_message('error', 'Data Aleady Exists ');
                return $this->response->setJSON(['status' => 'info', 'message' => 'Data already exists']);
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            log_message('error', 'Error updating question status: ' . $e->getMessage());
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
