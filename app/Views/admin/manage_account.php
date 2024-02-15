<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('css/sidebar.css') ?>" rel="stylesheet">

</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen bg-gray-200">
        <div id="sidebar">
            <div class="container">
                <div class="avatar">
                    <?php foreach ($users as $user): ?>
                        <?php
                        $username = $user['username'];


                        $profilePhoto = $user['profile_photo'];


                        $profilePhotoBase64 = 'data:image/png;base64,' . base64_encode($profilePhoto);


                        ?>
                        <img src="<?= $profilePhotoBase64 ?>" alt="Profile Picture">
                    <?php endforeach ?>
                </div>
                <h3 class="admin-name">
                    <?= $user['name'] ?>
                </h3>
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
            <h2 class="text-2xl font-bold mb-4">Manage Own Account</h2>

            <!-- Account Information -->
            <div class="bg-white p-4 shadow-md rounded-md mb-4">
                <h3 class="text-lg font-semibold mb-2">Account Information</h3>
                <form id="accountForm">
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" name="username" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select id="gender" name="gender" class="mt-1 p-2 w-full border rounded-md">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="profilePhoto" class="block text-sm font-medium text-gray-700">Profile Photo</label>
                        <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*"
                            class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                        onclick="updateAccount()">Update Account</button>
                </form>
            </div>

            <!-- Include JavaScript -->
            <script>
                // Sample user data (replace this with data from your backend)
                const userData = {
                    username: 'sample_user',
                    email: 'sample@example.com',
                    password: 'password123',
                };

                // Function to populate account information
                function populateAccountInfo() {
                    document.getElementById('username').value = userData.username;
                    document.getElementById('email').value = userData.email;
                }

                // Function to update account information
                function updateAccount() {
                    const newPassword = document.getElementById('password').value;
                    const newDOB = document.getElementById('dob').value;
                    const newGender = document.getElementById('gender').value;
                    const newProfilePhoto = document.getElementById('profilePhoto').value;

                    // Update password only if a new password is provided
                    if (newPassword.trim() !== '') {
                        userData.password = newPassword;
                    }

                    // Update DOB if provided
                    if (newDOB.trim() !== '') {
                        // Add logic to update DOB
                    }

                    // Update gender if provided
                    if (newGender.trim() !== '') {
                        // Add logic to update gender
                    }

                    // Update profile photo if provided
                    if (newProfilePhoto.trim() !== '') {
                        // Add logic to update profile photo
                    }

                    alert('Account updated successfully!');
                }

                // Call the function when the page loads
                document.addEventListener('DOMContentLoaded', populateAccountInfo);
            </script>
        </div>
    </div>

</body>

</html>