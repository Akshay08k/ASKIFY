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
        <h1>User Profile</h1>
    </header>

    <main>

        <section id="profile">
            <?php foreach ($users as $user): ?>
                <?php
                $username = $user['username'];


                $allowedExtensions = ['jpg', 'jpeg', 'png'];

                //ALLOWED EXTENSION
                $profilePhotoPath = null;
                foreach ($allowedExtensions as $extension) {
                    $potentialPath = FCPATH . 'images/userprofilephoto/' . $username . '.' . $extension;
                    if (file_exists($potentialPath)) {
                        $profilePhotoPath = base_url('/images/userprofilephoto/' . $username . '.' . $extension);
                        break;
                    }
                }

                // LOAD DEFAULT PROFILE PHOTO
                if (!$profilePhotoPath) {
                    $profilePhotoPath = base_url('/images/default_profile.jpg');
                }
                ?>
                <img src="<?= $profilePhotoPath ?>" alt="Profile Photo">
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
                <ul>
                    <li><strong>Gender:</strong>
                        <?= $user['gender'] ?>
                    </li>
                    <li><strong>Bio:</strong>
                        <?= $user['about'] ?>
                    </li>
                    <!-- <li><strong>Role:</strong> Developer</li> -->
                    <li><strong>Categories:</strong>
                        <?= $user['categories'] ?>
                    </li>
                </ul>
            </section>

            <section id="stats">
                <h2>Stats</h2>
                <ul>
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
                <ul class="recent-activity">
                    <?php foreach ($recentActivity as $activity): ?>
                        <li>
                            <?= $activity['activity_type']; ?> on
                            <?= $activity['timestamp']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>

        <?php endforeach; ?>

    </main>
    <section id="links">
        <a href="https://discord.com" target="_blank">Discord</a>
        <a href="https://instagram.com" target="_blank">Instagram</a>
        <a href="https://linkedin.com" target="_blank">LinkedIn</a>
        <a href="https://github.com" target="_blank">GitHub</a>

    </section>

</body>

</html>