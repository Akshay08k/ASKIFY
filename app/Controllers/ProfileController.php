<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        return view("user/profile");
    }
    public function updateprofile()
    {
        
        if (!session()->has('user_id')) {
            return redirect()->to('/login'); 
        }
        return view('user/updateprofile');
        $model = new UserModel();
    
        $userId = session()->get('user_id');
    
        $data = [
            'name' => $this->request->getPost('name'),
            'gender' => $this->request->getPost('gender'),
            'bio' => $this->request->getPost('bio'),
            'role' => $this->request->getPost('role'),
            'categories' => $this->request->getPost('categories'),
        ];
    
   
        $model->save($userId, $data); 
        return redirect()->to('/login'); 
    }
    public function choosecategory()
    {
        $model = new CategoryModel();
        $data['categories'] = $model->getCategories();

        echo view('user/choosecategory', $data);
    }
}
