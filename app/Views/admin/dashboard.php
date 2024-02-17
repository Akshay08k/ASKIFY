<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('css/sidebar.css') ?>" rel="stylesheet">
    <style>
        .selection::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-100 w-70">
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
            <h2 class="text-2xl font-bold mb-4">Manage User Accounts</h2>
            <div class="grid grid-cols-2 gap-4">

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Users:</p>
                    <span class="text-xl font-bold text-indigo-600">
                        <?= $totalUsers ?>
                    </span>
                </div>
                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Categories:</p>
                    <span class="text-xl font-bold text-indigo-600">

                        <?= $totalCategories ?>
                    </span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Reports:</p>
                    <span class="text-xl font-bold text-indigo-600">
                        <?= $totalReports ?>
                    </span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Feedbacks:</p>
                    <span class="text-xl font-bold text-indigo-600">
                        <?= $totalFeedbacks ?>
                    </span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Questions:</p>
                    <span class="text-xl font-bold text-indigo-600">
                        <?= $totalQuestions ?>
                    </span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Answers:</p>
                    <span class="text-xl font-bold text-indigo-600">
                        <?= $totalAnswer ?>
                    </span>
                </div>



                <div class="bg-white p-4 shadow-md rounded-md">
                    <h3 class="text-gray-800 text-lg font-semibold mb-2">Upcoming Platform Updates</h3>

                    <?php if (!empty($platformUpdateNotifications)): ?>
                        <ul class="list-disc list-inside">
                            <?php foreach ($platformUpdateNotifications as $notification): ?>
                                <h3 class="text-xl text-green-700">
                                    <?= esc($notification['text']); ?>
                                </h3>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No upcoming platform updates at the moment.</p>
                    <?php endif; ?>
                </div>

                <form action="/admin/update_trending_categories" method="post"
                    class="w-full mx-auto p-4 border rounded shadow-md bg-white">
                    <label for="categories" class="block font-bold mb-2">Select Trending Categories (up to 5):</label>
                    <select name="categories[]" id="categories" multiple="multiple" size="5"
                        class="selection w-full p-2 border rounded outline-none">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= esc($category['id']); ?>" class="py-2">
                                <?= esc($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Update Trending Categories
                    </button>
                </form>
            </div>

        </div>
    </div>

</body>

</html>