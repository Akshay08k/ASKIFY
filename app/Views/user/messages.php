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
    <link rel="stylesheet" href="<?= base_url('css/footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/messages.css') ?>">



</head>

<body class=" h-screen bg-gray-100">
    <nav id="header">
        <div class="logo">
            <a href="#"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>
        </div>
        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search Any User" id="searchInput">
                <div id="liveSearchResults"></div>
            </div>
        </div>
        <ul class="navlink">
            <li><a href="/homepage">Home</a></li>
            <li><a href="/notification">Notification</a></li>
            <li><a href="/messages">Messages</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    </nav>
    <!-- Chatting -->
    <div class="flex flex-row justify-between bg-white">
        <!-- chat list -->
        <h1 class="text-3xl absolute text-center">Users</h1>
        <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto mt-10" id="userList">



            <!-- end user list -->
        </div>
        <!-- end chat list -->
        <!-- message -->
        <div class="w-full  flex flex-col justify-between " id="chat">

        </div>
        <div class="py-5 absolute bottom-10 right-0 w-full">
            <input class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" id="messageInput"
                placeholder="type your message here..." />
            <button onclick="sendMessage()" id="sendButton"
                class="  bg-blue-500 hover:bg-blue-700 text-white  font-bold py-2 px-4 rounded">Send</button>
        </div>
        <!-- end message -->

    </div>
    <footer>
        <div class="foot-panel2">
            <div class="ul">
                <p>Get to know Us</p>
                <a href="/useofaskify">About Askify</a>
            </div>
            <div class="ul">
                <p>Use Of Askify </p>
                <a href="/profile">Your Account</a>
                <a href="/help">Help</a>
                <a id="feedbackBtn">Feedback</a>
            </div>
        </div>
        <div class="foot-panel4">
            <div class="pages">
                <a href="/content-policy">Content Policy</a>
                <a href="/privacy">Privacy And Notice</a>
            </div>
            <div class="copy">©2023, Askify, Inc. or its affiliates</div>
        </div>
    </footer>
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
                        var listItem = $('<li class="flex items-center mb-3" data-userid="' + user.id + '"></li>'); // Create a list item element
                        listItem.append("<img height='40' width='40' class='mr-2' src='data:image/jpeg;base64," + user.profile_photo + "'>"); // Append profile photo
                        listItem.append('<span onclick="loadname(\'' + user.name + '\')" class="cursor-pointer">' + user.name + '</span>'); // Append user name
                        userList.append(listItem); // Append list item to the user list
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


        $(document).ready(function () {
            $('#searchInput').on('input', function () {
                document.getElementById('liveSearchResults').style.display = "block"
                var searchTerm = $(this).val();

                if (searchTerm.length >= 3) {
                    $.ajax({
                        url: '/search/liveSearch',
                        type: 'post',
                        data: { searchTerm: searchTerm },
                        dataType: 'json',
                        success: function (data) {
                            // Clear previous results
                            $('#liveSearchResults').html('');

                            // Process and display the new results
                            if (data.length > 0) {
                                $.each(data, function (index, user) {
                                    // Customize the display based on your need
                                    var userDiv = $('<div class="profile-link" data-userid="' + user.id + '">' + user.name + '</div>');
                                    $('#liveSearchResults').append(userDiv);

                                    // Add click event to redirect to profile
                                    userDiv.on('click', function () {
                                        window.location.href = '/visitprofile/' + user.id;
                                    });
                                });
                            } else {
                                $('#liveSearchResults').html('<div>No Users found</div>');
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
            });
        });

    </script>


</body>

</html>