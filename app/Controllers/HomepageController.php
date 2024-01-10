<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\QuestionModel;
use App\Models\UserModel;

use App\Controllers\BaseController;

class HomepageController extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
         $data['categories'] = $categoryModel->findAll();
        $QuestionModel = new QuestionModel();
         $data['question'] = $QuestionModel->findAll();
        return view('user/homepage',$data);
    }
    public function getQuestions()
    { $UserModel = new UserModel();
        $QuestionModel = new QuestionModel();
       
        $questions = $QuestionModel
            ->select('users.username, question.id, question.title, question.description, question.media, question.user_id, question.likes, question.views, question.followers, question.created_at')
            ->join('users', 'question.user_id = users.id')
            ->findAll();
        return $this->response->setJSON($questions);
    }
}
