<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderate Content</title>
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
                <h3 class="text-lg font-semibold mb-2 text-center">Question </h3>

                <div id="qaList">
                    <!-- Questions and answers will be dynamically populated here -->
                </div>
            </div>

            <!-- Include JavaScript -->
            <script>
                // Array to store questions and answers
                const qaList = [
                    { id: 1, title: 'How does JavaScript work?', description: "so i wanted to ask eveyone like how the actual javascript works like", answer: 'JavaScript is a scripting language...' },
                    { id: 2, title: 'What is the capital of France?', description: "now the france is very populated contry now i wanted to know itss capital like what is it?", answer: 'The capital of France is Paris.' },
                    // Add more questions and answers as needed
                ];

                // Predefined reasons for moderation
                const moderationReasons = [
                    'Inappropriate content',
                    'Spam',
                    'Irrelevant',
                    'Other (Specify in the text box)'
                ];

                // Function to dynamically populate the question and answer list
                function populateQAList(searchQuery = '', searchBy = 'title') {
                    const qaListElement = document.getElementById('qaList');

                    // Clear existing content
                    qaListElement.innerHTML = '';

                    // Filter questions based on the search query and search by criteria
                    const filteredQaList = qaList.filter(item =>
                        searchBy === 'title'
                            ? item.title.toLowerCase().includes(searchQuery.toLowerCase())
                            : String(item.id).includes(searchQuery)
                    );

                    // Create a template for appending questions
                    const questionTemplate = (item) => `
                        <div class="mb-4 p-4 bg-white shadow-md rounded-md flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Id : ${item.id}</h3>
                                <h3 class="text-lg font-semibold mb-2">Title : ${item.title}</h3>
                                <p class="text-gray-600 mb-4"><strong>Description : </strong>${item.description}</p>
                            </div>
                            <div class="flex items-center">
                                <select class="border p-1 rounded-md mr-2">
                                    ${moderationReasons.map(reason => `<option value="${reason}">${reason}</option>`).join('')}
                                </select>
                                <button class="bg-red-500 text-white px-2 py-1 ml-2 rounded-md hover:bg-red-600" onclick="handleModeration(${item.id}, this.previousElementSibling.value)">
                                    Delete/Hide
                                </button>
                            </div>
                        </div>
                    `;


                    // Append the template for each question
                    filteredQaList.forEach(item => {
                        qaListElement.innerHTML += questionTemplate(item);
                    });
                }


                // Function to handle question and answer moderation
                function handleModeration(qaId, selectedReason, customReason) {
                    // Ask for confirmation before deletion
                    const userConfirmation = confirm("Are you sure you want to delete this question?");

                    if (userConfirmation) {
                        const reason = selectedReason === 'Other (Specify in the text box)' ? customReason : selectedReason;
                        // Remove the question and answer from the list
                        const index = qaList.findIndex(item => item.id === qaId);
                        if (index !== -1) {
                            qaList.splice(index, 1);
                            populateQAList(); // Update the UI
                            console.log(`Question ID ${qaId} deleted. Reason: ${reason}`);
                        }
                    } else {
                        console.log(`Deletion canceled for Question ID ${qaId}`);
                    }
                }


                // Function to handle search input and dropdown change
                function handleSearchInput() {
                    const searchInput = document.getElementById('searchInput');
                    const searchBy = document.getElementById('searchBy').value;
                    populateQAList(searchInput.value, searchBy);
                }

                // Call the function when the page loads
                document.addEventListener('DOMContentLoaded', () => {
                    populateQAList(); // Initially load all questions
                    document.getElementById('searchInput').addEventListener('input', handleSearchInput);
                    document.getElementById('searchBy').addEventListener('change', handleSearchInput);
                });
            </script>
        </div>
    </div>

</body>

</html>