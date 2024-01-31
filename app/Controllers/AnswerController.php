<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnswerModel;
use App\Models\UserModel;

class AnswerController extends BaseController
{
    public function index()
    {
        return view('user/answerpage');
    }
    public function getAnswers()
    {
        $UserModel = new UserModel();
        $AnswerModel = new AnswerModel();

        $answers = $AnswerModel
            ->select('users.username, answer.id, answer.question_id, answer.user_id, answer.answer, answer.likes, answer.created_at')
            ->join('users', 'answer.user_id = users.id')
            ->findAll();

        // Convert BLOB data to base64 encoding for profile_photo
        foreach ($answers as &$answer) {
            // Retrieve the user's profile photo based on user_id
            $userProfile = $UserModel->find($answer['user_id']);
            if ($userProfile && $userProfile['profile_photo']) {
                $answer['profile_photo'] = base64_encode($userProfile['profile_photo']);
            } else {
                // Provide a default profile photo or handle the case where there is no photo
                $answer['profile_photo'] = ''; // Set a default value or handle as needed
            }
        }

        return $this->response->setJSON($answers);
    }

}
