<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    
  <link rel="stylesheet" href="<?= base_url('css/profile.css')?>">
</head>

<body>

    <header>
        <h1>User Profile</h1>
    </header>

    <main>

        <section id="profile">
            <?php foreach($users as $user): ?>
            <img src="images/nycto.jpg" alt="Profile Photo">
            <p class="username"><?= $user['username'] ?></p>
            <p><strong><?= $user['name'] ?></strong></p>
            <p><?= $user['email'] ?></p>
            <p>IP: <?= $user['signup_ip']; ?></p>
        </section>

        <section id="details">
           
        </section>
        <section id="stats">
            <h2>Stats</h2>
            <ul>
                <li><strong>Followers:</strong> </li>
                <li><strong>Following:</strong></li>
                <li><strong>Likes:</strong></li>
                <li></li>
            </ul>
        </section>

        <section id="recent-activity">
            <h2>Recent Activity</h2>
            <ul class="recent-activity">
                <li>Liked a post on 2024-01-09</li>
                <li>Posted a status update on 2024-01-08</li>
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