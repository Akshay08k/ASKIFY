<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/output.min.css') ?>">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            height: 500px;
            width: 500px;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .popup.show {
            display: block;
            opacity: 1;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="/"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>
            </div>
            <div class="search-box">
                <div class="search__container">
                    <input id="searchInput" class="search__input" type="text" placeholder="Search User Profile">

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
    </header>

    <div class="profilelinks">
        <button class="pfplinkbtn" onclick="window.location.href='/profile'">My Profile</button>
        <button class="pfplinkbtn" onclick="window.location.href='/profile/Myquestions'">My Questions & Answer</button>
        <button class="pfplinkbtn" onclick="window.location.href='/updateprofile'">Update Profile</button>
        <button class="pfplinkbtn" onclick="window.location.href='/updatecategory'">Update categories</button>
        <button class="pfplinkbtn" onclick="window.location.href='/logout'">Logout</button>
    </div>
    <?php if (isset($error)): ?>
        <div class="text-red-500 text-center">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <div class="cover">
        <div class="coverpage-img">
            <img src="<?= base_url('uploads/askifyCover.png') ?>" class="cover-img" alt="Cover Image">
            </img>
        </div>
        <?php foreach ($users as $user): ?>

            <div class="profile-img ">
                <img class="image border border-blue-500 " src="
            <?= base_url('/uploads/userprofilephotos/' . $user['profile_photo']) ?>" alt="Profile Image">
            </div>
        </div>
        <p class="text-center  username mb-10">
            <?= $user['name'] ?>

            <?php
            $gender = $user['gender'];

            if ($gender == 'Male') {
                echo '♂️';
            } elseif ($gender == 'Female') {
                echo '♀️';
            } else {
                echo '⚧';
            }
            ?>
        </p>
        <div class="main">
            <div class="counts">
                <div class="follower cursor-pointer" onclick="openPopup('followerPopup')">
                    <div class="circle" style="background: #ea4335;">
                        <?= $totalFollowers ?>
                    </div>
                    <div class="title">Follower</div>
                </div>

                <div class="following cursor-pointer" onclick="openPopup('followingPopup')">
                    <div class="circle" style="background: #3d993d;">
                        <?= $totalFollowing ?>
                    </div>
                    <div class="title">Following</div>
                </div>

                <div id="followerPopup" class="popup bg-white rounded-lg shadow-lg p-6 hidden ">
                    <!-- Close button -->
                    <h1 class="text-3xl mb-5">Followers</h1>
                    <hr>

                    <span onclick="closePopup('followerPopup')" class=" close-btn absolute top-2 right-2 cursor-pointer text-gray-600
                        hover:text-gray-800">&times;</span>
                    <?php foreach ($followingNames as $name) {
                        echo "<h3 class='text-lg font-semibold mb-2 mt-4'>" . $name . "</h3>";
                    } ?>
                </div>

                <div id="followingPopup" class="popup bg-white rounded-lg shadow-lg  hidden h-[400px] w-[300px]">
                    <!-- Close button -->
                    <h1 class="text-3xl mb-5">Follwing</h1>
                    <hr>
                    <span onclick="closePopup('followingPopup') " class=" close-btn absolute top-2 right-2 cursor-pointer text-gray-600
                        hover:text-gray-800">&times;</span>
                    <?php foreach ($followerNames as $name) {
                        echo "<h3 class='text-lg font-semibold mt-2 mb-2'>" . $name . "</h3>";
                    } ?>
                </div>

                <script>
                    function closePopup(id) {
                        var popup = document.getElementById(id);
                        if (popup) {
                            popup.classList.remove("show");
                            setTimeout(function () {
                                popup.style.display = "none";
                            }, 300); // Wait for the transition duration
                        }
                    }
                    function openPopup(id) {
                        var popup = document.getElementById(id);
                        if (popup) {
                            if (popup.style.display === "block") {
                                popup.classList.remove("show");
                                setTimeout(function () {
                                    popup.style.display = "none";
                                }, 300); // Wait for the transition duration
                            } else {
                                // Hide all popups before showing the current one
                                var popups = document.querySelectorAll(".popup");
                                popups.forEach(function (popup) {
                                    popup.classList.remove("show");
                                });
                                popup.style.display = "block";
                                // Trigger reflow to ensure display change takes effect
                                void popup.offsetWidth;
                                popup.classList.add("show");
                            }
                        }
                    }


                </script>

                <div class="likes">
                    <div class="circle" style="background: #1b72e7;">
                        <?= $totalLikes ?>
                    </div>
                    <div class="title">Likes </div>
                </div>
                <div class="likes">
                    <div class="circle" style="background: #ffb900;">
                        <?= $totalQuestionCount ?>
                    </div>
                    <div class="title">Questions </div>
                </div>
            </div>
            <section class="flex justify-center items-center flex-col mt-8">
                <div class="container-bio border rounded-lg ">
                    <h3 class="text-xl font-bold mb-4  text-gray-800">Bio</h3>
                    <p class="text-lg text-gray-700">
                        <?= $user['about'] ?>
                    </p>
                </div>
                <div class="container-about  rounded-lg  mt-10">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
                        <p class="text-lg text-left text-gray-700"><strong>Email:</strong> akshay@gmail.com</p>
                        <p class="text-lg text-left text-gray-700"><strong>Location:</strong> Ahmedabad</p>
                    </div>
                </div>
            </section>


            <hr class="mt-10">
            <section class="interested-cat flex flex-col items-center mt-8">
                <h2 class="text-2xl font-bold mb-4  text-blue-500 text-left">Interested Categories</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php foreach ($usercategory as $category): ?>
                        <div class="category-item flex items-center border rounded-lg p-4">
                            <img src="<?= base_url('uploads/categoryimages/' . $category['image']) ?>"
                                class="category-circle bg-green-500 h-12 w-12 rounded-full flex items-center justify-center text-white font-bold">

                            </img>
                            <p class="text-lg ml-2">
                                <?= $category['name'] ?>
                            </p>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
            <hr class="mt-10">


            <section class="recent-activity flex flex-col items-center mt-8">
                <h2 class="text-2xl font-bold mb-4 text-blue-500 text-left">Recent Activity</h2>

                <div class="flex mb-4">
                    <button id="showQuestions"
                        class="recent-activity-btn mr-4 border-b-2 border-transparent text-lg focus:outline-none">Questions</button>
                    <button id="showAnswers"
                        class="recent-activity-btn border-b-2 border-transparent text-lg focus:outline-none">Answers</button>
                </div>

                <div id="questionsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 p-20">
                    <?php foreach ($Question as $question): ?>
                        <div class="recent-activity-item flex flex-col items-center justify-center border rounded-lg p-2">
                            <p class="text-gray-700 font-bold text-xl">
                                <?php echo $question['title']; ?>
                            </p>
                            <p class="text-gray-700 text-xl mt-1">
                                <?php echo $question['description']; ?>
                            </p>
                        </div>
                    <?php endforeach; ?>



                </div>

                <div id="answersContainer" class=" grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 hidden">
                    <?php foreach ($Answer as $answer): ?>
                        <div class="recent-activity-item flex flex-col items-center justify-center border rounded-lg p-2">
                            <h3 class="text-xl font-bold mb-1">Provided an Answer</h3>
                            <p class="text-gray-700 text-xl">Description:
                                <?php echo $answer['answer']; ?>
                            </p>
                        </div>
                    <?php endforeach; ?>

                </div>
            </section>



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

    <?php endforeach; ?>

    <script src="<?= base_url('js/profile.js') ?>"></script>
</body>

</html>