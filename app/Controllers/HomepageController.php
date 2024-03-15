<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\QuestionModel;
use App\Models\UserCategoriesModel;
use App\Models\UserModel;
use App\Models\QuestionLikeModel;

use App\Controllers\BaseController;

class HomepageController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            session()->setFlashdata('error', 'Please Login To Continue');
            return redirect()->to('login');

        }

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
                ->select('users.name, question.id, question.title,question.Hidden, question.description, question.category_id, question.user_id, question.likes, question.media')
                ->join('users', 'question.user_id = users.id')
                ->findAll();

            // Convert BLOB data to base64 encoding for media
            foreach ($questions as &$question) {
                // Retrieve the user's profile photo based on user_id
                $userProfile = $UserModel->find($question['user_id']);
                if ($userProfile) {
                    $question['profile_photo'] = $userProfile['profile_photo'];
                    $question['media'];
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
    public function getInterestedQuestions()
    {
        $userId = session()->get('user_id');
        $UserCategoryModel = new UserCategoriesModel();
        $QuestionModel = new QuestionModel();

        // Get user's preferred categories
        $userCategories = $UserCategoryModel->where('user_id', $userId)->findColumn('category_id');

        if (!$userCategories) {
            return $this->response->setJSON([]);
        }

        $interestedCategories = [
            'category_id' => $userCategories
        ];

        // Fetch all questions with max likes across all categories
        $questionsWithMaxLikes = $QuestionModel->select('id')
            ->orderBy('likes', 'DESC')
            ->findAll();

        $interestedQuestions = [
            'question_ids' => array_column($questionsWithMaxLikes, 'id')
        ];

        return $this->response->setJSON([
            'interested_categories' => $interestedCategories,
            'interested_questions' => $interestedQuestions
        ]);
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
            'postPhoto' => 'uploaded[postPhoto]|max_size[postPhoto,10240]',
            'CategoryId' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/submit_question')->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('postTitle');
        $photo = $this->request->getFile('postPhoto');
        $categoryId = $this->request->getPost('CategoryId');

        $questionModel = new QuestionModel();
        $data = [
            'title' => $title,
            'user_id' => $userId,
            'category_id' => $categoryId,
        ];

        if ($photo->isValid() && !$photo->hasMoved()) {
            // Generate a random name for the file (5 characters)
            $randomString = bin2hex(random_bytes(3));

            // Get the ID of the last inserted record
            $lastInsertId = $questionModel->insert($data);

            // Combine the random string with the user id and question id
            $newName = $lastInsertId . '_' . $userId . '_' . $randomString . '.' . $photo->getExtension();

            // Move the file to the destination directory
            $photo->move(ROOTPATH . '/public/uploads/questionimages', $newName);

            // Store the path in the database
            $data['media'] = $newName;

            // Update the record with the file path
            $questionModel->update($lastInsertId, $data);
        }

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

    public function liveSearch()
    {
        $questionModel = new QuestionModel();
        $searchTerm = $this->request->getPost('searchTerm');

        $query = $questionModel->select('id, title, description')
            ->groupStart()
            ->like('title', $searchTerm)
            ->orLike('description', $searchTerm)
            ->groupEnd()
            ->findAll();

        return json_encode($query);
    }

}
