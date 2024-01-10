<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1f1f1f;
            color: #fff;
        }

        header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        form {
            background-color: #2c3e50;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <header>
        <h1>Update Details</h1>
    </header>

    <main>

        <form>
            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" placeholder="Enter your gender">

            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" placeholder="Enter your bio"></textarea>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" placeholder="Enter your role">

            <label for="categories">Categories:</label>
            <input type="text" id="categories" name="categories" placeholder="Enter your categories">

            <button type="submit">Update Details</button>
        </form>

    </main>

</body>
</html>
    