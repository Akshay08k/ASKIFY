<!-- app/Views/messages/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
</head>

<body>
    <h1>Messages</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Sender ID</th>
                <th>Receiver ID</th>
                <th>Message</th>
                <th>Media</th>
                <th>Seen</th>
                <th>Created At</th>
                <th>Received At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td>
                        <?= $message['id']; ?>
                    </td>
                    <td>
                        <?= $message['sender_id']; ?>
                    </td>
                    <td>
                        <?= $message['receiver_id']; ?>
                    </td>
                    <td>
                        <?= $message['message']; ?>
                    </td>
                    <td>
                        <?= $message['media']; ?>
                    </td>
                    <td>
                        <?= $message['seen']; ?>
                    </td>
                    <td>
                        <?= $message['created_at']; ?>
                    </td>
                    <td>
                        <?= $message['received_at']; ?>
                    </td>
                    <td>
                        <?= $message['updated_at']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= base_url('messages/create'); ?>">Create New Message</a>
</body>

</html>