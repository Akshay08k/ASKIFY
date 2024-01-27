<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Answer </title>
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
            <li><a href="#home">Home</a></li>
            <li><a href="#about">Notification</a></li>
            <li><a href="#services">Messages</a></li>
            <li><a href="#contact">Profile</a></li>
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

    <!-- Dropdown for additional categories -->
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
    </div>
    <main>
        <section class="content">
            <div class="post-box">
                <!-- User Profile Section -->
                <div class="profile-section">
                    <div class="profile-picture">
                        <img src="/User/CategoryByView/nycto.jpg" alt="User Profile Picture">
                    </div>
                    <p>User Profile</p>
                    <!-- Add user profile information here -->
                </div>

                <!-- Question Description Section -->
                <div class="description-section">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ipsa adipisci officia
                        accusantium
                        nam minima eligendi, dolores itaque asperiores. In ullam nesciunt reprehenderit commodi
                        suscipit,
                        tempore consequuntur quidem eos tenetur.
                    </p>
                </div>

                <!-- Like and Answer Buttons -->
                <div class="post-actions">
                    <!-- Like button with heart icon -->
                    <button class="like-button" onclick="toggleLike()">

                    </button>
                </div>
            </div>



            <!-- Display Submitted Answers -->

        </section>
        <div class="answer-section">
            <textarea id="answerInput" placeholder="Type your answer here..."></textarea>
            <button class="button">Submit Answer</button>
        </div>


    </main>

</body>

</html>