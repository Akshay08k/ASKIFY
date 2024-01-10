<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
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
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 500px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #555;
            outline: none;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #555;
            outline: none;
        }

        input[type="file"] {
            margin-bottom: 12px;
        }

        div.radio-group {
            display: flex;
            margin-bottom: 12px;
        }

        div.radio-group label {
            margin-right: 15px;
            margin-bottom: -10px;
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
            <label for="profilephoto">Profile Photo:</label>
            <input type="file" name="profilephoto" id="profilephoto" accept="image/*" placeholder="Choose Profile Photo">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name">

            <label>Gender:</label>
            <div class="radio-group">
                <input type="radio" id="male" name="gender" value="male">
                <label for="male">Male</label>

                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>

                <input type="radio" id="nonbinary" name="gender" value="non-binary">
                <label for="nonbinary">Non-binary</label>
            </div>

            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio"></textarea>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" placeholder="Enter your role">

            <label for="categories">Categories:</label>
            <input type="text" id="categories" name="categories" placeholder="Enter your categories">

            <button type="submit">Update Details</button>
        </form>

    </main>

</body>
</html>
