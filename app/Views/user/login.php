<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <style>
        /* CSS styles */

        body {
            font-family: "Roboto Slab", serif;
            background: url(<?= base_url('/images/back.jpg')?>);
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .slider-content {
            width: 800px;
            height: 400px;
            display: flex;
            transition: transform 0.3s ease-in-out;
        }

        .box {
            width: 450px;
            height: 450px;
            flex-shrink: 0;
            background-color: #fff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .login-form {
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-form input {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            background-color: rgb(94, 94, 218);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .slide h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
        }

        .slide input {
            width: 250px;
        }

        p {
            padding-top: 0%;
            font-size: 15px;
        }

        .redirect {
            padding-left: 15em;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>Login</h2>
        <form action="login/auth" method="post" class="login-form">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <p><a href="/forgotpass/forgot.html">Forgot Password?</a></p>
            <button type="submit">Login</button>
        </form>
        <a href="/register" class="redirect">
            <p>Want To Register?</p>
        </a>
    </div>
</body>

</html>