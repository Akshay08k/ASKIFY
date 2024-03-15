<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\NotificationModel;
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
        // Load follower IDs
        $followers = $followerModel->where('follower_id', $userId)->findAll();

        // Initialize an array to store follower names
        $followerNames = [];

        // Iterate through each follower ID and fetch their corresponding names
        foreach ($followers as $follower) {
            $followerId = $follower['user_id'];
            // Query the user model to retrieve the name based on the follower ID
            $followerData = $userModel->find($followerId);
            // Check if the follower data exists
            if ($followerData) {
                // Add the follower name to the array
                $followerNames[] = $followerData['name'];
            }
        }

        // Now $followerNames array contains the names of all followers
        $data['followerNames'] = $followerNames;
        // Load following IDs
        $following = $followerModel->where('user_id', $userId)->findAll();

        // Initialize an array to store following names
        $followingNames = [];

        // Iterate through each following ID and fetch their corresponding names
        foreach ($following as $follow) {
            $followingId = $follow['follower_id'];
            // Query the user model to retrieve the name based on the following ID
            $followingData = $userModel->find($followingId);
            // Check if the following data exists
            if ($followingData) {
                // Add the following name to the array
                $followingNames[] = $followingData['name'];
            }
        }

        // Now $followingNames array contains the names of all following
        $data['followingNames'] = $followingNames;



        $distinctQuestionIds = $answerModel->distinct()->select('question_id')->findAll();


        foreach ($distinctQuestionIds as $row) {
            $questionId = $row['question_id'];
            $likesSumResult = db_connect()->table('answer')->where('question_id', $questionId)->selectSum('likes')->get()->getRowArray();
            $totalAnswerLikes[$questionId] = $likesSumResult['likes'];
        }
        $data['totalQuestionCount'] = $QuestionModel->where('user_id', $userId)->countAllResults();
        $data['totalAnswerLikes'] = $totalAnswerLikes;

        $data['Question'] = $QuestionModel->where('user_id', $userId)->findAll();
        $data['Answer'] = $answerModel->where('user_id', $userId)->findAll();
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

        // Check if the logged-in user is following the visited user
        $loggedInUserId = session()->get('user_id');
        $loggedInUserId = session()->get('user_id');

        // Check if the logged-in user is following the specified user
        $isFollowing = $followerModel->where('user_id', $loggedInUserId)
            ->where('follower_id', $userId)
            ->countAllResults() > 0;

        // Check if the specified user is following the logged-in user
        $isFollowedByUser = $followerModel->where('user_id', $userId)
            ->where('follower_id', $loggedInUserId)
            ->countAllResults() > 0;

        // Check if there is a mutual follow relationship
        $isMutualFollowing = $isFollowing || $isFollowedByUser;



        $UserSelectedCategories = $UserCategoriesModel->where('user_id', $userId)->findAll();

        // Extracting category_id values from the result
        $categoryIds = array_column($UserSelectedCategories, 'category_id');
        $InterestedCategories = $categoryModel->whereIn('id', $categoryIds)->findAll();
        $data['usercategory'] = $InterestedCategories;

        $data['isFollowing'] = $isMutualFollowing;
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
        $data['totalQuestionCount'] = $QuestionModel->where('user_id', $userId)->countAllResults();
        $distinctQuestionIds = $answerModel->distinct()->select('question_id')->findAll();
        $data['Question'] = $QuestionModel->where('user_id', $userId)->findAll();
        $data['Answer'] = $answerModel->where('user_id', $userId)->findAll();
        foreach ($distinctQuestionIds as $row) {
            $questionId = $row['question_id'];
            $likesSumResult = db_connect()->table('answer')->where('question_id', $questionId)->selectSum('likes')->get()->getRowArray();
            $totalAnswerLikes[$questionId] = $likesSumResult['likes'];
        }

        $data['totalAnswerLikes'] = $totalAnswerLikes;
        $data['recentActivity'] = $activityLogModel->getRecentActivityForUser($userId, 5);
        $data['hiddenUserid'] = $userId;

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
                'birthdate' => 'required|valid_date[Y-m-d]',
                'location' => 'permit_empty|max_length[255]',
                'about' => 'permit_empty',
                'gender' => 'required|in_list[male,female,other]',
                'profile_photo' => 'uploaded[profile_photo]|max_size[profile_photo,10240]',
            ];

            if ($this->validate($validationRules)) {
                $data = [
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'name' => $this->request->getPost('name'),
                    'birthdate' => $this->request->getPost('birthdate'),
                    'location' => $this->request->getPost('location'),
                    'about' => $this->request->getPost('about'),
                    'gender' => $this->request->getPost('gender'),
                ];

                $profilePhoto = $this->request->getFile('profile_photo');

                if ($profilePhoto->isValid() && !$profilePhoto->hasMoved()) {
                    // Check if the username image exists in the upload folder
                    $imagePath = ROOTPATH . 'public/uploads/UserProfilePhotos/';
                    $newName = $data['username'] . '.' . $profilePhoto->getExtension();
                    if (file_exists($imagePath . $newName)) {
                        unlink($imagePath . $newName); // Remove existing image
                    }

                    // Move the new image to the upload folder
                    $profilePhoto->move($imagePath, $newName);

                    $data['profile_photo'] = $newName; // Store image name in database
                }

                $userModel->update($userId, $data);

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
    public function followAction()
    {
        // Retrieve data from AJAX request
        $userId = session()->get('user_id');
        $followerId = $this->request->getPost('followerId');

        // Fetch username of the user being followed
        $userModel = new UserModel();
        $followedUser = $userModel->find($userId);
        $followedUsername = $followedUser['username'];

        // Check if the record exists
        $followerModel = new FollowerModel();
        $existingRecord = $followerModel->where('follower_id', $userId)
            ->where('user_id', $followerId)
            ->first();

        if ($existingRecord) {
            // If record exists, delete it (unfollow)
            $followerModel->delete($existingRecord['id']);
            $status = 'unfollowed';
        } else {
            // If record does not exist, insert it (follow)
            $data = [
                'follower_id' => $userId,
                'user_id' => $followerId,
                // Add other relevant data fields here
            ];
            $followerModel->insert($data);
            $status = 'followed';

            // Insert notification data
            $notificationModel = new NotificationModel();
            $notificationData = [
                'recipient_id' => $followerId,
                'text' => $followedUsername . ' followed you.',
                // Add other relevant data fields here
            ];
            $notificationModel->insert($notificationData);
        }

        // Return response
        return $this->response->setJSON(['status' => $status]);
    }



}
