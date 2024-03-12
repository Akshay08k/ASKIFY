<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('css/QueAns.css') ?>">
    <script src="<?= base_url('js/SelfData.js') ?>"></script>
</head>

<body>

    <?php
    $successMessage = session()->getFlashdata('success');
    if ($successMessage) {
        echo "<script>alert('{$successMessage}');</script>";
    }
    ?>
    <input type="hidden" name="" id="hidden" value="<?= session()->get('user_id') ?>">
    <h2 align="center">My Question</h2>
    <main>
        <div class="content"></div>
        <div class="answer-container">
            <h3 align="left" class="ans-heading">Answers</h3>
        </div>
        <a href="/profile">Return to profile</a>
    </main>
</body>

</html>