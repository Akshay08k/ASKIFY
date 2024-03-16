<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use App\Models\ReportModel;

class ReportController extends BaseController
{
    public function reportQuestion($questionId)
    {
        $reportModel = new ReportModel();
        $userId = session()->get("user_id");

        // Get data from the request
        $requestData = json_decode($this->request->getBody(), true);
        $reason = $requestData['reason'];

        // Validate and insert into the reports table
        if ($questionId && $reason) {
            $data = [
                'from_user' => $userId,
                'question_id' => $questionId,
                'message' => $reason,
            ];

            $reportModel->insert($data);

            return $this->response->setStatusCode(201)->setJSON(['message' => 'Report submitted successfully']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Invalid data']);
        }
    }
    public function Feedback()
    {
        return view('user/Feedback');
    }
    public function FeedbackSubmit()
    {
        // Create a new instance of the FeedbackModel
        $FeedbackModel = new FeedbackModel();

        // Retrieve the JSON request body and decode it
        $requestData = json_decode($this->request->getBody(), true);
        // Extract the feedback from the decoded JSON data
        $feedback = $requestData['Feedback'];

        // Prepare the data to be inserted into the database
        $data = [
            'text' => $feedback,
            'user_id' => session()->get('user_id') // Assuming 'user_id' is stored in the session
        ];

        // Insert the feedback data into the database
        $FeedbackModel->insert($data);

        // Return a JSON response indicating success
        return $this->response->setJSON(['success' => true]);
    }


}

