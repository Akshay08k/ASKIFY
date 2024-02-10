<!DOCTYPE html>
<html>

<head>
    <title>Categories</title>
    <style>
        /* public/css/styles.css */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        td img {
            max-width: 100px;
            max-height: 100px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        a {
            background-color: limegreen;
            padding: 5px;
            color: white;
            border-radius: 4px;
            margin: 10px;
        }

        .createnew {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>
    <h1>Categories</h1>
    <a href="/categories/create" class="createnew">Create New Category</a>
    <table>
        <tr>

            <th>Name</th>

            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($categories as $category): ?>
            <tr>

                <td>
                    <?= $category['name']; ?>
                </td>

                <td><img src="data:image/jpeg;base64,<?= $category['image']; ?>" alt="Category Image"></td>

                <td>
                    <a href="/categories/edit/<?= $category['id']; ?>">Edit</a>
                    <a href="/categories/delete/<?= $category['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>