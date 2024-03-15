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
                    var listItem = $('<li class="flex items-center mb-3" data-userid="' + user.id + '"></li>');
                    var photoUrl = window.location.origin + '/uploads/UserProfilePhotos/' + user.profile_photo;
                    console.log(user.profile_photo)
                    listItem.append("<img height='50' width='50' class='mr-2 rounded-full' src='" + photoUrl + "'>");
                    listItem.append('<span onclick="loadname(\'' + user.name + '\')" class="cursor-pointer">' + user.name + '</span>');
                    userList.append(listItem);
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