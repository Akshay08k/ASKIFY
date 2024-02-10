<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\QuestionModel;
use App\Models\UserModel;
use App\Models\QuestionLikeModel;

use App\Controllers\BaseController;

class HomepageController extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        $QuestionModel = new QuestionModel();
        $data['questions'] = $QuestionModel->findAll();
        return view('user/homepage', $data);
    }

    public function getQuestions()
    {
        $UserModel = new UserModel();
        $QuestionModel = new QuestionModel();

        try {
            $questions = $QuestionModel
                ->select('users.name, question.id, question.title, question.description, question.category_id, question.user_id, question.likes, question.media')
                ->join('users', 'question.user_id = users.id')
                ->findAll();

            // Convert BLOB data to base64 encoding for media
            foreach ($questions as &$question) {
                // Retrieve the user's profile photo based on user_id
                $userProfile = $UserModel->find($question['user_id']);
                if ($userProfile) {
                    $question['profile_photo'] = base64_encode($userProfile['profile_photo']);
                    $question['media'] = base64_encode($question['media']);
                }

                // Convert media BLOB data to base64 encoding
            }

            return $this->response->setJSON($questions);
        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Error fetching questions: ' . $e->getMessage());

            // Provide a user-friendly response or handle the error gracefully
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to fetch questions.']);
        }
    }



    public function updateLikeCount($questionId, $liked)
    {
        $QuestionModel = new QuestionModel();
        $QuestionLikeModel = new QuestionLikeModel();

        // Validate and sanitize inputs if necessary
        $userId = session()->get('user_id');

        // Check if the user already liked the question
        $userLiked = $QuestionLikeModel->userLikedQuestion($userId, $questionId);

        // Update the like count for the question
        if ($liked === 'true' && !$userLiked) {
            $QuestionLikeModel->addLike($userId, $questionId);
            $updatedLikes = $QuestionModel->incrementLikes($questionId);
        } elseif ($liked === 'false' && $userLiked) {
            $QuestionLikeModel->removeLike($userId, $questionId);
            $updatedLikes = $QuestionModel->decrementLikes($questionId);
        } else {
            // No change in likes, return the current count
            $updatedLikes = $QuestionModel->getLikes($questionId);
        }

        // You can return the updated like count if needed
        return $this->response->setJSON(['likes' => $updatedLikes]);
    }

    public function checkLikeStatus($questionId, $userId)
    {
        $QuestionLikeModel = new QuestionLikeModel();
        $hasLiked = $QuestionLikeModel->userLikedQuestion($userId, $questionId);

        return $this->response->setJSON(['hasLiked' => $hasLiked]);
    }
    public function SubmitPost()
    {
        $userId = session()->get('user_id');
        $validationRules = [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postPhoto' => 'uploaded[postPhoto]|max_size[postPhoto,10240]',
            'CategoryId' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/submit_question')->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('postTitle');
        $description = $this->request->getPost('postDescription');
        $Photo = $this->request->getFile('postPhoto');
        $categoryId = $this->request->getPost('CategoryId');

        $questionModel = new QuestionModel();
        $data = [
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
            'category_id' => $categoryId,
        ];

        if ($Photo->isValid() && !$Photo->hasMoved()) {
            $newName = $title . '_' . $userId . '.' . $Photo->getExtension();
            $Photo->move(ROOTPATH . 'public/uploads/questionimages', $newName);
            $data['media'] = file_get_contents(ROOTPATH . 'public/uploads/questionimages/' . $newName);

            // Remove the image file after reading its contents
        }

        $questionModel->insert($data);

        return redirect()->to('/homepage')->with('success', 'Question submitted successfully');
    }


    public function SubmitQuestion()
    {
        $validationRules = [
            'QuestionTitle' => 'required',
            'QuestionDescription' => 'required',
            'CategoryId' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->to('/profile')->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('QuestionTitle');
        $categoryId = $this->request->getPost('CategoryId');
        $description = $this->request->getPost('QuestionDescription');

        $userId = session()->get('user_id');

        $questionModel = new QuestionModel();
        $data = [
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
            'category_id' => $categoryId,
        ];
        $questionModel->insert($data);

        return redirect()->to('/homepage')->with('success', 'Question submitted successfully');
    }
    public function CategoryByView()
    {
        $model = new CategoryModel();
        $data['categories'] = $model->findAll();
        return view('user/viewbycategories', $data);
    }
    public function checkUserLikeStatus($questionId)
    {
        $model = new QuestionLikeModel();
        $userId = session()->get('user_id');

        $userLiked = $model->userLikedQuestion($userId, $questionId);

        return $this->response->setJSON(['userLiked' => $userLiked]);
    }
}
