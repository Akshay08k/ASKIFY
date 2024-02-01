<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Homepage</title>
    <!-- Add your stylesheet link -->
    <link rel="stylesheet" href="<?= base_url('/css/homepage.css') ?>">
    <link rel="shortcut icon"
        href="https://static.vecteezy.com/system/resources/previews/000/568/825/original/question-answer-icon-vector.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Work+Sans:wght@300&display=swap"
        rel="stylesheet">
    <style>
        #header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c3e50;
            padding: 10px;
            color: #fff;
        }

        #header button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #header button:hover {
            background-color: #2980b9;
        }

        /* Styling for popups */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f9f9f9;
            z-index: 999;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            border-radius: 8px;
            text-align: center;
        }

        .popup h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .popup label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        #askQuestionBtn,
        #createPostBtn {
            width: 50%;
            padding: 10px;
            box-sizing: border-box;
            border: none;
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }

        #askQuestionBtn:hover,
        #createPostBtn:hover {
            background-color: #2980b9;
        }

        #askQuestionBtn {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        #createPostBtn {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .popup input,
        .popup textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            resize: none;
            border-radius: 4px;
        }

        .popup button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #2980b9;
        }

        .popup #closePopupBtn {
            background-color: #e74c3c;
        }

        .popup #closePopupBtn:hover {
            background-color: #c0392b;
        }

        .askingbtnbar {
            padding: 10px;
            border-radius: 5px;
            width: 900px;

            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
    </style>

</head>

<body>
    <nav id="header">
        <div class="logo">
            <a href="#"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>
        </div>
        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search">
            </div>
        </div>
        <ul>
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
                <div class="category-item">
                    <?= $category['name']; ?>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>


        <div class="dropdown">
            <div>More Categories</div>


            <div class="dropdown-content">
                <?php foreach ($categories as $category): ?>
                    <div>
                        <?= $category['name']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>



    <div class="content">
        <div class="askingbtnbar">
            <button id="askQuestionBtn">Create Post</button>
            <button id="createPostBtn">Ask Question</button>
        </div>

    </div>
    <!-- Popup form for asking a question -->
    <div id="askQuestionPopup" class="popup">
        <h2>Ask a Question</h2>
        <form action="/submit_post" method="post" enctype="multipart/form-data">
            <label for="posttitle">Title:</label>
            <input type="text" id="posttitle" name="postTitle" required>

            <label for="postdesc">Description:</label>
            <textarea id="postdesc" name="postDescription" rows="4" required></textarea>

            <label for="postphoto">Upload Photo:</label>
            <input type="file" id="postphoto" name="postPhoto">

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
        </form>
        <button id="postclsbtn">Close</button>
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
                <a>Feedback</a>
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
        function openPopup(popupId) {
            var popups = document.querySelectorAll('.popup');
            popups.forEach(function (popup) {
                popup.style.display = 'none';
            });

            // Open the specified popup
            document.getElementById(popupId).style.display = 'block';
        }

        document.getElementById('askQuestionBtn').addEventListener('click', function () {
            openPopup('askQuestionPopup');
        });

        document.getElementById('createPostBtn').addEventListener('click', function () {
            openPopup('createPostPopup');
        });


        document.getElementById('postclsbtn').addEventListener('click', function () {
            document.getElementById('createPostPopup').style.display = 'none';
        }); document.getElementById('queclsbtn').addEventListener('click', function () {
            document.getElementById('askQuestionPopup').style.display = 'none';
        });
    </script>
</body>

</html>