<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderate Content</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->

    <link href="<?= base_url('css/output.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/sidebar.css') ?>" rel="stylesheet">

</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex h-screen bg-gray-200">
        <div id="sidebar" class="fixed top-0 left-0">
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

        <!-- Main Content -->
        <div class="flex-1 p-4 ml-64">
            <h2 class="text-2xl font-bold mb-4">Moderate Content</h2>

            <!-- Search Box and Dropdown -->
            <div class="flex mb-4">
                <div class="mr-4 w-1/3">
                    <input type="text" id="searchInput" placeholder="Search" class="border w-full p-2 rounded-md">
                </div>
                <div>
                    <select id="searchBy" class="border p-2 rounded-md">
                        <option value="title">Search by Title</option>
                        <option value="id">Search by ID</option>
                    </select>
                </div>
            </div>

            <!-- List of Questions and Answers -->
            <div class="bg-white p-4 shadow-md rounded-md">
                <h3 class="text-lg font-semibold mb-2 text-center">Question</h3>

                <div id="qaList">
                    <!-- Questions and answers will be dynamically populated here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script>
        const moderationReasons = [
            'Inappropriate content',
            'Spam',
            'Irrelevant',
            'Other (Specify in the text box)'
        ];

        // Function to dynamically populate the question and answer list
        function populateQAList(questions, searchQuery = '', searchBy = 'title') {
            const qaListElement = document.getElementById('qaList');

            // Clear existing content
            qaListElement.innerHTML = '';
            if (questions && questions.length > 0) {
                // Filter questions based on the search query and search by criteria
                const filteredQaList = questions.filter(item =>
                    searchBy === 'title'
                        ? item.title.toLowerCase().includes(searchQuery.toLowerCase())
                        : String(item.id).includes(searchQuery)
                );

                // Create a template for appending questions
                const questionTemplate = (item) => `
            <div class="mb-4 p-4 bg-white border rounded-md flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Id : ${item.id}</h3>
                    <h3 class="text-lg font-semibold mb-2">Title : ${item.title}</h3>
                    <p class="text-gray-600 mb-2"><strong>Description : </strong>${item.description}</p>
                    <p class="text-gray-600 mb-4"><strong>User : </strong>${item.name} -> id : ${item.user_id}</p>
                </div>
                <div class="flex items-center">
                    <select class="border p-1 rounded-md mr-2">
                        ${moderationReasons.map(reason => `<option value="${reason}">${reason}</option>`).join('')}
                    </select>
                    <button class="bg-red-500 text-white px-2 py-1 ml-2 rounded-md hover:bg-red-600" onclick="handleModeration(${item.id}, this.previousElementSibling.value, '${item.title}',${item.user_id})">
                        Delete/Hide
                    </button>
                </div>
            </div>
        `;

                filteredQaList.forEach(item => {
                    qaListElement.innerHTML += questionTemplate(item);
                });
            } else {
                // Handle the case when there are no questions
                qaListElement.innerHTML = '<p>No questions found.</p>';
            }
        }

        // Function to handle question and answer moderation
        async function handleModeration(qaId, selectedReason, title, userId) {
            // Ask for confirmation before deletion

            const userConfirmation = confirm("Are you sure you want to delete this question?");

            if (userConfirmation) {
                const reason = selectedReason === 'Other (Specify in the text box)' ? customReason : selectedReason;

                // Perform moderation action, e.g., send a request to the server
                await updateQuestionStatus(qaId, reason, title, userId);

                // console.log(`Moderation action for Question ID ${qaId}. Reason: ${reason}`);
            } else {
                // console.log(`Moderation action canceled for Question ID ${qaId}`);
            }
        }

        // Function to update question status on the server
        async function updateQuestionStatus(qaId, reason, title, userId) {
            try {
                const bodyData = {
                    qaId,
                    reason,
                    title,
                    userId,
                };

                // console.log(bodyData); // Log the data to check values

                const response = await fetch('/admin/updateQuestionStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(bodyData),
                });

                if (!response.ok) {
                    throw new Error(`Failed to update question status: ${response.status}`);
                }

                // console.log(`Question ID ${qaId} status updated successfully. Reason: ${reason} userId ${userId}`);
            } catch (error) {
                console.error('Error updating question status:', error);
            }
        }

        // Function to handle search input and dropdown change
        function handleSearchInput(questions) {
            const searchInput = document.getElementById('searchInput');
            const searchBy = document.getElementById('searchBy').value;
            populateQAList(questions, searchInput.value, searchBy);
        }

        // Fetch question data from the /homepage/getQuestions endpoint
        async function fetchQuestions() {
            try {
                const response = await fetch('/homepage/getQuestions');
                if (!response.ok) {
                    throw new Error(`Failed to fetch questions: ${response.status}`);
                }
                const data = await response.json();

                // Filter out questions where Hidden is equal to 1
                const filteredQuestions = (data || []).filter(data => data.Hidden != 1);

                populateQAList(filteredQuestions); // Initially load non-hidden questions

                document.getElementById('searchInput').addEventListener('input', () => handleSearchInput(filteredQuestions));
                document.getElementById('searchBy').addEventListener('change', () => handleSearchInput(filteredQuestions));
            } catch (error) {
                console.error('Error fetching questions:', error);
            }
        }



        // Call the function to fetch questions when the page loads
        document.addEventListener('DOMContentLoaded', fetchQuestions);

    </script>
    </div>
    </div>

</body>

</html>