<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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

        <div class="flex-1 p-4">
            <h2 class="text-2xl font-bold mb-4">Handle Reported Issues</h2>

            <!-- Display reported issues dynamically -->
            <div class="bg-white p-4 shadow-md rounded-md">
                <h3 class="text-lg font-semibold mb-2">Reported Issues</h3>
                <ul id="issueList" class="list-disc ml-4">
                    <!-- Reported issues will be dynamically populated here -->
                </ul>
            </div>

            <!-- Include JavaScript -->
            <script>
                // Array to store reported issues with status
                const reportedIssues = [
                    { questionId: "123", description: "Inappropriate Language", status: "Open" },
                    { questionId: "456", description: "Offensive Content", status: "Open" },
                    // Add more reported issues as needed
                ];

                // Function to dynamically populate the issue list
                function populateIssueList() {
                    const issueList = document.getElementById('issueList');

                    // Clear existing content
                    issueList.innerHTML = '';

                    // Populate the list with reported issues
                    reportedIssues.forEach((issue, index) => {
                        const listItem = document.createElement('div');
                        listItem.innerHTML = `
                            <div class="flex justify-between items-center mb-2 p-4">
                              <div class="issue">
                              Question ID: ${issue.questionId}
                              <br>
                                ${issue.description} - Status: ${issue.status} 
                                </div>
                            <div>
                                    <button onclick="closeIssue(${index})" class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-600 mr-2">Resolve</button>
                                    <button onclick="deleteIssue(${index})" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">Delete</button>
                                </div>
                            </div>`;
                        issueList.appendChild(listItem);
                    });
                }

                // Function to close an issue
                function closeIssue(index) {
                    if (index >= 0 && index < reportedIssues.length) {
                        reportedIssues[index].status = 'Closed';
                        populateIssueList();
                    }
                }

                // Function to delete an issue
                function deleteIssue(index) {
                    if (index >= 0 && index < reportedIssues.length) {
                        reportedIssues.splice(index, 1);
                        populateIssueList();
                    }
                }

                // Call the function when the page loads
                document.addEventListener('DOMContentLoaded', () => {
                    populateIssueList(); // Initially load all reported issues
                });
            </script>
        </div>
    </div>

</body>

</html>