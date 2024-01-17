<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\UserModel;
use App\Models\FollowerModel;
use App\Models\LikeAnswerModel;
use App\Models\QuestionModel;
use App\Models\ActivityLogModel;
use App\Models\AnswerModel;

class ProfileController extends BaseController
{

    public function index()
    {

        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('login');
        }

        $userModel = new UserModel();
        $data['userId'] = $userId;
        $data['users'] = $userModel->where('id', $userId)->findAll();


        $followerModel = new FollowerModel();
        $data['followers'] = $followerModel->where('user_id', $userId)->findAll();
        $data['totalFollowers'] = $followerModel->where('user_id', $userId)->countAllResults();
        $data['followers'] = $followerModel->where('follower_id', $userId)->findAll();
        $data['totalFollowing'] = $followerModel->where('follower_id', $userId)->countAllResults();

        $questionModel = new QuestionModel();
        $data['questions'] = $questionModel->where('user_id', $userId)->findAll();
        $totalLikesResult = $questionModel->selectSum('likes')->where('user_id', $userId)->get()->getRowArray();
        $data['totalLikes'] = $totalLikesResult['likes'];

        $answerModel = new AnswerModel();
        $totalAnswerLikes = [];

        $distinctQuestionIds = $answerModel->distinct()->select('question_id')->findAll();

        foreach ($distinctQuestionIds as $row) {
            $questionId = $row['question_id'];
            $likesSumResult = db_connect()->table('answer')->where('question_id', $questionId)->selectSum('likes')->get()->getRowArray();
            $totalAnswerLikes[$questionId] = $likesSumResult['likes'];
        }

        $data['totalAnswerLikes'] = $totalAnswerLikes;


        $activityLogModel = new ActivityLogModel();
        $data['recentActivity'] = $activityLogModel->getRecentActivityForUser($userId, 5);

        return view('user/profile', $data);

    }

    public function choosecategory()
    {

        $model = new CategoryModel();
        $data['categories'] = $model->getCategories();

        echo view('user/choosecategory', $data);
    }

    public function editProfile()
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
                'profile_photo' => 'uploaded[profile_photo]|max_size[profile_photo,10240]',
            ];

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
                    $data['profile_photo'] = $newName;
                }
                $userModel->update($userId, $data);
                return redirect()->to("/profile")->with('success', 'Profile updated successfully.');
            } else {
                return view('user/updateprofile', ['validation' => $this->validator, 'userData' => $userData]);
            }
        }

        return view('user/updateprofile', ['userData' => $userData]);
    }

}
