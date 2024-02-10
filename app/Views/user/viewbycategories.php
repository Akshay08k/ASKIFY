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
        .main-categorybox {
            width: 870px;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            text-align: center;
            display: flex;
            justify-content: center;
        }

        .category-box {
            display: flex;
            align-items: center;
        }

        .category-pic {
            height: 100px;
            width: 100px;
        }

        .category-info {
            margin-left: 10px;
            text-align: left;
        }

        .category-name {
            font-size: 1.2em;
            font-weight: bold;
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
    <section class="center">
        <div class="main-categorybox">
            <div class="category-box">
                <img src="https://th.bing.com/th/id/OIP.jQ-gdKHf6ohSewWt4kWlpgHaGo?rs=1&pid=ImgDetMain.jpg"
                    alt="Category Pic" class="category-pic">
                <div class="category-info">
                    <div class="category-name">Category Name</div>

                </div>
            </div>
        </div>
    </section>



    <section class="content">
    </section>

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

    <script>function createQuestionBox(data) {
            const { name, title, description, profile_photo, likes, id } = data;

            const questionBox = document.createElement("div");
            questionBox.classList.add("post-box");

            const profileSection = document.createElement("div");
            profileSection.classList.add("profile-section");

            const profilePicture = document.createElement("div");
            profilePicture.classList.add("profile-picture");
            const img = document.createElement("img");

            const likeSection = document.createElement("div");
            likeSection.classList.add("like-section");
            const likeButton = document.createElement("div");
            likeButton.classList.add("heart-like-button");
            likeButton.addEventListener("click", function () {
                // Toggle the 'liked' class for styling
                likeButton.classList.toggle("liked");

                // Update like count within the current question box
                const likeCount = questionBox.querySelector(".heart-count");
                const currentLikes = parseInt(likeCount.textContent);

                // Determine the new like count based on the 'liked' class
                const newLikes = likeButton.classList.contains("liked")
                    ? currentLikes + 1
                    : currentLikes - 1;

                // Update the displayed like count
                likeCount.textContent = newLikes;

                // Send a request to the server to update the like count in the database
                fetch(
                    `/homepage/updateLikeCount/${id}/${likeButton.classList.contains("liked") ? "true" : "false"
                    }`,
                    { method: "POST" }
                )
                    .then((response) => response.json())
                    .then((updatedLikes) => {
                        // You can handle the response if needed
                        // console.log("Updated likes in the database:", updatedLikes);
                        //printing the status of like did or not in database
                    })
                    .catch((error) => console.error("Error updating like count:", error));
            });
            const likeCount = document.createElement("span");
            likeCount.classList.add("heart-count");
            likeCount.textContent = likes;
            likeSection.appendChild(likeButton);
            likeSection.appendChild(likeCount);

            if (profile_photo) {
                img.src = `data:image/png;base64,${profile_photo}`;
            }
            img.alt = "User";
            profilePicture.appendChild(img);

            const profileName = document.createElement("p");
            profileName.textContent = name;

            profileSection.appendChild(profilePicture);
            profileSection.appendChild(profileName);

            // Title Section
            const titleSection = document.createElement("div");
            titleSection.classList.add("title-section");
            const titleElement = document.createElement("h3");
            titleElement.textContent = title;
            titleSection.appendChild(titleElement);

            // Question Description Section
            const descriptionSection = document.createElement("div");
            descriptionSection.classList.add("description-section");
            const descriptionElement = document.createElement("p");
            descriptionElement.textContent = description;
            descriptionSection.appendChild(descriptionElement);

            const postActions = document.createElement("div");
            postActions.classList.add("post-actions");
            const answerButton = document.createElement("button");
            // Assuming 'public' is the base directory for your assets
            const imageUrl = "/images/answer.png";
            answerButton.innerHTML = `<img src="${imageUrl}" class="ans-img">`;

            answerButton.classList.add("ans-btn");

            answerButton.addEventListener("click", function () {
                // Redirect to the answers page with the question ID as a query parameter
                window.location.href = `/answers?id=${id}`;
            });

            postActions.appendChild(answerButton);

            const shareButton = document.createElement("div");
            shareButton.classList.add("share-button");
            const shareBtn = document.createElement("img");
            shareBtn.src =
                "https://cdn2.iconfinder.com/data/icons/line-drawn-social-media/31/share-1024.png";
            shareBtn.height = 30;
            shareBtn.width = 30;

            shareButton.appendChild(shareBtn);

            // Append all sections to the question box
            questionBox.appendChild(profileSection);
            questionBox.appendChild(titleSection);
            questionBox.appendChild(likeSection);
            questionBox.appendChild(postActions);
            questionBox.appendChild(descriptionSection);
            questionBox.appendChild(postActions);
            questionBox.appendChild(shareButton);
            questionBox.appendChild(likeCount);

            return questionBox;
        }

        function logCategoryId(categoryId) {
            const questionContainer = document.querySelector(".content");

            // Fetch all questions from the server
            fetch("/homepage/getQuestions")
                .then((response) => response.json())
                .then((questions) => {
                    console.log("Fetched Questions:", questions);

                    // Filter questions based on the desired categoryId
                    const filteredQuestions = questions.filter(question => question.category_id == categoryId);

                    console.log("Filtered Questions:", filteredQuestions);

                    // Clear the existing questions in the container
                    questionContainer.innerHTML = "";

                    // Iterate through filtered questions and create question boxes
                    filteredQuestions.forEach((questionData) => {
                        const questionBox = createQuestionBox(questionData);
                        questionContainer.appendChild(questionBox);
                    });
                })
                .catch((error) => console.error("Error fetching questions:", error));
        }


    </script>
</body>

</html>