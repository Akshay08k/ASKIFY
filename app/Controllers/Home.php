<?php
namespace App\Controllers;

use App\Models\CategoryModel;

class Home extends BaseController
{
  public function index()
  {
    $categoryModel = new CategoryModel();
    $data['categories'] = $categoryModel->findAll();
    return view('user/withoutlogin', $data);
  }
  public function logout()
  {
    session()->destroy();
    return redirect()->to('/login');
  }

}