<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Messages</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        #userList {
            list-style-type: none;
            height: 100%;
        }

        #userList li {
            cursor: pointer;
            padding: 8px;
            transition: background-color 0.3s;
        }

        #userList li:hover {
            background-color: #2d3748;
        }

        #userList li.selected {
            background-color: #4a5568;
        }

        #chat {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            padding: 10px;
        }

        .bubble {
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 10px;
            word-wrap: break-word;
            max-width: 70%;
        }

        .self-bubble {
            background-color: #4a90e2;
            color: #fff;
            align-self: flex-end;
        }

        .other-bubble {
            background-color: #e2e8f0;
            color: #000;
        }

        #messageInput {
            width: 50%;

            padding: 8px;
            position: absolute;
            bottom: 20px;
            border: 1px solid #a0aec0;
            border-radius: 4px;
            margin-right: 8px;
        }

        #sendButton {
            background-color: #2b6cb0;
            color: #fff;
            padding: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            bottom: 20px;
            right: 20%;
        }
    </style>
</head>

<body class="flex h-screen bg-gray-100">
    <div class="w-1/4 bg-gray-800 text-white p-6">
        <h1 class="text-2xl font-bold mb-4">Users</h1>
        <ul id="userList" class="overflow-y-auto">
        </ul>
    </div>

    <div class="flex-1 p-6 overflow-y-auto">
        <h1 class="text-2xl font-bold mb-4">Chat</h1>
        <div id="chat" class="flex flex-col space-y-4">
        </div>
        <div class="mt-4">
            <input type="text" id="messageInput" placeholder="Type your message..." class="w-full p-2 border rounded"
                required>
            <button onclick="sendMessage()" id="sendButton"
                class="mt-2 bg-blue-500 text-white p-2 rounded">Send</button>
        </div>
    </div>
    <script>
        function loadUsers() {
            $.ajax({
                url: '<?= base_url('messages/getUsers') ?>',
                method: 'GET',
                success: function (response) {
                    var userList = $('#userList');
                    userList.empty();
                    var users = JSON.parse(response);

                    users.forEach(function (user) {
                        userList.append('<li data-userid="' + user.id + '">' + user.name + '</li>');
                    });
                }
            });
        }

        function loadMessages(userId, latestMessageId = 0) {
            // Clear the chat content before loading new messages
            $('#chat').empty();

            $.ajax({
                url: '<?= base_url('messages/getMessages/') ?>' + '/' + userId + '/' + latestMessageId,
                method: 'GET',
                success: function (response) {
                    var chat = $('#chat');
                    var messages = JSON.parse(response);

                    messages.forEach(function (message) {
                        var bubbleClass = message.sender_id == '<?= session()->get('user_id') ?>' ? 'self-bubble' : 'other-bubble';
                        var alignmentClass = message.sender_id == '<?= session()->get('user_id') ?>' ? 'text-right' : 'text-left';

                        var messageDiv = $('<div>').addClass('message bubble p-2 rounded max-w-xs ' + bubbleClass + ' ' + alignmentClass).text(message.message);

                        // Set a data attribute to store the message ID
                        messageDiv.attr('data-messageid', message.id);

                        chat.append(messageDiv);

                        // Scroll to the bottom of the chat after appending a message
                        chat.scrollTop(chat[0].scrollHeight);
                    });
                }
            });
        }

        function sendMessage() {
            var receiverId = $('#userList li.selected').data('userid');
            var message = $('#messageInput').val();

            $.ajax({
                url: '<?= base_url('messages/sendMessage') ?>',
                method: 'POST',
                data: { receiver_id: receiverId, message: message },
                success: function (response) {
                    $('#messageInput').val('');
                    loadMessages(receiverId);
                }
            });
        }

        $('#userList').on('click', 'li', function () {
            var userId = $(this).data('userid');
            $('#userList li').removeClass('selected');
            $(this).addClass('selected');
            loadMessages(userId);
        });

        loadUsers();
    </script>



    <!-- Your existing HTML code -->

</body>

</html>