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
    public function updateprofile()
{
    // Check if the user is logged in
    if (!session()->has('user_id')) {
        // Redirect or handle the case where the user is not logged in
        return redirect()->to('/login'); // Replace '/login' with the actual login page URL
    }

    $model = new UpdateDetailsModel();

    // Get user ID from the session
    $userId = session()->get('user_id');

    // Get form data
    $data = [
        'name' => $this->request->getPost('name'),
        'gender' => $this->request->getPost('gender'),
        'bio' => $this->request->getPost('bio'),
        'role' => $this->request->getPost('role'),
        'categories' => $this->request->getPost('categories'),
    ];

    // You may want to add validation and sanitation here

    // Insert or update data in the database
    $model->update($userId, $data); // Use the retrieved user ID

    return redirect()->to('/update-details'); // Redirect to the update details page
}

}
