<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/register.css') ?>">
    <title>Document</title>
</head>

<body>

    <div class="box">
        <h2>Register</h2>

        <form action="register/save" method="post" class="register-form">
            <!-- Register form fields -->
            <input type="text" name="name" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="confpassword" placeholder="Confirm Password">
            <button type="submit">Submit</button>
        </form>
        <a href="login">
            <p>Already Registered?</p>
        </a>
    </div>
</body>

</html>