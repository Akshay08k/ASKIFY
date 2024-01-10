<?php


namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\PostModel;
use CodeIgniter\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('user/homepage'); // Display the homepage view from the 'user' subdirectory
    }

    public function saveQuestion()
    {
        $questionModel = new QuestionModel();

        // Validate the question data here using CI4 validation rules

        $data = [
            'question_text' => $this->request->getPost('question_text'),
            'is_anonymous' => $this->request->getPost('is_anonymous') ? 1 : 0
        ];

        if ($questionModel->insert($data)) {
            // Data successfully inserted
            return redirect()->to('/')->with('success', 'Question saved successfully.');
        } else {
            // Data insertion failed
            return redirect()->to('/')->with('error', 'Error saving question.');
        }
    }

    public function savePost()
{
    $postModel = new PostModel();

    // Validate the post data here using CI4 validation rules

    $data = [
        'post_caption' => $this->request->getPost('post_caption'),
        // Other post data fields...

        // Handle image upload
        'post_image' => $this->request->getFile('post_image')->store('post_images', 'uploads'), // Assuming 'uploads' is the writeable directory
    ];

    if ($postModel->insert($data)) {
        // Data successfully inserted
        return redirect()->to('/')->with('success', 'Post saved successfully.');
    } else {
        // Data insertion failed
        return redirect()->to('/')->with('error', 'Error saving post.');
    }
}

}
