<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">
</head>

<body>

    <header>
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

    </header>

    <main>

        <section id="profile">
            <?php foreach ($users as $user): ?>
                <?php
                $username = $user['username'];


                $profilePhoto = $user['profile_photo'];


                $profilePhotoBase64 = 'data:image/png;base64,' . base64_encode($profilePhoto);


                ?>
                <img src="<?= $profilePhotoBase64 ?>" alt="Profile Photo">
                <p class="username">
                    <?= $user['username'] ?>
                </p>
                <p><strong>
                        <?= $user['name'] ?>
                    </strong></p>
                <p>
                    <?= $user['email'] ?>
                </p>
                <p>IP:
                    <?= $user['signup_ip'] ?>
                </p>
            </section>


            <section id="details">
                <h2>Details</h2>
                <div class="ul">
                    <li><strong>Gender:</strong>
                        <?= $user['gender'] ?>
                    </li>
                    <li><strong>Bio:</strong>
                        <?= $user['about'] ?>
                    </li>
                    <li><strong>Categories:</strong>
                        <?= $user['categories'] ?>
                    </li>
                </div>
            </section>

            <section id="stats">
                <h2>Stats</h2>
                <div>
                    <li>Total Followers:
                        <?= $totalFollowers ?>
                    </li>
                    <li>Total Following:
                        <?= $totalFollowing ?>
                    </li>
                    <li>Total Liked Questions:
                        <?= $totalLikes ?>
                    </li>
                    <?php
                    $totalAllAnswersLikes = array_sum($totalAnswerLikes);
                    ?>
                    <li>Total Liked Answers:
                        <?= $totalAllAnswersLikes ?>
                    </li>
                    </ul>
            </section>

            <section id="recent-activity">
                <h2>Recent Activity</h2>
                <div class="recent-activity">
                    <?php foreach ($recentActivity as $activity): ?>
                        <li>
                            <?= $activity['activity_type']; ?> on
                            <?= $activity['timestamp']; ?>
                        </li>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php endforeach; ?>

    </main>
    <section id="links">
        <a href="https://discord.com" target="_blank">Discord</a>
        <a href="https://instagram.com" target="_blank">Instagram</a>
        <a href="https://linkedin.com" target="_blank">LinkedIn</a>
        <a href="https://github.com" target="_blank">GitHub</a>

    </section>
    <footer>
        <div class="foot-panel1">Back To Top</div>
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