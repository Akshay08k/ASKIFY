<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MessageModel;
use App\Models\UserModel;

class MessageController extends Controller
{
    protected $chatModel;

    public function __construct()
    {
        $this->chatModel = new MessageModel();

        $this->userModel = new UserModel();

    }

    public function index()
    {
        return view('user/messages');
    }

    public function getUsers()
    {
        $users = $this->userModel->findAll(); // Fetch all users from UserModel

        $userList = [];
        foreach ($users as $user) {
            $userList[] = ['id' => $user['id'], 'username' => $user['username'], 'name' => $user['name'], 'gender' => $user['gender'], 'email' => $user['email']];
        }

        echo json_encode($userList);
    }

    public function getMessages($receiverId, $latestMessageId = 0, $lastSentMessageId = 0)
    {
        $senderId = session()->get('user_id');

        $messages = $this->chatModel
            ->whereIn('sender_id', [$senderId, $receiverId])
            ->whereIn('receiver_id', [$senderId, $receiverId])
            ->where('id >', $latestMessageId)
            ->where('id !=', $lastSentMessageId) // Exclude the last sent message
            ->orderBy('created_at', 'ASC')
            ->findAll();

        echo json_encode($messages);
    }






    public function sendMessage()
    {
        $senderId = session()->get('user_id'); // Replace with the actual sender's ID
        $receiverId = $this->request->getPost('receiver_id');
        $message = $this->request->getPost('message');

        // Handle media file if needed

        $data = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $message,
            'seen' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'received_at' => null, // Set to null initially
        ];

        $this->chatModel->insert($data);

        echo json_encode(['success' => true]);
    }
}
