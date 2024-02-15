<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\UserModel;

class AdminCategoriesController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {

            return redirect()->to('/admin');
        }
        $userModel = new UserModel();
        $data['users'] = $userModel->where('id', $userId)->findAll();
        $model = new CategoryModel();
        $data['categories'] = $model->findAll();
        return view('admin/categories/index', $data);
    }

    public function create()
    {
        return view('admin/categories/create');
    }

    public function store()
    {
        $model = new CategoryModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
        ];

        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            // Get the contents of the image file
            $imageData = file_get_contents($image->getPathname());


            $data['image'] = base64_encode($imageData);
        }

        $model->insert($data);
        return redirect()->to('/admin/manage_categories');
    }

    public function update($id)
    {
        $model = new CategoryModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
        ];

        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            // Get the contents of the image file
            $imageData = file_get_contents($image->getPathname());

            // Add image data to the data array
            $data['image'] = base64_encode($imageData);
        }

        $model->update($id, $data);
        return redirect()->to('/admin/manage_categories');
    }


    public function edit($id)
    {
        $model = new CategoryModel();
        $data['category'] = $model->find($id);
        return view('admin/categories/edit', $data);
    }


    public function delete($id)
    {
        $model = new CategoryModel();
        $model->delete($id);
        return redirect()->to('/admin/manage_categories');
    }
    public function getcategories()
    {
        $model = new CategoryModel();
        $categories = $model->findAll();
        return $this->response->setJSON($categories);
    }
}
