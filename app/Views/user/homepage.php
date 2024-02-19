<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Homepage</title>
    <!-- Add your stylesheet link -->
    <link rel="stylesheet" href="<?= base_url('/css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/homepage.css') ?>">
    <link rel="shortcut icon"
        href="https://static.vecteezy.com/system/resources/previews/000/568/825/original/question-answer-icon-vector.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>
    <nav id="header">
        <div class="logo">
            <a href="/"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>
        </div>
        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search Question">
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
            <button id="askQuestionBtn">Ask Question</button>
            <button id="createPostBtn">Create Post</button>
        </div>
    </div>
    <div class="categorybox"></div>
    <div class="content"></div>
    <!-- Popup form for asking a question -->
    <div id="askQuestionPopup" class="popup">
        <h2>Ask a Question</h2>
        <form action="/submit_post" method="post" enctype="multipart/form-data">

            <?= csrf_field() ?>
            <label for="posttitle">Title:</label>
            <input type="text" id="posttitle" name="postTitle" required>

            <label for="postdesc">Description:</label>
            <textarea id="postdesc" name="postDescription" rows="4" required></textarea>

            <label for="postphoto">Upload Photo:</label>
            <input type="file" id="postphoto" name="postPhoto" accept="image/*">

            <label for="category">Category:</label>
            <select id="category" name="CategoryId" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>">
                        <?= $category['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Submit Question</button>
        </form>
        <button id="queclsbtn">Close</button>
    </div>

    <div id="createPostPopup" class="popup">
        <h2>Create Post</h2>
        <form action="/submit_question" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="QuestionTitle" required>

            <label for="desc">Content:</label>
            <textarea id="desc" name="QuestionDescription" required></textarea>
            <button type="submit">Create Post</button>

            <label for="category">Category:</label>
            <select id="category" name="CategoryId" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>">
                        <?= $category['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        <button id="postclsbtn">Close</button>
        <!-- Add this modal for reporting -->


    </div>
    <footer>
        <div class="foot-panel2">
            <div class="ul">
                <p>Get to know Us</p>
                <a href="">Blog</a>
                <a href="">About Askify</a>
            </div>


            <div class="ul">
                <p>Let Us Help you</p>

                <a>Use Of Askify </a>
                <a>Your Account</a>
                <a>Help</a>
                <a id="feedbackBtn">Feedback</a>
            </div>
        </div>
        <div class="foot-panel4">
            <div class="pages">
                <a href="#">Condition Of Use</a>
                <a href="#">Privacy And Notice</a>
                <a href="#">Your Ads Privacy Choice</a>
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