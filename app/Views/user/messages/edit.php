<!-- app/Views/messages/edit.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Message</title>
</head>

<body>
    <h1>Edit Message</h1>
    <?= form_open("messages/update/{$message['id']}"); ?>
    <!-- Populate form fields with existing data -->
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
    <?= form_close(); ?>
    <a href="<?= base_url('messages'); ?>">Back to Messages</a>
</body>

</html>