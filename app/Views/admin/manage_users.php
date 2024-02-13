<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('css/sidebar.css') ?>" rel="stylesheet">

    <style>
        .banbtn {
            background-color: red;
            color: white;
            height: 30px;
            width: 70px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .deletebtn {
            background-color: red;
            color: white;
            height: 30px;
            width: 80px;
            border-radius: 5px;
            margin-right: 10px;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex h-screen bg-gray-200">
        <div id="sidebar">
            <div class="container">
                <div class="avatar">
                    <!-- <img src="" alt="Profile"></img> -->
                </div>
                <h3 class="admin-name">User Name</h3>
                <h4 class="admin-title">Admin</h4>
            </div>
            <ul class="sidebtns">
            <li><a href="/admin/dashboard">Dashboard</a></li>
                <li><a href="/admin/manage_users">User Management</a></li>
                <li><a href="/admin/manage_categories">Manage Categories</a></li>
                <li><a href="/admin/moderate_content">Content Moderation</a></li>
                <li><a href="/admin/handle_issues">Handle Issue</a></li>
                <li><a href="/admin/feedbacks">Feedbacks</a></li>
                <li><a href="/admin/handle_updates">Platform Updates</a></li>
                <li><a href="/admin/manage_accounts">Account</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="flex-1 p-4">
            <h2 class="text-2xl font-bold mb-4">Manage User Accounts</h2>

            <!-- Actual content related to managing user accounts -->
            <div class="bg-white p-4 shadow-md rounded-md">
                <div class="mb-4 flex items-center">
                    <input type="text" id="searchInput" class="border rounded p-2 flex-1" placeholder="Search...">
                    <select id="searchBy" class="ml-2 p-2 border rounded">
                        <option value="name">Search by Name</option>
                        <option value="id">Search by ID</option>
                    </select>
                </div>

                <table class="w-full border text-center">
                    <thead>
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Username</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Gender</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        <!-- User table will be dynamically populated here -->
                    </tbody>
                </table>
            </div>

            <!-- Add more content as needed -->

        </div>
    </div>

    <!-- Include JavaScript -->
    <script>
        // Sample array of users (replace this with data from your backend)
        const users = [
            { id: 1, name: 'User 1', username: 'user1', email: 'user1@example.com', gender: 'Male' },
            { id: 2, name: 'User 2', username: 'user2', email: 'user2@example.com', gender: 'Female' },
            { id: 3, name: 'User 3', username: 'user3', email: 'user3@example.com', gender: 'Other' },
            { id: 4, name: 'User 4', username: 'user4', email: 'user4@example.com', gender: 'Male' }
        ];

        // Function to dynamically populate the user table
        function populateUserTable(filteredUsers) {
            const userTable = document.getElementById('userTable');

            // Clear existing content
            userTable.innerHTML = '';

            // Use filteredUsers if available, otherwise use all users
            const usersToDisplay = filteredUsers || users;

            // Populate the table with users
            usersToDisplay.forEach(user => {
                const row = userTable.insertRow();
                const banBtn = document.createElement('button');
                banBtn.className = 'banbtn';
                banBtn.textContent = 'Ban';
                banBtn.addEventListener('click', () => {
                    banBtn.style.backgroundColor = 'green';
                });

                row.innerHTML = `
                        <td class="p-2 border">${user.id}</td>
                        <td class="p-2 border">${user.name}</td>
                        <td class="p-2 border">${user.username}</td>
                        <td class="p-2 border">${user.email}</td>
                        <td class="p-2 border">${user.gender}</td>
                        <td class="p-2 border">
                            ${banBtn.outerHTML}
                            <button class="deletebtn">Delete</button>
                        </td>
                    `;
            });

            // Add event listeners to all 'Ban' buttons after they are created
            const banButtons = document.querySelectorAll('.banbtn');
            banButtons.forEach(banBtn => {
                banBtn.addEventListener('click', () => {

                    if (banBtn.textContent == "Unban" || banBtn.backgroundColor == "green") {
                        banBtn.textContent = "Ban"
                        banBtn.style.backgroundColor = "red"
                    } else {
                        banBtn.style.backgroundColor = 'green';
                        banBtn.textContent = "Unban"
                    }
                });
            });
        }

        // Function to search and filter users
        function searchUsers() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const searchBy = document.getElementById('searchBy').value;

            const filteredUsers = users.filter(user => {
                if (searchBy === 'name') {
                    return user.name.toLowerCase().includes(searchInput);
                } else if (searchBy === 'id') {
                    return user.id.toString().includes(searchInput);
                }
            });

            // Repopulate the table with filtered users
            populateUserTable(filteredUsers);
        }

        // Call the functions when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            populateUserTable();
            document.getElementById('searchInput').addEventListener('input', searchUsers);
            document.getElementById('searchBy').addEventListener('change', searchUsers);
        });

    </script>

</body>

</html>