<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <style>
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
            background-color: #fffefe;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .register-form {
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .register-form input {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }


        .register-form button {
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

        a {
            margin-left: 15em;
            text-align: right;
        }
    </style>
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