<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class ProfileController extends BaseController
{
    public function index()
    {
        return view("user/profile");
    }
    public function updateprofile()
    {
        return view("user/updateprofile");
    }
    public function choosecategory()
    {$model = new CategoryModel();
        $data['categories'] = $model->getCategories();

        echo view('user/choosecategory', $data);
    }
}
