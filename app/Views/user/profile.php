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
            <img src="/images/nycto.jpg" alt="Profile Photo">
            <p class="username">Akshay_komale</p>
            <p>Akshay</p>
        </section>

        <section id="details">
            <h2>Details</h2>
            <ul>
                <li><strong>Gender:</strong> Male</li>
                <li><strong>Bio:</strong> A passionate individual...</li>
                <li><strong>Role:</strong> Developer</li>
                <li><strong>Categories:</strong> Web Development, Design, Technology</li>
            </ul>
        </section>

        <section id="stats">
            <h2>Stats</h2>
            <ul>
                <li><strong>Followers:</strong> 100</li>
                <li><strong>Following:</strong> 50</li>
                <li><strong>Likes:</strong> 500</li>
            </ul>
        </section>

        <section id="recent-activity">
            <h2>Recent Activity</h2>
            <ul class="recent-activity">
                <li>Liked a post on 2024-01-09</li>
                <li>Posted a status update on 2024-01-08</li>
            </ul>
        </section>



    </main>
    <section id="links">
        <a href="https://discord.com" target="_blank">Discord</a>
        <a href="https://instagram.com" target="_blank">Instagram</a>
        <a href="https://linkedin.com" target="_blank">LinkedIn</a>
        <a href="https://github.com" target="_blank">GitHub</a>

    </section>

</body>

</html>