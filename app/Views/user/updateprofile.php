<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
    <link rel="stylesheet" href="<?= base_url('/css/updateprofile.css') ?>">

</head>

<body>

    <header>
        <h1>Update Details</h1>
    </header>

    <main>
        <?php if (isset($validation)): ?>
            <?= \Config\Services::validation()->listErrors() ?>
        <?php endif; ?>
        <form method="post" action="<?= base_url('/updateprofile/save') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?= $userData['username'] ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $userData['email'] ?>" required>

            <label for="name">Name:</label>
            <input type="text" name="name" value="<?= $userData['name'] ?>" required>

            <label for="categories">Categories:</label>
            <input type="text" name="categories" value="<?= $userData['categories'] ?>">

            <label for="birthdate">Birthdate (yyyy-mm-dd):</label>
            <input type="text" name="birthdate" pattern="\d{4}-\d{2}-\d{2}" value="<?= $userData['birthdate'] ?>"
                required>
            <small>Format: yyyy-mm-dd</small>

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

            <label for="profile_photo">Profile Photo:</label>
            <input type="file" name="profile_photo" accept="image/*">

            <button type="submit">Update</button>
        </form>
    </main>

</body>

</html>