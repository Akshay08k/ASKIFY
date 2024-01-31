<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Answer Page</title>
    <link rel="stylesheet" href="<?= base_url('css/answerpage.css') ?>">

</head>

<body>

    <nav>
        <div class="logo">
            <a href="#"> <img src="<?= base_url('images/logo.png') ?>" alt="Logo" width="100"></a>
        </div>

        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search">
            </div>
        </div>

        <ul>
            <li><a href="/home">Home</a></li>
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

    <main>
        <div class="content">

        </div>


        <div class="answer-textbox">
            <textarea id="answerInput" placeholder="Type your answer here..."></textarea>
            <button class="button">Submit Answer</button>
        </div>

    </main>
    <div class="answer-container">

    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const questionId = urlParams.get('id');

            if (questionId) {
                fetch("/homepage/getQuestions")
                    .then((response) => response.json())
                    .then((questions) => {
                        const selectedQuestion = questions.find(question => question.id === questionId);

                        if (selectedQuestion) {
                            const questionBox = createQuestionBox(selectedQuestion);
                            const questionContainer = document.querySelector(".content");
                            questionContainer.appendChild(questionBox);
                        } else {
                            console.error('Question not found with the specified ID.');
                        }
                    })
                    .catch((error) => console.error("Error fetching questions:", error));
            } else {
                console.error('Question ID not found in the URL.');
            }
        });

        function createQuestionBox(data) {
            const { username, title, description, profile_photo, likes, id } = data;

            const questionBox = document.createElement("div");
            questionBox.classList.add("post-box");

            // Profile Section
            const profileSection = document.createElement("div");
            profileSection.classList.add("profile-section");

            // Profile Picture
            const profilePicture = document.createElement("div");
            profilePicture.classList.add("profile-picture");
            const img = document.createElement("img");
            if (profile_photo) {
                img.src = `data:image/png;base64,${profile_photo}`;
            } else {
                img.src = "path/to/default/profile/photo.jpg";
            }
            img.alt = "User";
            profilePicture.appendChild(img);

            // Profile Name
            const profileName = document.createElement("p");
            profileName.textContent = username;

            profileSection.appendChild(profilePicture);
            profileSection.appendChild(profileName);

            // Title Section
            const titleSection = document.createElement("div");
            titleSection.classList.add("title-section");
            const titleElement = document.createElement("h3");
            titleElement.textContent = title;
            titleSection.appendChild(titleElement);

            // Description Section
            const descriptionSection = document.createElement("div");
            descriptionSection.classList.add("description-section");
            const descriptionElement = document.createElement("p");
            descriptionElement.textContent = description;
            descriptionSection.appendChild(descriptionElement);


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
                    })
                    .catch((error) => console.error("Error updating like count:", error));
            });
            const likeCount = document.createElement("span");
            likeCount.classList.add("heart-count");
            likeCount.textContent = likes;
            likeSection.appendChild(likeButton);
            likeSection.appendChild(likeCount);

            // Post Actions Section


            // Share Button
            const shareButton = document.createElement("div");
            shareButton.classList.add("share-button");
            const shareBtn = document.createElement("img");
            shareBtn.src = "https://cdn2.iconfinder.com/data/icons/line-drawn-social-media/31/share-1024.png";
            shareBtn.height = 30;
            shareBtn.width = 30;
            shareButton.appendChild(shareBtn);

            // Append all sections to the question box
            questionBox.appendChild(profileSection);
            questionBox.appendChild(titleSection);
            questionBox.appendChild(descriptionSection);
            questionBox.appendChild(likeSection);
            questionBox.appendChild(shareButton);

            return questionBox;
        }

    </script>
    <script src="<?= base_url('js/answer.js') ?>"></script>
</body>

</html>