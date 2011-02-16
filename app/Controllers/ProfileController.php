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
    public function logout()
    {
        session()->destroy();
        return view('user/login');
    }
    public function updateprofile()
    {
        return view('user/updateprofile');
    }

}
