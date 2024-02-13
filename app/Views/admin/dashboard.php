<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('css/sidebar.css') ?>" rel="stylesheet">
</head>

<body class="bg-gray-100 w-70">
    <div class="flex h-screen bg-gray-200">
        <div id="sidebar">
            <div class="container">
                <div class="avatar">
                    <img src="/sidebar/NYCTOPHILE.png" alt="Profile"></img>
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
            <div class="grid grid-cols-2 gap-4">

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Users:</p>
                    <span class="text-xl font-bold text-indigo-600">1000</span>
                </div>
                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Categories:</p>
                    <span class="text-xl font-bold text-indigo-600">50</span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Reports:</p>
                    <span class="text-xl font-bold text-indigo-600">20</span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Feedbacks:</p>
                    <span class="text-xl font-bold text-indigo-600">30</span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Questions:</p>
                    <span class="text-xl font-bold text-indigo-600">500</span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Total Answers:</p>
                    <span class="text-xl font-bold text-indigo-600">700</span>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Average User Rating:</p>
                    <span class="text-xl font-bold text-indigo-600">4.5</span>

                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <p class="text-gray-800">Pending Moderation Tasks:</p>
                    <span class="text-xl font-bold text-indigo-600">5</span>
                </div>


                <div class="bg-white p-4 shadow-md rounded-md">
                    <h3 class="text-gray-800 text-lg font-semibold mb-2">Treding Categories</h3>
                    <ul class="list-disc list-inside">
                        <li><a href="#">Technology</a></li>
                        <li><a href="#">Science</a></li>
                        <li><a href="#">Health</a></li>
                    </ul>
                </div>


                <div class="bg-white p-4 shadow-md rounded-md">
                    <h3 class="text-gray-800 text-lg font-semibold mb-2">User Feedback</h3>
                    <p class="text-indigo-600">"The platform is user-friendly and informative!"</p>
                    <p class="text-indigo-600">"The platform is user-friendly and informative!"</p>
                    <p class="text-indigo-600">"The platform is user-friendly and informative!"</p>
                </div>

                <div class="bg-white p-4 shadow-md rounded-md">
                    <h3 class="text-gray-800 text-lg font-semibold mb-2">Upcoming Platform Updates</h3>
                    <ul class="list-disc list-inside">
                        <li>New feature: Dark Mode is now available!</li>
                        <li>Improved performance in search functionality.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</body>

</html>