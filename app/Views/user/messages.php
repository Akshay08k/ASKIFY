<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Chat Interface</title>
    <link rel="stylesheet" href="<?= base_url('css/messages.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/footer.css') ?>">
    <style>
        .UsersHead {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 20px;
        }
    </style>

</head>

<body>
    <nav id="header">
        <div class="logo">
            <a href="/"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>
        </div>
        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="search" placeholder="Search Question" id="searchInput">
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
    <div class="container">


        <div class="user-list" id="userList">
            <div class="UsersHead">
                Users
            </div>
        </div>
        <div class="chat-area">
            <div class="active-user">

            </div>
            <div class="chat-messages" id="chat">
                <!-- Chat messages will be populated dynamically -->
            </div>
            <div class="message-input">
                <input type="text" id="messageInput" placeholder="Type your message...">
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>


        var selectedUserId = null;
        var lastSentMessageId = null;
        function loadProfile(userName, url) {
            // Log the URL to ensure it contains the correct value
            console.log("Profile Photo URL:", url);

            // Assuming "active-user" is a class for displaying the active user's profile photo and name
            var img = $('<img>').attr('src', url).addClass('active-user-img');

            // Create the user name element
            var userNameElement = $('<p>').addClass('active-user-name').text(userName);

            // Find the element with class "active-user" and append the profile photo and user name elements to it
            $('.active-user').empty().append(img).append(userNameElement);
        }

        function loadUsers() {
            $.ajax({
                url: '<?= base_url('messages/getUsers') ?>',
                method: 'GET',
                success: function (response) {
                    var userList = $('#userList');
                    var users = JSON.parse(response);

                    users.forEach(function (user) {
                        var photoUrl = window.location.origin + '/uploads/UserProfilePhotos/' + user.profile_photo;
                        console.log(photoUrl);

                        // Construct the HTML for the list item
                        var listItemHtml = '<li onclick="loadProfile(\'' + user.name + '\', \'' + photoUrl + '\')" class="flex listitem" data-userid="' + user.id + '">' +
                            '<img src="' + photoUrl + '" height="50" width="50" class="mr-2 rounded-full">' +
                            '<p  class="cursor-pointer">' + user.name + '</p>' +
                            '</li>';

                        // Append the HTML to the user list
                        userList.append(listItemHtml);
                    });
                }
            });

        }
        function toggleSidebar() {
            var sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
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