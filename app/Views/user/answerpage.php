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
        <div class="category-item">Lifestyle</div>
        <div class="category-item">Sports</div>
        <div class="category-item">E Sports</div>
        <div class="category-item">Bollywood</div>
        <div class="category-item">Tech & Science</div>
        <div class="category-item">Coding</div>
    </div>

    <div class="dropdown">
        <div class="dropdown-content">
            <div>Category</div>
            <div>Category</div>
            <div>Category</div>
            <div>Category</div>
            <div>Category</div>
            <div>Category</div>
            <div>Category</div>
            <div>Category</div>
        </div>
    </div>
    <main>
        <section class="content">
            <div class="post-box" id="questionDetailsContainer">
                <!-- Question details will be dynamically loaded here -->
            </div>

            <div class="answer-container">
                <!-- Answers will be dynamically loaded here -->
            </div>
        </section>

        <div class="answer-section">
            <textarea id="answerInput" placeholder="Type your answer here..."></textarea>
            <button class="button">Submit Answer</button>
        </div>
    </main>
    </main>



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
                            // Create and display the question box dynamically
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
            const { username, title, description, profile_photo } = data;

            const questionBox = document.createElement("div");
            questionBox.classList.add("post-box");

            const profileSection = document.createElement("div");
            profileSection.classList.add("profile-section");

            const profilePicture = document.createElement("div");
            profilePicture.classList.add("profile-picture");
            const img = document.createElement("img");
            if (profile_photo) {

                img.src = `data:image/png;base64,${profile_photo}`;
            } else {
                img.src = "path/to/default/profile/photo.jpg";
            }

            img.alt = "User Profile Picture";
            profilePicture.appendChild(img);

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

            // Question Description Section
            const descriptionSection = document.createElement("div");
            descriptionSection.classList.add("description-section");
            const descriptionElement = document.createElement("p");
            descriptionElement.textContent = description;
            descriptionSection.appendChild(descriptionElement);

            const postActions = document.createElement("div");
            postActions.classList.add("post-actions");

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
            questionBox.appendChild(postActions);
            questionBox.appendChild(shareButton);

            return questionBox;
        }

    </script>
    <script src="<?= base_url('js/answer.js') ?>"></script>
</body>

</html>