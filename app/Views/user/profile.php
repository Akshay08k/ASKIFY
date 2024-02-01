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
                    <div class="buttons">
                        <button class="btns">Follow</button>
                        <button class="btns">Message</button>
                    </div>
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
                        <?php
                        $totalAllAnswersLikes = array_sum($totalAnswerLikes);
                        ?>
                        <p>
                            <?= $totalAllAnswersLikes ?>
                        </p>
                    </div>
                </div>
                <div class="recent-categories">
                    <div class="categoriescard">
                        <div class="category-box">
                            <img src="https://th.bing.com/th/id/R.e6ce8460228ea953a87b55536d59396c?rik=oKNP0dHxJW%2bGgg&riu=http%3a%2f%2fclipart-library.com%2fnew_gallery%2f224-2241024_science-icon-science-logo-png-black.png&ehk=wdSHfdRQx7H3qEYq%2f3ygBaAlwG45J87OFUSlYn3YzJc%3d&risl=&pid=ImgRaw&r=0"
                                alt="Category Image">
                            <div class="name">Category Name</div>
                        </div>
                        <div class="category-box">
                            <img src="https://th.bing.com/th/id/R.e6ce8460228ea953a87b55536d59396c?rik=oKNP0dHxJW%2bGgg&riu=http%3a%2f%2fclipart-library.com%2fnew_gallery%2f224-2241024_science-icon-science-logo-png-black.png&ehk=wdSHfdRQx7H3qEYq%2f3ygBaAlwG45J87OFUSlYn3YzJc%3d&risl=&pid=ImgRaw&r=0"
                                alt="Category Image">
                            <div class="name">Category Name</div>
                        </div>
                        <div class="category-box">
                            <img src="https://th.bing.com/th/id/R.e6ce8460228ea953a87b55536d59396c?rik=oKNP0dHxJW%2bGgg&riu=http%3a%2f%2fclipart-library.com%2fnew_gallery%2f224-2241024_science-icon-science-logo-png-black.png&ehk=wdSHfdRQx7H3qEYq%2f3ygBaAlwG45J87OFUSlYn3YzJc%3d&risl=&pid=ImgRaw&r=0"
                                alt="Category Image">
                            <div class="name">Category Name</div>
                        </div>
                        <div class="category-box">
                            <img src="https://th.bing.com/th/id/R.e6ce8460228ea953a87b55536d59396c?rik=oKNP0dHxJW%2bGgg&riu=http%3a%2f%2fclipart-library.com%2fnew_gallery%2f224-2241024_science-icon-science-logo-png-black.png&ehk=wdSHfdRQx7H3qEYq%2f3ygBaAlwG45J87OFUSlYn3YzJc%3d&risl=&pid=ImgRaw&r=0"
                                alt="Category Image">
                            <div class="name">Category Name</div>
                        </div>
                        <div class="category-box">
                            <img src="https://th.bing.com/th/id/R.e6ce8460228ea953a87b55536d59396c?rik=oKNP0dHxJW%2bGgg&riu=http%3a%2f%2fclipart-library.com%2fnew_gallery%2f224-2241024_science-icon-science-logo-png-black.png&ehk=wdSHfdRQx7H3qEYq%2f3ygBaAlwG45J87OFUSlYn3YzJc%3d&risl=&pid=ImgRaw&r=0"
                                alt="Category Image">
                            <div class="name">Category Name</div>
                        </div>
                        <div class="category-box">
                            <img src="https://th.bing.com/th/id/R.e6ce8460228ea953a87b55536d59396c?rik=oKNP0dHxJW%2bGgg&riu=http%3a%2f%2fclipart-library.com%2fnew_gallery%2f224-2241024_science-icon-science-logo-png-black.png&ehk=wdSHfdRQx7H3qEYq%2f3ygBaAlwG45J87OFUSlYn3YzJc%3d&risl=&pid=ImgRaw&r=0"
                                alt="Category Image">
                            <div class="name">Category Name</div>
                        </div>
                        <div class="category-box">
                            <img src="https://th.bing.com/th/id/R.e6ce8460228ea953a87b55536d59396c?rik=oKNP0dHxJW%2bGgg&riu=http%3a%2f%2fclipart-library.com%2fnew_gallery%2f224-2241024_science-icon-science-logo-png-black.png&ehk=wdSHfdRQx7H3qEYq%2f3ygBaAlwG45J87OFUSlYn3YzJc%3d&risl=&pid=ImgRaw&r=0"
                                alt="Category Image">
                            <div class="name">Category Name</div>
                        </div>
                        <div class="category-box">
                            <img src="https://th.bing.com/th/id/R.e6ce8460228ea953a87b55536d59396c?rik=oKNP0dHxJW%2bGgg&riu=http%3a%2f%2fclipart-library.com%2fnew_gallery%2f224-2241024_science-icon-science-logo-png-black.png&ehk=wdSHfdRQx7H3qEYq%2f3ygBaAlwG45J87OFUSlYn3YzJc%3d&risl=&pid=ImgRaw&r=0"
                                alt="Category Image">
                            <div class="name">Category Name</div>
                        </div>
                    </div>
                    <div class="recent-activity">
                        <div class="activity-box">
                            <h3 align="center">
                                Recent activity
                            </h3>
                            <?php foreach ($recentActivity as $activity): ?>
                                <li>
                                    <?= $activity['activity_type']; ?> on
                                    <?= $activity['timestamp']; ?>
                                </li>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="links">
                    <a href="
                        <?= $user['discordlink'] ?>" target="_blank">Discord</a>
                    <a href="
                        <?= $user['instagram'] ?> target=" _blank">Instagram</a>
                    <a href="
                        <?= $user['twitter'] ?>" target="_blank">Twitter</a>
                    <a href="
                        <?= $user['github'] ?>" target="_blank">GitHub</a>
                </div>
            </div>
        </section>
    </body>
<?php endforeach; ?>

</html>