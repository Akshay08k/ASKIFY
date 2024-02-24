<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/footer.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
    <section class="profile">
        <div class="leftside">
            <div class="photocard">
                <div class="photo">
                    <?php foreach ($users as $user): ?>
                        <?php
                        $username = $user['username'];


                        $profilePhoto = $user['profile_photo'];


                        $profilePhotoBase64 = 'data:image/png;base64,' . base64_encode($profilePhoto);


                        ?>
                        <img src="<?= $profilePhotoBase64 ?>" alt="Profile Picture">
                    </div>
                    <div class="username">
                        <?= $user['username'] ?>
                    </div>
                    <div class="name">
                        <?= $user['name'] ?>
                    </div>
                    <div class="bio">
                        <?= $user['about'] ?>
                    </div>
                    <div class="detailscard">
                        <div class="gender">Gender:
                            <?= $user['gender'] ?>
                        </div>
                        <div class="location">Location:
                            <?= $user['location'] ?>
                        </div>
                        <div class="contact">Contact:
                            <?= $user['email'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rightside">
                <div class="counts">
                    <div class="follower">
                        <h3>Follower</h3>
                        <p>
                            <?= $totalFollowers ?>
                        </p>
                    </div>
                    <div class="following">
                        <h3>Following</h3>
                        <p>
                            <?= $totalFollowing ?>
                        </p>
                    </div>
                    <div class="likes">
                        <h3>Likes</h3>
                        <p>
                            <?= $totalLikes ?>
                        </p>
                    </div>
                </div>
                <div class="recent-categories">
                    <div class="categoriescard">
                        <?php foreach ($usercategory as $category): ?>
                            <div class="category-box">
                                <img src="data:image/jpeg;base64,<?= ($category['image']) ?>" alt="Category Image">
                                <div class="cat-name">
                                    <?= $category['name'] ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="recent-activity">
                        <div class="activity-box">
                            <h3 align="center">Recent Activity</h3>
                            <?php foreach ($recentActivity as $activity): ?>
                                <div class="activity-item">
                                    <div class="activity-type">
                                        <?= $activity['activity_type']; ?>
                                    </div>
                                    <div class="activity-timestamp">&nbsp;&nbsp;on
                                        <?= date('M d, Y h:i A', strtotime($activity['timestamp'])) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="links">
                    <a href="<?= $user['discordlink'] ?>" target="_blank">Discord</a>
                    <a href="<?= $user['instagram'] ?>" target=" _blank">Instagram</a>
                    <a href="<?= $user['twitter'] ?>" target="_blank">Twitter</a>
                    <a href="<?= $user['github'] ?>" target="_blank">GitHub</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
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

    <script src="<?= base_url('js/profile.js') ?>"></script>
</body>

</html>