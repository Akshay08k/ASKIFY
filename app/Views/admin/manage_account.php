<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <!-- Include Tailwind CSS -->
    <link href="<?= base_url('css/output.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/sidebar.css') ?>" rel="stylesheet">

</head>

<body class="bg-gray-100">
    <div class="flex  bg-gray-200">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed h-full bg-gray-800 text-white p-4">
            <div class="container">
                <div class="avatar">
                    <?php foreach ($users as $user): ?>
                        <?php
                        $username = $user['username'];
                        $profilePhoto = $user['profile_photo'];
                        $profilePhotoBase64 = 'data:image/png;base64,' . base64_encode($profilePhoto);
                        ?>
                        <img src="<?= $profilePhotoBase64 ?>" alt="Profile Picture">
                    </div>
                    <h3 class="admin-name">
                        <?= $user['name'] ?>
                    </h3>
                    <h4 class="admin-title">Admin</h4>
                </div>
                <ul class="sidebtns">
                    <!-- Your sidebar links go here -->
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
        <div class="flex-1 p-4 ml-64 overflow-x-hidden">

            <!-- Account Information -->
            <div class="w-3/4 mx-auto bg-white p-6 rounded-md shadow-md mt-8">
                <form method="post" action="<?= base_url('admin/updateprofile/save') ?>" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <label class="block mb-2 text-sm font-bold text-gray-600" for="profile_photo">Profile Photo:</label>
                    <input type="file" name="profile_photo" accept="image/*" class="w-full border p-2 mb-4">

                    <label class="block mb-2 text-sm font-bold text-gray-600" for="username">Username:</label>
                    <input type="text" name="username" value="<?= $user['username'] ?>" required
                        class="w-full border p-2 mb-4">

                    <label class="block mb-2 text-sm font-bold text-gray-600" for="email">Email:</label>
                    <input type="email" name="email" value="<?= $user['email'] ?>" required class="w-full border p-2 mb-4">

                    <label class="block mb-2 text-sm font-bold text-gray-600" for="name">Name:</label>
                    <input type="text" name="name" value="<?= $user['name'] ?>" required class="w-full border p-2 mb-4">

                    <label class="block mb-2 text-sm font-bold text-gray-600" for="birthdate">Birthdate
                        (yyyy-mm-dd):</label>
                    <input type="text" name="birthdate" pattern="\d{4}-\d{2}-\d{2}" value="<?= $user['birthdate'] ?>"
                        required class="w-full border p-2 mb-4">

                    <label class="block mb-2 text-sm font-bold text-gray-600" for="location">Location:</label>
                    <input type="text" name="location" value="<?= $user['location'] ?>" class="w-full border p-2 mb-4">

                    <label class="block mb-2 text-sm font-bold text-gray-600" for="about">About:</label>
                    <textarea name="about" class="w-full border p-2 mb-4"><?= $user['about'] ?></textarea>

                    <label class="block mb-2 text-sm font-bold text-gray-600" for="gender">Gender:</label>
                    <select name="gender" class="w-full border p-2 mb-4">
                        <option value="male" <?= ($user['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= ($user['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= ($user['gender'] == 'other') ? 'selected' : '' ?>>Other</option>
                    </select>


                    <label class="block mb-2 text-sm font-bold text-gray-600">Social Media Links:</label>
                    <div class="flex space-x-4 mb-4">
                        <input type="text" name="instagram" placeholder="Instagram" value="<?= $user['instagram'] ?>"
                            class="flex-1 border p-2 placeholder-gray-400">
                        <input type="text" name="twitter" placeholder="Twitter" value="<?= $user['twitter'] ?>"
                            class="flex-1 border p-2 placeholder-gray-400">
                        <input type="text" name="discord" placeholder="Discord" value="<?= $user['discordlink'] ?>"
                            class="flex-1 border p-2 placeholder-gray-400">
                        <input type="text" name="github" placeholder="GitHub" value="<?= $user['github'] ?>"
                            class="flex-1 border p-2 placeholder-gray-400">
                    </div>

                    <button type="submit"
                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Update
                    </button>
                </form>
            </div>
        <?php endforeach ?>
    </div>
    </div>
</body>

</html>