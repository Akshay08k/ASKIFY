<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnswerModel;
use App\Models\UserModel;
use App\Models\CategoryModel;

class AnswerController extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('user/answerpage', $data);
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
    public function store()
    {
        $model = new AnswerModel();

        $validationRules = [
            'answer' => 'required'
        ];

        if ($this->validate($validationRules)) {
            $data = [
                'answer' => $this->request->getPost('answer')
            ];

            $model->insert($data);
        } else {
            return redirect()->to(current_url())->withInput();
        }

        return redirect()->to(current_url());
    }

}
