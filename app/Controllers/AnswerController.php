<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnswerModel;
use App\Models\AnswerLikeModel;
use App\Models\UserModel;
use App\Models\CategoryModel;

class AnswerController extends BaseController
{
    public function __construct()
    {
        $this->AnswerLikeModel = new AnswerLikeModel(); // Instantiate the model
    }
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
                $answer['profile_photo'] = $userProfile['profile_photo'];
            } else {
                // Provide a default profile photo or handle the case where there is no photo
                $answer['profile_photo'] = ''; // Set a default value or handle as needed
            }
        }

        return $this->response->setJSON($answers);
    }
    public function updateAnswerLikeCount($answerId, $liked)
    {
        $AnswerModel = new AnswerModel();
        $AnswerLikeModel = new AnswerLikeModel();

        // Validate and sanitize inputs if necessary
        $userId = session()->get('user_id');

        // Check if the user already liked the answer
        $userLiked = $AnswerLikeModel->userLikedAnswer($userId, $answerId);

        // Update the like count for the answer
        if ($liked === 'true' && !$userLiked) {
            $AnswerLikeModel->addLike($userId, $answerId);
            $updatedLikes = $AnswerModel->incrementLikes($answerId);
        } elseif ($liked === 'false' && $userLiked) {
            $AnswerLikeModel->removeLike($userId, $answerId);
            $updatedLikes = $AnswerModel->decrementLikes($answerId);
        } else {
            // No change in likes, return the current count
            $updatedLikes = $AnswerModel->getLikes($answerId);
        }

        // You can return the updated like count if needed
        return $this->response->setJSON(['likes' => $updatedLikes]);
    }

    // In your AnswersController.php or another relevant controller
    public function checkUserLikeStatus($answerId)
    {
        $AnswerLikeModel = new AnswerLikeModel();
        $userId = session()->get('user_id'); // Assuming you are using session for user authentication

        // Your logic to check if the user has liked the answer with $answerId
        $userLiked = $AnswerLikeModel->userLikedAnswer($userId, $answerId);

        return $this->response->setJSON(['userLiked' => $userLiked]);
    }
    public function submitAnswer()
    {
        $userId = session()->get('user_id');
        $questionId = $this->request->getPost('question_id');
        // Get the answer data from the form submission
        $answerData = [
            'answer' => $this->request->getPost('answer'),
            'question_id' => $questionId, // Retrieve answer ID from the hidden input
            'user_id' => $userId,
        ];

        // Validate the answer data if necessary

        // Call the AnswerModel to insert the answer into the database
        $answerModel = new AnswerModel();
        $answerModel->insert($answerData);

        // Redirect or return a response as needed
        return redirect()->to('/answers?id=' . $questionId);
    }
}