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
            // Generate a random name for the file
            $newName = $data['name'] . '.' . $image->getExtension();

            // Move the file to the destination directory
            $image->move(ROOTPATH . '/public/uploads/categoryimages', $newName);

            // Add image path to the data array
            $data['image'] = $newName;
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
            // Generate a random name for the file
            $newName = $data['name'] . '.' . $image->getExtension();

            // Check if an image with the same name exists
            $existingImagePath = ROOTPATH . '/public/upload/categoryimages/' . $newName;
            if (file_exists($existingImagePath)) {
                // If the image already exists, update with existing image path
                $data['image'] = '/upload/categoryimages/' . $newName;
            } else {
                // If the image doesn't exist, move the new image to the directory
                $image->move(ROOTPATH . '/public/upload/categoryimages', $newName);
                // Update the data array with the new image path
                $data['image'] = '/upload/categoryimages/' . $newName;
            }
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
