<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\UserCategoriesModel;
use App\Models\UserModel;
use App\Models\FollowerModel;
use App\Models\QuestionModel;
use App\Models\ActivityLogModel;
use App\Models\AnswerModel;

class ProfileController extends BaseController
{

    public function index()
    {

        $userId = session()->get('user_id');

        if (!$userId) {
            session()->setFlashdata('error', 'Please Login To Continue');
            return redirect()->to('login');

        }
        $activityLogModel = new ActivityLogModel();
        $categoryModel = new CategoryModel();
        $QuestionModel = new QuestionModel();
        $followerModel = new FollowerModel();
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();
        $userModel = new UserModel();

        $UserCategoriesModel = new UserCategoriesModel();
        $UserSelectedCategories = $UserCategoriesModel->where('user_id', $userId)->findAll();

        // Extracting category_id values from the result
        $categoryIds = array_column($UserSelectedCategories, 'category_id');
        $InterestedCategories = $categoryModel->whereIn('id', $categoryIds)->findAll();
        $data['usercategory'] = $InterestedCategories;

        $data['categories'] = $categoryModel->findAll();
        $data['question'] = $QuestionModel->findAll();
        $data['userId'] = $userId;
        $data['users'] = $userModel->where('id', $userId)->findAll();
        $data['followers'] = $followerModel->where('user_id', $userId)->findAll();
        $data['totalFollowers'] = $followerModel->where('user_id', $userId)->countAllResults();
        $data['followers'] = $followerModel->where('follower_id', $userId)->findAll();
        $data['totalFollowing'] = $followerModel->where('follower_id', $userId)->countAllResults();
        $data['questions'] = $questionModel->where('user_id', $userId)->findAll();
        $totalLikesResult = $questionModel->selectSum('likes')->where('user_id', $userId)->get()->getRowArray();
        $data['totalLikes'] = $totalLikesResult['likes'];
        $totalAnswerLikes = [];

        $distinctQuestionIds = $answerModel->distinct()->select('question_id')->findAll();


        foreach ($distinctQuestionIds as $row) {
            $questionId = $row['question_id'];
            $likesSumResult = db_connect()->table('answer')->where('question_id', $questionId)->selectSum('likes')->get()->getRowArray();
            $totalAnswerLikes[$questionId] = $likesSumResult['likes'];
        }

        $data['totalAnswerLikes'] = $totalAnswerLikes;
        $data['recentActivity'] = $activityLogModel->getRecentActivityForUser($userId, 5);
        $data['error'] = session()->getFlashdata('error');
        return view('user/selfprofile', $data);

    }

    public function VisitProfile($username)
    {
        $activityLogModel = new ActivityLogModel();
        $categoryModel = new CategoryModel();
        $QuestionModel = new QuestionModel();
        $followerModel = new FollowerModel();
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();
        $userModel = new UserModel();
        $UserCategoriesModel = new UserCategoriesModel();

        // Get the user by username
        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            session()->setFlashdata('error', 'The User Not Found');
            return redirect()->to('/profile');
        }

        $userId = $user['id'];

        $UserSelectedCategories = $UserCategoriesModel->where('user_id', $userId)->findAll();

        // Extracting category_id values from the result
        $categoryIds = array_column($UserSelectedCategories, 'category_id');
        $InterestedCategories = $categoryModel->whereIn('id', $categoryIds)->findAll();
        $data['usercategory'] = $InterestedCategories;

        $data['categories'] = $categoryModel->findAll();
        $data['question'] = $QuestionModel->findAll();
        $data['userId'] = $userId;
        $data['users'] = $userModel->where('id', $userId)->findAll();
        $data['followers'] = $followerModel->where('user_id', $userId)->findAll();
        $data['totalFollowers'] = $followerModel->where('user_id', $userId)->countAllResults();
        $data['followers'] = $followerModel->where('follower_id', $userId)->findAll();
        $data['totalFollowing'] = $followerModel->where('follower_id', $userId)->countAllResults();
        $data['questions'] = $questionModel->where('user_id', $userId)->findAll();
        $totalLikesResult = $questionModel->selectSum('likes')->where('user_id', $userId)->get()->getRowArray();
        $data['totalLikes'] = $totalLikesResult['likes'];
        $totalAnswerLikes = [];

        $distinctQuestionIds = $answerModel->distinct()->select('question_id')->findAll();

        foreach ($distinctQuestionIds as $row) {
            $questionId = $row['question_id'];
            $likesSumResult = db_connect()->table('answer')->where('question_id', $questionId)->selectSum('likes')->get()->getRowArray();
            $totalAnswerLikes[$questionId] = $likesSumResult['likes'];
        }

