<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Categories extends BaseController
{
    public function index()
    {
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
        // Get the category name and use it as the image name
        $categoryName = strtolower(url_title($data['name']));
        $newName = $categoryName . '.' . $image->getClientExtension();

        $image->move('./uploads', $newName);
        $data['image'] = $newName;
    }

    $model->insert($data);
    return redirect()->to('/categories');
}

    public function edit($id)
    {
        $model = new CategoryModel();
        $data['category'] = $model->find($id);
        return view('admin/categories/edit', $data);
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
            // Get the category name and use it as the image name
            $categoryName = strtolower(url_title($data['name']));
            $newName = $categoryName . '.' . $image->getClientExtension();
    
            $image->move('./uploads', $newName);
            $data['image'] = $newName;
        }
    
        $model->update($id, $data);
        return redirect()->to('/categories');
    }

    public function delete($id)
    {
        $model = new CategoryModel();
        $model->delete($id);
        return redirect()->to('/categories');
    }
}
    