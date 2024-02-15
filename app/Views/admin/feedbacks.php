<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="<?= base_url('css/sidebar.css') ?>" rel="stylesheet">

</head>

<body>
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
        <div class="flex-grow p-10">
            <h1 class="text-2xl font-bold mb-4">Feedbacks</h1>

            <!-- Feedback List -->
            <div id="feedbackList" class="grid grid-cols-3 gap-4">
                <!-- Existing Feedback Cards will be dynamically added here using JavaScript -->
            </div>

            <script>
                // Sample feedback data (replace with actual data fetching logic)
                const feedbackData = [
                    { user: "John Doe", userId: "12345", message: "Lorem ipsum dolor sit amet, consectetur adipiscing elit." },

                    { user: "Akshay Komale", userId: "12345", message: "Lorem ipsum dolor sit amet, consectetur adipiscing elit." },

                    { user: "John Doe", userId: "12345", message: "Lorem ipsum dolor sit amet, consectetur adipiscing elit." },

                    { user: "John Doe", userId: "12345", message: "Lorem ipsum dolor sit amet, consectetur adipiscing elit." },

                    { user: "John Doe", userId: "12345", message: "Lorem ipsum dolor sit amet, consectetur adipiscing elit." },
                    // Add more feedback objects as needed
                ];

                // Function to add feedback cards based on the provided data
                function loadFeedbacks() {
                    const feedbackList = document.getElementById("feedbackList");

                    // Iterate through the feedback data and create feedback cards
                    feedbackData.forEach(feedback => {
                        const feedbackCard = document.createElement("div");
                        feedbackCard.className = "bg-white p-4 rounded shadow";

                        feedbackCard.innerHTML = `
                        <h3 class="text-xl font-bold mb-2">User: ${feedback.user}</h3>
                        <p class="text-gray-600 mb-2">User ID: ${feedback.userId}</p>
                        <p class="text-gray-700">${feedback.message}</p>
                    `;

                        // Append the feedback card to the feedbackList
                        feedbackList.appendChild(feedbackCard);
                    });
                }

                // Load feedbacks automatically when the page loads
                window.onload = loadFeedbacks;
            </script>
</body>

</html>