<?php
namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\VisitorModel;

class Home extends BaseController
{
  public function index()
  {
    $visitorModel = new VisitorModel();
    $visitorModel->trackVisitor($_SERVER['REMOTE_ADDR']);
    $totalVisitors = $visitorModel->getTotalVisitors();
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