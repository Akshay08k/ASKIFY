<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/profile.css') ?>">

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
    <div id="liveSearchResults"></div>
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
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#searchInput').on('input', function () {
                    document.getElementById('liveSearchResults').style.display = "block"
                    var searchTerm = $(this).val();

                    if (searchTerm.length >= 3) {
                        $.ajax({
                            url: '/search/liveSearch',
                            type: 'post',
                            data: { searchTerm: searchTerm },
                            dataType: 'json',
                            success: function (data) {
                                // Clear previous results
                                $('#liveSearchResults').html('');

                                // Process and display the new results
                                if (data.length > 0) {
                                    $.each(data, function (index, user) {
                                        // Customize the display based on your need
                                        var userDiv = $('<div class="profile-link" data-userid="' + user.id + '">' + user.name + '</div>');
                                        $('#liveSearchResults').append(userDiv);

                                        // Add click event to redirect to profile
                                        userDiv.on('click', function () {
                                            window.location.href = '/visitprofile/' + user.id;
                                        });
                                    });
                                } else {
                                    $('#liveSearchResults').html('<div>No Users found</div>');
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                });
            });

        </script>
    </body>
<?php endforeach; ?>

</html>