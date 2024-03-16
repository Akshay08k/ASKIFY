<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notifications - Askify</title>
    <link rel="shortcut icon" href="<?= base_url('/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/notification.css') ?>">
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
        <?php if (!empty ($allNotifications)): ?>
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
        <?php else: ?>
            <h2 align="center" class="no-notification">No notifications at this time Explore The Website..</h2>
        <?php endif; ?>

    </div>

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
    <script>
        function toggleReadNotifications() {
            let readNotifications = document.querySelectorAll('.readed-notification');
            let btn = document.querySelector('.read-btn');
            let footer = document.getElementById('main-footer');

            readNotifications.forEach(notification => {
                notification.style.display = (notification.style.display === "block" || notification.style.display === "") ? "none" : "block";
            });

            if (readNotifications[0].style.display === "block") {
                btn.textContent = "Readed Notifications ▼";
                footer.classList.remove('footer-opened');
            } else {
                btn.textContent = "Readed Notifications ▶";
                footer.classList.add('footer-opened');
            }
        }
    </script>
</body>

</html>