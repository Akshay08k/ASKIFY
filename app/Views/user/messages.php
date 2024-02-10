<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Chat App</title>

</head>

<body class="flex h-screen bg-gray-100">
    <div class="w-1/4 bg-gray-800 text-white p-6">
        <h1 class="text-2xl font-bold mb-4">User List</h1>
        <ul id="userList" class="overflow-y-auto">
            <!-- User list will be dynamically populated here -->
        </ul>
    </div>

    <div class="flex-1 p-6 overflow-y-auto">
        <h1 class="text-2xl font-bold mb-4">Chat</h1>
        <div id="chat" class="flex flex-col space-y-4">
            <!-- Chat messages will be dynamically populated here -->
        </div>
        <div class="mt-4">
            <input type="text" id="messageInput" placeholder="Type your message..." class="w-full p-2 border rounded">
            <button onclick="sendMessage()" class="mt-2 bg-blue-500 text-white p-2 rounded">Send</button>
        </div>
    </div>
    <script>
        const userList = document.getElementById('userList');
        const chat = document.getElementById('chat');
        const messageInput = document.getElementById('messageInput');
        const currentUser = 'YourUsername';  // Set your username here

        // Dummy user data
        const users = ['User1', 'User2', 'User3'];

        // Populate user list
        users.forEach(user => {
            const li = document.createElement('li');
            li.textContent = user;
            li.classList.add('mb-2', 'cursor-pointer', 'hover:text-blue-500');
            li.addEventListener('click', () => openChat(user));
            userList.appendChild(li);
        });

        // Function to open chat with a user
        function openChat(user) {
            // Clear previous chat
            chat.innerHTML = `<h2 class="text-xl font-bold mb-2">${user}</h2>`;

            // Load some dummy messages
            const dummyMessages = [
                { sender: 'User1', message: 'Hello there!' },
                { sender: currentUser, message: 'Hi! This is me.' },
                { sender: 'User1', message: 'Nice to meet you!' },
                { sender: currentUser, message: 'Likewise!' }
            ];

            dummyMessages.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.textContent = msg.message;
                messageDiv.classList.add('p-2', 'rounded', 'max-w-xs');

                // Check if the message sender is the current user
                if (msg.sender === currentUser) {
                    messageDiv.classList.add('bg-blue-500', 'text-white', 'ml-auto');  // Align right for current user
                } else {
                    messageDiv.classList.add('bg-gray-300', 'text-black');  // Align left for other users
                }

                chat.appendChild(messageDiv);
            });
        }

        // Function to send a message
        function sendMessage() {
            const message = messageInput.value.trim();

            if (message !== '') {
                const messageDiv = document.createElement('div');
                messageDiv.textContent = message;
                messageDiv.classList.add('p-2', 'rounded', 'max-w-xs', 'bg-blue-500', 'text-white', 'ml-auto');  // Align right for current user
                chat.appendChild(messageDiv);

                // Clear input field
                messageInput.value = '';
            }
        }

    </script>
</body>

</html>