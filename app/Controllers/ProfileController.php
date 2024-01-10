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
        return view("user/updateprofile");
        $Model = new UserModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'gender' => $this->request->getVar('gender'),
            'bio' => $this->request->getVar('bio'),
            'role' => $this->request->getVar('role'),
            'categories' => $this->request->getVar('categories'),
            'profilephoto' => $this->request->getVar('profilephoto')
            ];
            $Model->save($data);
            return redirect()->to('user/profile');
    }
    public function choosecategory()
    {
        $model = new CategoryModel();
        $data['categories'] = $model->getCategories();

        echo view('user/choosecategory', $data);
    }
}
