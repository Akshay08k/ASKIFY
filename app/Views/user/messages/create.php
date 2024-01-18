<!-- app/Views/messages/create.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Message</title>
</head>

<body>
    <h1>Create Message</h1>
    </form method="post" action="<?= base_url('messages/create') ?>"> <label for=" sender_id">Sender ID:</label>
    <input type="text" name="sender_id" required>
    <br>

    <label for="receiver_id">Receiver ID:</label>
    <input type="text" name="receiver_id" required>
    <br>

    <label for="message">Message:</label>
    <textarea name="message" required></textarea>
    <br>

    <label for="media">Media:</label>
    <input type="text" name="media">
    <br>

    <label for="seen">Seen:</label>
    <input type="checkbox" name="seen" value="1">
    <br>

    <label for="created_at">Created At:</label>
    <input type="text" name="created_at" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
    <br>

    <label for="received_at">Received At:</label>
    <input type="text" name="received_at">
    <br>

    <label for="updated_at">Updated At:</label>
    <input type="text" name="updated_at" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
    <br>

    <button type="submit">Submit</button></form>

    <a href="<?= base_url('messages'); ?>">Back to Messages</a>
</body>

</html>