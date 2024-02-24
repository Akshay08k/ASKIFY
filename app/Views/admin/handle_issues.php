<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <!-- Include Tailwind CSS -->
    <link href="<?= base_url('css/output.min.css') ?>" rel="stylesheet">
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

        <div class="flex-1 p-4">
            <h2 class="text-2xl font-bold mb-4">Handle Reported Issues</h2>

            <!-- Display reported issues dynamically -->
            <div class="bg-white p-4 shadow-md rounded-md">
                <h3 class="text-lg font-semibold mb-4">Reported Issues</h3>

                <?php foreach ($reportedIssues as $issue): ?>

                    <strong class="text-gray-700">From User:</strong>
                    <?= $issue['from_user'] ?>
                    <br>
                    <strong class="text-gray-700">Question ID:</strong>
                    <?= $issue['question_id'] ?>
                    <br>
                    <strong class="text-gray-700">Message:</strong>
                    <?= $issue['message'] ?>
                    <br>
                    <strong class="text-gray-700">Status:</strong>
                    <?= $issue['status'] ?>


                    <!-- Buttons for resolving and deleting reported issues -->
                    <div class="mt-4 space-x-4">
                        <form action="/admin/resolve_issue/<?= $issue['id'] ?>" method="post" class="mt-4 space-x-4">
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Resolve</button>
                        </form>
                    </div>

                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <script>

        </script>

</body>

</html>