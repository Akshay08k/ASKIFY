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
    <div class="fixed h-screen bg-gray-200">
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
    </div>

    <!-- Content -->
    <div class="ml-60 p-4">
        <h2 class="text-2xl font-bold mb-4">Manage User Accounts</h2>
        <div class="bg-white p-4 shadow-md rounded-md">
            <div class="mb-4 flex items-center">
                <input type="text" id="searchInput" class="border rounded p-2 flex-1" placeholder="Search...">
                <select id="searchBy" class="ml-2 p-2 border rounded">
                    <option value="username">Search by Username</option>
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

    <!-- Include JavaScript -->
    <!-- Include JavaScript -->
    <script>
        // Function to dynamically populate the user table
        function populateUserTable(filteredUsers) {
            const userTable = document.getElementById('userTable');

            // Clear existing content
            userTable.innerHTML = '';

            // Use filteredUsers if available, otherwise fetch users from the backend
            const usersToDisplay = filteredUsers || fetchUsersFromBackend();

            // Populate the table with users
            usersToDisplay.then(users => {
                users.forEach(user => {
                    const row = userTable.insertRow();
                    const banBtn = document.createElement('button');
                    const deleteBtn = document.createElement('button');

                    banBtn.className = 'banbtn';
                    banBtn.textContent = 'Ban';

                    deleteBtn.className = 'deletebtn';
                    deleteBtn.textContent = 'Delete';

                    row.innerHTML = `
                    <td class="p-2 border">${user.id}</td>
                    <td class="p-2 border">${user.name}</td>
                    <td class="p-2 border">${user.username}</td>
                    <td class="p-2 border">${user.email}</td>
                    <td class="p-2 border">${user.gender}</td>
                    <td class="p-2 border">
                        ${banBtn.outerHTML}
                        ${deleteBtn.outerHTML}
                    </td>
                `;
                });
            });

            // Add event listener to the parent (userTable) for event delegation
            userTable.addEventListener('click', (event) => {
                const target = event.target;
                if (target.classList.contains('banbtn')) {
                    handleBanButtonClick(target);
                } else if (target.classList.contains('deletebtn')) {
                    handleDeleteButtonClick(target);
                }
            });
        }

        // Function to delete a user
        async function deleteUser(userId) {
            try {
                const response = await fetch(`/admin/deleteUser/${userId}`, {
                    method: 'POST',
                });
                if (response.ok) {
                    // User deleted successfully, you may want to refresh the user table
                    populateUserTable();
                } else {
                    console.error('Error deleting user');
                }
            } catch (error) {
                console.error('Error deleting user:', error);
            }
        }

        // Function to handle 'Ban' button click
        function handleBanButtonClick(banBtn) {
            if (banBtn.textContent === 'Unban' || banBtn.style.backgroundColor === 'green') {
                banBtn.textContent = 'Ban';
                banBtn.style.backgroundColor = 'red';
            } else {
                banBtn.style.backgroundColor = 'green';
                banBtn.textContent = 'Unban';
            }
        }

        // Function to handle 'Delete' button click
        function handleDeleteButtonClick(deleteBtn) {
            // Prompt for confirmation before deleting
            const confirmDelete = confirm('Are you sure you want to delete this user?');
            if (confirmDelete) {
                // Call the delete user function
                const userId = deleteBtn.closest('tr').querySelector('td:first-child').textContent;
                deleteUser(userId);
            }
        }

        // Function to fetch users from the backend
        async function fetchUsersFromBackend() {
            try {
                const response = await fetch('/messages/getUsers');
                const users = await response.json();
                return users;
            } catch (error) {
                console.error('Error fetching users:', error);
                return [];
            }
        }

        // Function to search and filter users
        function searchUsers() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const searchBy = document.getElementById('searchBy').value;

            const filteredUsers = users.filter(user => {
                if (searchBy === 'username') {
                    return user.username.toLowerCase().includes(searchInput);
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