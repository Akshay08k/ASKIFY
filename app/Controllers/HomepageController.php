<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\QuestionModel;

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
    {

        $questionModel = new QuestionModel();
        $questions = $questionModel->findAll();

        // Return the questions as JSON
        return $this->response->setJSON($questions);
    }
}
