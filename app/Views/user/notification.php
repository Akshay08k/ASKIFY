<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notifications Page</title>
    <link rel="stylesheet" href="<?= base_url('css/notification.css') ?>">
    <link rel="shortcut icon"
        href="https://static.vecteezy.com/system/resources/previews/000/568/825/original/question-answer-icon-vector.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Work+Sans:wght@300&display=swap"
        rel="stylesheet">

</head>

<body>
    <nav>
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

    <div class="notifications">
        <?php foreach ($notifications as $notification): ?>
            <div class="notification">
                <div class="title">
                    <?= $notification['Recepient']; ?>
                </div>
                <div class="content"><a href="#">
                        <?= $notification['text']; ?>
                    </a></div>
                <img class="close-icon" src="<?= base_url('/images/notificationcancel.svg') ?>" alt="Close">
            </div>
        <?php endforeach; ?>

        <!-- Add more notifications here -->
    </div>
    <footer>
        <hr>
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
</body>

</html>