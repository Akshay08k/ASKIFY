<?php

namespace App\Controllers;

use App\Models\MessageModel;
use CodeIgniter\Controller;

class MessageController extends BaseController
{
    public function index()
    {
        $messageModel = new MessageModel();
        $data['messages'] = $messageModel->findAll();

        return view('user/messages/index', $data);
    }

    public function create()
    {
        return view('user/messages/create');
    }

    public function store()
    {
        $messageModel = new MessageModel();

        $data = [
            'sender_id' => $this->request->getPost('sender_id'),
            'receiver_id' => $this->request->getPost('receiver_id'),
            'message' => $this->request->getPost('message'),
            'media' => $this->request->getPost('media'),
            'seen' => $this->request->getPost('seen'),
            'created_at' => $this->request->getPost('created_at'),
            'received_at' => $this->request->getPost('received_at'),
            'updated_at' => $this->request->getPost('updated_at'),
        ];

        $messageModel->insert($data);

        return redirect()->to('/messages');
    }

    public function edit($id)
    {
        $messageModel = new MessageModel();
        $data['message'] = $messageModel->find($id);

        return view('messages/edit', $data);
    }

    public function update($id)
    {
        $messageModel = new MessageModel();

        $data = [
            'sender_id' => $this->request->getPost('sender_id'),
            'receiver_id' => $this->request->getPost('receiver_id'),
            'message' => $this->request->getPost('message'),
            'media' => $this->request->getPost('media'),
            'seen' => $this->request->getPost('seen'),
            'created_at' => $this->request->getPost('created_at'),
            'received_at' => $this->request->getPost('received_at'),
            'updated_at' => $this->request->getPost('updated_at'),
        ];

        $messageModel->update($id, $data);

        return redirect()->to('/messages');
    }

    public function destroy($id)
    {
        $messageModel = new MessageModel();
        $messageModel->delete($id);

        return redirect()->to('/messages');
    }
}