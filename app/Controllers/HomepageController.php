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

        $questions = $QuestionModel
            ->select('users.name, question.id, question.title, question.description, question.user_id, question.likes, question.views, question.followers, question.created_at')
            ->join('users', 'question.user_id = users.id')
            ->findAll();

        // Convert BLOB data to base64 encoding for profile_photo
        foreach ($questions as &$question) {
            // Retrieve the user's profile photo based on user_id
            $userProfile = $UserModel->find($question['user_id']);
            if ($userProfile) {
                $question['profile_photo'] = base64_encode($userProfile['profile_photo']);
            }
        }

        return $this->response->setJSON($questions);
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
    public function SubmitPost()
    {
        $validationRules = [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postPhoto' => 'uploaded[postPhoto]|max_size[postPhoto,1024]|is_image[postPhoto]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/submit_question')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Form submission logic here
        $title = $this->request->getPost('postTitle');
        $description = $this->request->getPost('postDescription');
        $photo = $this->request->getFile('postPhoto');
        $blobImage = file_get_contents($photo->getRealPath());
        $userId = session()->get('user_id');

        // Insert data into the database using the model
        $questionModel = new QuestionModel();
        $data = [
            'title' => $title,
            'description' => $description,
            'media' => $blobImage,
            'user_id' => $userId
        ];
        $questionModel->insert($data);

        // Redirect or display success message
        return redirect()->to('/homepage')->with('success', 'Question submitted successfully');
    }
    public function SubmitQuestion()
    {
        $validationRules = [
            'QuestionTitle' => 'required',
            'QuestionDescription' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->to('/submit_question')->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('QuestionTitle');
        $description = $this->request->getPost('QuestionDescription');

        $userId = session()->get('user_id');

        $questionModel = new QuestionModel();
        $data = [
            'title' => $title,
            'description' => $description,
            'user_id' => $userId
        ];
        $questionModel->insert($data);

        return redirect()->to('/homepage')->with('success', 'Question submitted successfully');
    }
}
