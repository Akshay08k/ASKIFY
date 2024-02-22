<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
    <link rel="stylesheet" href="<?= base_url('/css/updateprofile.css') ?>">
    <link rel="shortcut icon"
        href="https://static.vecteezy.com/system/resources/previews/000/568/825/original/question-answer-icon-vector.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Work+Sans:wght@300&display=swap"
        rel="stylesheet">

</head>

<body>

    <header>
        <nav>
            <div class="logo">
                <a href="#"> <img src="<?= base_url('/images/logo.png') ?>" alt="Logo" width="100"></a>
            </div>
            <div class="search-box">
                <div class="search__container">
                    <input class="search__input" type="text" placeholder="Search">
                </div>
            </div>
            <ul>
                <li><a href="/homepage">Home</a></li>
                <li><a href="/notification">Notification</a></li>
                <li><a href="/messages">Messages</a></li>
                <li><a href="/profile">Profile</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($validation)): ?>
            <?= \Config\Services::validation()->listErrors() ?>
        <?php endif; ?>
        <form method="post" action="<?= base_url('/updateprofile/save') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <label for="profile_photo">Profile Photo:</label>
            <input type="file" name="profile_photo" accept="image/*">

            <label for="username">Username:</label>
            <input type="text" name="username" value="<?= $userData['username'] ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $userData['email'] ?>" required>

            <label for="name">Name:</label>
            <input type="text" name="name" value="<?= $userData['name'] ?>" required>

            <label for="birthdate">Birthdate (yyyy-mm-dd):</label>
            <input type="text" name="birthdate" pattern="\d{4}-\d{2}-\d{2}" value="<?= $userData['birthdate'] ?>"
                required>

            <label for="location">Location:</label>
            <input type="text" name="location" value="<?= $userData['location'] ?>">

            <label for="about">About:</label>
            <textarea name="about"><?= $userData['about'] ?></textarea>

            <label for="gender">Gender:</label>
            <select name="gender">
                <option value="male" <?= ($userData['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= ($userData['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                <option value="other" <?= ($userData['gender'] == 'other') ? 'selected' : '' ?>>Other</option>
            </select>


            <button type="submit">Update</button>
        </form>
    </main>

</body>

</html>