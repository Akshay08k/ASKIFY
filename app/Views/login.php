    <!-- app/Views/login.blade.php -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
    </head>
    <body>
        <h1>Login Page</h1><form action="<?= base_url('login/auth') ?>" method="post">

        
        <label for="user">User:</label>
            <input type="user" id="us" name="user" required>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </body>
    </html>