        $data['totalAnswerLikes'] = $totalAnswerLikes;
        $data['recentActivity'] = $activityLogModel->getRecentActivityForUser($userId, 5);

        return view('user/profile', $data);
    }
    public function choosecategory()
    {
        $CategoryModel = new CategoryModel();

        $data['categories'] = $CategoryModel->getCategories();
        echo view('user/choosecategory', $data);
    }

    public function processCategorySelection()
    {
        $usercategoryModel = new UserCategoriesModel();

        $selectedCategories = $this->request->getPost('selected_categories');
        print_r($selectedCategories);
        $userId = session()->get('user_id');
        $usercategoryModel->storeUserCategories($userId, $selectedCategories);
        return redirect()->to('/profile');
    }

    public function editProfile()
    {
        $categoryModel = new CategoryModel();
        $userData['categories'] = $categoryModel->findAll();
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You are not logged in.');
        }
        $userModel = new UserModel();
        $userData = $userModel->find($userId);
        if (empty($userData)) {
            return redirect()->to('/user/404page')->with('error', 'User not found.');
        }
        return view('user/updateprofile', ['userData' => $userData]);
    }

    public function updateProfile()
    {

        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You are not logged in.');
        }

        $userModel = new UserModel();
        $userData = $userModel->find($userId);

        if (empty($userData)) {
            return redirect()->to('/user/404page')->with('error', 'User not found.');
        }

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'username' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email',
                'name' => 'required|min_length[3]|max_length[50]',
                'categories' => 'permit_empty|max_length[255]',
                'birthdate' => 'required|valid_date[Y-m-d]',
                'location' => 'permit_empty|max_length[255]',
                'about' => 'permit_empty',
                'gender' => 'required|in_list[male,female,other]',
                'profile_photo' => 'max_size[profile_photo,10240]',
            ];
            //$this->request->do_upload()  is method to upload the file
            if ($this->validate($validationRules)) {
                $data = [
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'name' => $this->request->getPost('name'),
                    'categories' => $this->request->getPost('categories'),
                    'birthdate' => $this->request->getPost('birthdate'),
                    'location' => $this->request->getPost('location'),
                    'about' => $this->request->getPost('about'),
                    'gender' => $this->request->getPost('gender'),
                ];

                $profilePhoto = $this->request->getFile('profile_photo');

                if ($profilePhoto->isValid() && !$profilePhoto->hasMoved()) {
                    $newName = $userData['username'] . '.' . $profilePhoto->getExtension();
                    $profilePhoto->move(ROOTPATH . 'public/images/userprofilephoto', $newName);

                    // Update the 'profile_photo' column to store the image content as blob
                    $data['profile_photo'] = file_get_contents(ROOTPATH . 'public/images/userprofilephoto/' . $newName);
                }

                $userModel->update($userId, $data);

                // Remove the uploaded image file after updating the database
                // this is used to remove file from userprofilephoto 
                // unlink(ROOTPATH . 'public/images/userprofilephoto/' . $newName);

                return redirect()->to("/profile")->with('success', 'Profile updated successfully.');
            } else {
                return view('user/updateprofile', ['validation' => $this->validator, 'userData' => $userData]);
            }
        }

        return view('user/updateprofile', ['userData' => $userData]);
    }
    public function liveSearch()
    {
        $userModel = new UserModel();
        $searchTerm = $this->request->getPost('searchTerm');
        $results = $userModel->searchUsers($searchTerm);
        return json_encode($results);
    }
    public function QueAns()
    {
        return view("user/QueAns");
    }
    public function deleteQuestion()
    {
        $questionId = $this->request->getPost('question_id'); // Assuming you are sending the question_id via POST

        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();// Create an instance of your QuestionModel
        $result = $questionModel->delete($questionId); // Assuming your model has a delete method
        $answerModel->where('question_id', $questionId)->delete();
        if ($result) {
            // Question deleted successfully
            return redirect()->to('/QueAns')->with('success', 'Question deleted successfully');
        } else {
            // Failed to delete question
            return redirect()->to('/homepage')->with('error', 'Failed to delete question');
        }
    }
    public function deleteAnswer()
    {
        $AnswerId = $this->request->getPost('AnswerId');
        $answerModel = new AnswerModel();
        $result = $answerModel->where('id', $AnswerId)->delete();
        if ($result) {
            // Question deleted successfully
            return redirect()->to('/QueAns')->with('success', 'Answer deleted successfully');
        } else {
            // Failed to delete question
            return redirect()->to('/homepage')->with('error', 'Failed to Answer question');
        }
    }
}
