<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/css/login.css') ?>">
</head>

<body>
    <div class="box">
        <h2>Login</h2>
        <form action="login/auth" method="post" class="login-form">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <p><a href="/forgotpass/forgot.html">/Forgot Password?</a></p>
            <button type="submit">Login</button>
        </form>
        <a href="/register" class="redirect">
            <p>Want To Register?</p>
        </a>
    </div>
</body>

</html>