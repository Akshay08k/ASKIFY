<!DOCTYPE html>
<html>
<head>
    <title>Create Category</title>
    <style>
        /* Reset some default styling */
body, h1, form {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
}

h1 {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    max-width: 400px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 14px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #555;
}

/* Add more styles as needed */

    </style>
</head>
<body>
    <h1>Create Category</h1>
    <form action="/categories/store" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>
        <input type="submit" value="Create">
    </form>
</body>
</html>
