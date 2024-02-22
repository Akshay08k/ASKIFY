<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Answer Page</title>
    <link rel="stylesheet" href="<?= base_url('css/answerpage.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>

    <nav>
        <div class="logo">
            <a href="#"> <img src="<?= base_url('images/logo.png') ?>" alt="Logo" width="100"></a>
        </div>

        <div class="search-box">
            <div class="search__container">
                <input class="search__input" type="text" placeholder="Search" id="searchInput">
            </div>
        </div>

        <ul class="navlink">
            <li><a href="/homepage">Home</a></li>
            <li><a href="/notification">Notification</a></li>
            <li><a href="/messages">Messages</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    </nav>
    <div id="liveSearchResults"></div>



    <main>
        <div class="content">

        </div>


        <div class="answer-textbox">
            <form action="answers/submit" method="post">
                <textarea name="answer" id="answerInput" cols="50" rows="3"></textarea>
                <input type="submit" value="Submit" class="ans-submitbtn">
                <input type="hidden" id="questionid" name="question_id" class="hidden">
            </form>
        </div>

    </main>
    <div class="answer-container">
        <h3 align="left" class="ans-heading">Answers</h3>
    </div>
    <script src="<?= base_url('js/answer.js') ?>"></script>
</body>

</html>