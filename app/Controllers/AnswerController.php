<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnswerModel;

class AnswerController extends BaseController
{
    public function index()
    {
        return view('user/answerpage');
    }
}
