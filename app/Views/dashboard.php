<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to Your Dashboard</h1>
    <?php if(session()->get('loggedin')): ?>
        <p>Hello, <?= session()->get('name') ?>!</p>
        <p>Your Email: <?= session()->get('email') ?></p>
        <p><a href="<?= site_url('/logout') ?>">Logout</a></p>
    <?php else: ?>
        <p>You are not logged in. <a href="<?= site_url('/login') ?>">Login</a></p>
    <?php endif; ?>
</body>
</html>
