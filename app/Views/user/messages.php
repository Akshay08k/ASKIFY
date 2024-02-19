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
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/messages.css') ?>">



</head>

<body class=" h-screen bg-gray-100">
    <nav id="header">
        <div class="logo">
            <a href="#"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>
        </div>
        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search Any User">
            </div>
        </div>
        <ul class="navlink">
            <li><a href="/homepage">Home</a></li>
            <li><a href="/notification">Notification</a></li>
            <li><a href="/messages">Messages</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    </nav>
    <div class="main ">
        <div class=" p-6">
            <h1 class="text-2xl font-bold mb-4">Users</h1>
            <ul id="userList" class="overflow-y-auto">
            </ul>
        </div>

        <div class="flex-1 p-6 overflow-y-auto">
            <h1 class="text-2xl font-bold mb-4" id="chatHeading">Chat</h1>
            <div id="chat" class="flex flex-col space-y-4">
                Click TO Any User To Chat / Follow User That User Will Appear Here

            </div>
            <div class="interect">
                <input type="text" id="messageInput" placeholder="Type your message..."
                    class="w-full p-2 border rounded" required>
                <button onclick="sendMessage()" id="sendButton"
                    class="mt-2 bg-blue-500 text-white p-2 rounded">Send</button>
            </div>

        </div>
    </div>
    <script>
        function loadname(name) {
            let selectedUserName = document.getElementById('chatHeading');
            selectedUserName.textContent = name;
        }

        var selectedUserId = null;
        var lastSentMessageId = null;

        function loadUsers() {
            $.ajax({
                url: '<?= base_url('messages/getUsers') ?>',
                method: 'GET',
                success: function (response) {
                    var userList = $('#userList');
                    userList.empty();
                    var users = JSON.parse(response);

                    users.forEach(function (user) {
                        userList.append('<li onclick="loadname(\'' + user.name + '\')" class="mb-3" data-userid="' + user.id + '">' + user.name + '</li>');
                    });
                }
            });
        }
        function loadMessages(userId) {
            var chat = $('#chat');
            var latestMessageId = chat.children('.message:last').data('messageid') || 0;
            var url = '<?= base_url('messages/getMessages/') ?>' + '/' + userId + '/' + latestMessageId;
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var messages = JSON.parse(response);
                    messages.forEach(function (message) {
                        // Skip the last sent message
                        if (message.id != lastSentMessageId) {
                            var bubbleClass = message.sender_id == '<?= session()->get('user_id') ?>' ? 'self-bubble' : 'other-bubble';
                            var alignmentClass = message.sender_id == '<?= session()->get('user_id') ?>' ? 'text-right' : 'text-left';
                            var messageDiv = $('<div>').addClass('message bubble p-2 rounded ' + bubbleClass + ' ' + alignmentClass).text(message.message);
                            // Set a data attribute to store the message ID
                            messageDiv.attr('data-messageid', message.id);
                            chat.append(messageDiv);
                            // Scroll to the bottom of the chat after appending a message
                            chat.scrollTop(chat[0].scrollHeight);
                        }
                    });
                }
            });
        }
        function sendMessage() {
            var receiverId = selectedUserId;
            var message = $('#messageInput').val();
            $.ajax({
                url: '<?= base_url('messages/sendMessage') ?>',
                method: 'POST',
                data: { receiver_id: receiverId, message: message },
                success: function (response) {
                    $('#messageInput').val('');

                    // Update the last sent message ID
                    lastSentMessageId = response.message_id;

                    loadMessages(receiverId);
                }
            });
        }

        // Periodically load messages
        setInterval(function () {
            if (selectedUserId !== null) {
                loadMessages(selectedUserId);
            }
        }, 5000); // Adjust the interval (in milliseconds) as needed

        $('#userList').on('click', 'li', function () {
            $('#chat').empty();
            selectedUserId = $(this).data('userid');
            $('#userList li').removeClass('selected');
            $(this).addClass('selected');
            loadMessages(selectedUserId);
        });


        loadUsers();

    </script>


</body>

</html>