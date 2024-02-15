<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platfrom Updates</title>
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
            <h2 class="text-2xl font-bold mb-4">Handle Platform Updates</h2>

            <!-- Form to input platform updates -->
            <div class="bg-white p-4 shadow-md rounded-md mb-4">
                <h3 class="text-lg font-semibold mb-2">Add Platform Update</h3>
                <form id="updateForm">
                    <div class="mb-4">
                        <label for="updateDescription" class="block text-sm font-medium text-gray-700">Update
                            Description</label>
                        <textarea id="updateDescription" name="updateDescription" rows="3"
                            class="mt-1 p-2 w-full border rounded-md"></textarea>
                    </div>
                    <button type="button" onclick="addUpdate()"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Add Update</button>
                </form>
            </div>

            <!-- Display platform updates dynamically -->
            <div class="bg-white p-4 shadow-md rounded-md">
                <h3 class="text-lg font-semibold mb-2">Platform Updates</h3>
                <ul id="updateList" class="list-disc ml-4">
                    <!-- Platform updates will be dynamically populated here -->
                </ul>
            </div>

            <!-- Include JavaScript -->
            <script>
                // Array to store platform updates
                const platformUpdates = [];

                // Function to add a platform update
                function addUpdate() {
                    const updateDescription = document.getElementById('updateDescription').value;

                    if (updateDescription.trim() !== '') {
                        platformUpdates.push(updateDescription);
                        populateUpdateList();
                        document.getElementById('updateDescription').value = '';
                    }
                }

                // Function to dynamically populate the platform update list
                function populateUpdateList() {
                    const updateList = document.getElementById('updateList');

                    // Clear existing content
                    updateList.innerHTML = '';

                    // Populate the list with platform updates
                    platformUpdates.forEach(update => {
                        const listItem = document.createElement('div');
                        listItem.textContent = update;
                        updateList.appendChild(listItem);
                    });
                }
            </script>
        </div>
    </div>

</body>

</html>