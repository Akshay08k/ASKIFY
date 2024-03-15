<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Updates</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('css/sidebar.css') ?>" rel="stylesheet">

</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex h-screen bg-gray-200">
        <div id="sidebar" class="w-64 bg-gray-800 text-white fixed left-0 h-full">
            <div class="container p-4">
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
        <div class="flex-1 p-10 ml-64">
            <h1 class="text-2xl font-bold mb-4">Categories</h1>

            <!-- Add the search box at the top of your page -->
            <input type="text" id="categorySearch" class="mb-4 px-4 py-2 w-9/12  rounded-md border"
                placeholder="Search categories...">
            <br>
            <br>
            <a href="/categories/create"
                class="createnew bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 absolute right-10 top-24">Create
                New
                Category</a>
            <table class="w-full mt-4 bg-white shadow-md rounded-md overflow-hidden border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Image</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">
                                <?= $category['name']; ?>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <img src="<?= base_url('uploads/categoryimages/' . $category['image']) ?>"
                                    alt="Category Image" class="w-16 h-16 object-cover mx-auto">
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="/categories/edit/<?= $category['id']; ?>"
                                    class="text-blue-500 hover:underline">Edit</a>
                                <a href="/categories/delete/<?= $category['id']; ?>"
                                    class="text-red-500 hover:underline ml-2">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the input element and add an input event listener
            const searchInput = document.getElementById('categorySearch');
            searchInput.addEventListener('input', function () {
                // Get the search value
                const searchValue = searchInput.value.toLowerCase();

                // Get all category rows
                const categoryRows = document.querySelectorAll('tbody tr');

                // Loop through category rows and hide/show based on search
                categoryRows.forEach(function (row) {
                    const categoryName = row.querySelector('td:first-child').textContent.toLowerCase();

                    // If category name includes search value, show the row; otherwise, hide it
                    row.style.display = categoryName.includes(searchValue) ? '' : 'none';
                });
            });
        });
    </script>
</body>

</html>