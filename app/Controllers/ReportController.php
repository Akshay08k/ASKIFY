<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
}
