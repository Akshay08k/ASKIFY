<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Homepage</title>
    <link rel="stylesheet" href="<?= base_url('/css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/footer.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="<?= base_url('/css/homepage.css') ?>">
    <link rel="shortcut icon"
        href="https://static.vecteezy.com/system/resources/previews/000/568/825/original/question-answer-icon-vector.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <nav id="header">
        <div class="logo">
            <a href="/"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>
        </div>
        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search Question" id="searchInput">
                <div id="liveSearchResults"></div>
            </div>
        </div>
        <ul class="navlink">
            <li><a href="/homepage">Home</a></li>
            <li><a href="/notification">Notification</a></li>
            <li><a href="/messages">Messages</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    </nav>
    <div class="categories">
        <?php
        $desiredCategoryIds = [18, 19, 20, 21, 22];
        ?>
        <?php foreach ($categories as $category): ?>
            <?php if (in_array($category['id'], $desiredCategoryIds)): ?>
                <div class="category-item" onclick="logCategoryId(<?= $category['id']; ?>)">
                    <?= $category['name']; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="dropdown">
            <div>More Categories</div>
            <div class="dropdown-content">
                <?php foreach ($categories as $category): ?>
                    <div onclick="logCategoryId(<?= $category['id']; ?>)">
                        <?= $category['name']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="center">
        <div id="reportModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeReportModal()">&times;</span>
                <h2>Report Question</h2>
                <textarea id="reportReason" placeholder="Enter your reason for reporting..."></textarea>
                <button onclick="submitReport()" class="submit-btn">Submit Report</button>
            </div>
        </div>
        <div id="feedbackPopup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closeFeedbackPopup()">&times;</span>
                <h2>Feedback</h2>
                <textarea id="feedbackText" placeholder="Enter your feedback..."></textarea>
                <button onclick="submitFeedback()">Submit Feedback</button>
            </div>
        </div>
        <div class="askingbtnbar">
            <button id="askQuestionBtn">Create Post</button>
            <button id="createPostBtn">Ask Question</button>
        </div>
    </div>
    <div class="categorybox"></div>
    <div class="content"></div>
    <!-- Popup form for asking a question -->
    <div id="askQuestionPopup" class="popup p-6 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-bold mb-4">Create Post</h2>
        <form action="/submit_post" method="post" enctype="multipart/form-data" class="space-y-4">

            <?= csrf_field() ?>

            <label for="posttitle" class="block text-sm font-medium text-gray-700">Title:</label>
            <input type="text" id="posttitle" name="postTitle" required
                class="border p-2 w-full rounded-md focus:outline-none focus:ring focus:border-blue-300">

            <label for="postphoto" class="block text-sm font-medium text-gray-700">Upload Photo:</label>
            <input type="file" id="postphoto" name="postPhoto" accept="image/*"
                class="border p-2 w-full rounded-md focus:outline-none focus:ring focus:border-blue-300">

            <label for="category" class="block text-sm font-medium text-gray-700">Category:</label>
            <select id="category" name="CategoryId" required
                class="border p-2 w-full rounded-md focus:outline-none focus:ring focus:border-blue-300">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>">
                        <?= $category['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                Submit Question
            </button>
        </form>
        <button id="queclsbtn" class="mt-4 absolute right-0 top-0 px-4 py-2 ">
            &times;
        </button>
    </div>

    <div id="createPostPopup" class="popup p-6 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-bold mb-4">Ask Question</h2>
        <form action="/submit_question" method="post" class="space-y-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
            <input type="text" id="title" name="QuestionTitle" required
                class="border p-2 w-full rounded-md focus:outline-none focus:ring focus:border-blue-300">

            <label for="desc" class="block text-sm font-medium text-gray-700">Content:</label>
            <textarea id="desc" name="QuestionDescription" required
                class="border p-2 w-full rounded-md focus:outline-none focus:ring focus:border-blue-300"></textarea>

            <label for="category" class="block text-sm font-medium text-gray-700">Category:</label>
            <select id="category" name="CategoryId" required
                class="border p-2 w-full rounded-md focus:outline-none focus:ring focus:border-blue-300">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>">
                        <?= $category['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                Create Post
            </button>

        </form>
        <button id="postclsbtn" class="mt-4 absolute right-0 top-0 px-4 py-2 ">
            &times;
        </button>
    </div>

    <footer>
        <div class="foot-panel2">
            <div class="ul">
                <p>Get to know Us</p>
                <a href="/useofaskify">About Askify</a>
            </div>
            <div class="ul">
                <p>Use Of Askify </p>
                <a href="/profile">Your Account</a>
                <a href="/help">Help</a>
                <a id="feedbackBtn">Feedback</a>
            </div>
        </div>
        <div class="foot-panel4">
            <div class="pages">
                <a href="/content-policy">Content Policy</a>
                <a href="/privacy">Privacy And Notice</a>
            </div>
            <div class="copy">©2023, Askify, Inc. or its affiliates</div>
        </div>
    </footer>

    <script src="<?= base_url('/js/homepage.js') ?>"></script>
    <script>
        // Open Feedback Popup
        document.getElementById('feedbackBtn').addEventListener('click', openFeedbackPopup);

        // Close Feedback Popup
        function closeFeedbackPopup() {
            document.getElementById('feedbackPopup').style.display = 'none';
        }

        // Open Feedback Popup
        function openFeedbackPopup() {
            document.getElementById('feedbackPopup').style.display = 'block';
        }

        // Submit Feedback (You can replace this function with your actual submission logic)
        function submitFeedback() {
            const feedbackText = document.getElementById('feedbackText').value;
            alert('Feedback submitted: ' + feedbackText);
            closeFeedbackPopup();
        }

    </script>

</body>

</html>