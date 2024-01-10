<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php base_url('css/messages.css') ?> ">
    <title>Chat App</title>
</head>

<body>
    <div class="chat-container">
        <div class="sidebar">
            <nav class="navbar">
                <ul>
                    <li class="active">You</li>
                    <li>Kelly</li>
                    <li>Emily</li>
                    <li>Nomini</li>
                    <li>Celmen</li>
                    <li>Rooby</li>
                    <li>MCA </li>
                    <li>Akshay</li>
                    <li>TAsin</li>
                    <li>Jaynsh</li>
                    <li>nikul</li>
                    <li>sejal</li>
                    <li>parth</li>
                    <li>kinjal</li>
                </ul>
            </nav>
        </div>
        <div class="main">
            <div class="chat-header">
                <h2>Chat with User</h2>
            </div>
            <div class="chat-messages" id="chatMessages">
            </div>
            <div class="chat-input">
                <input type="text" id="messageInput" placeholder="Type your message...">
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>
    <script src="<?php base_url('js/message.js') ?>"></script>
</body>

</html>