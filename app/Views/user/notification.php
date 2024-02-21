<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notifications Page</title>
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/notification.css') ?>">
    <!-- <link rel="stylesheet" href="<?= base_url('css/footer.css') ?>"> -->
    <link rel="shortcut icon"
        href="https://static.vecteezy.com/system/resources/previews/000/568/825/original/question-answer-icon-vector.jpg">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="/"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>

        </div>
        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search Notification">
            </div>

        </div>
        <ul class="navlink">
            <li><a href="/homepage">Home</a></li>
            <li><a href="/notification">Notification</a></li>
            <li><a href="/messages">Messages</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    </nav>

    <div class="notifications">
        <?php foreach ($PlatFromUpdates as $notification): ?>
            <form action="<?= base_url('notification/markAsSeen/' . $notification['id']) ?>" method="post">
                <div class="notification">
                    <div class="content">
                        <strong>Update : </strong>
                        <?= $notification['text']; ?>
                    </div>
                    <button type="submit" class="close-btn" name="mark_seen">
                        <img src="<?= base_url('/images/notificationcancel.svg') ?>" alt="Close" class="cancelimg">
                    </button>

                </div>
            </form>
        <?php endforeach; ?>
        <?php foreach ($allNotifications as $notification): ?>
            <form action="<?= base_url('notification/markAsSeen/' . $notification['id']) ?>" method="post">
                <div class="notification">
                    <div class="content">
                        <?= $notification['text']; ?>
                    </div>
                    <button type="submit" class="close-btn" name="mark_seen">
                        <img src="<?= base_url('/images/notificationcancel.svg') ?>" alt="Close" class="cancelimg">
                    </button>
                </div>
            </form>
        <?php endforeach; ?>
        <div class="custom-read-notifications-dropdown">
            <h3 class="custom-dropdown-header"><button class="read-btn" onclick="toggleReadNotifications()">Readed
                    Notifications ▼</button>
            </h3>
            <div class="custom-read-notifications-content" id="readNotifications">
                <?php foreach ($readNotifications as $notification): ?>
                    <div class="readed-notification">
                        <div class="content">
                            <?= $notification['text']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- JavaScript for toggle and animation -->
        <script>
            function toggleReadNotifications() {
                let readNotifications = document.querySelectorAll('.readed-notification');
                let btn = document.querySelector('.read-btn');

                readNotifications.forEach(notification => {
                    notification.style.display = (notification.style.display === "block" || notification.style.display === "") ? "none" : "block";
                });
                btn.textContent = `Readed Notifications ${readNotifications[0].style.display === "block" ? "▶" : "▼"}`;
            }
        </script>



    </div>





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