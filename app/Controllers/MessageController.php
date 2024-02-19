<?php

namespace App\Controllers;

use App\Models\FollowerModel;
use CodeIgniter\Controller;
use App\Models\MessageModel;
use App\Models\UserModel;

class MessageController extends Controller
{
    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            session()->setFlashdata('error', 'Please Login To Continue');
            return redirect()->to('login');

        }
        return view('user/messages');
    }

    public function getUsers()
    {
        $userId = session()->get('user_id');
        $FollowerModel = new FollowerModel();
        $userModel = new UserModel();

        // Fetch all followed users' ids
        $followedUsers = $FollowerModel->where('user_id', $userId)->findAll();
        $followedUserIds = array_column($followedUsers, 'follower_id');

        // Fetch user details for the followed users    
        $users = $userModel->whereIn('id', $followedUserIds)->findAll();

        $userList = [];
        foreach ($users as $user) {
            $userList[] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'name' => $user['name'],
                'gender' => $user['gender'],
                'email' => $user['email'],
                'status' => $user['status']
            ];
        }
        echo json_encode($userList);

    }
    public function getMessages($receiverId, $latestMessageId = 0, $lastSentMessageId = 0)
    {
        $chatModel = new MessageModel();
        $senderId = session()->get('user_id');

        $messages = $chatModel
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
        $chatModel = new MessageModel();
        $senderId = session()->get('user_id'); // Replace with the actual sender's ID
        $receiverId = $this->request->getPost('receiver_id');
        $message = $this->request->getPost('message');
        $data = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $chatModel->insert($data);
        echo json_encode(['success' => true]);
    }
}
