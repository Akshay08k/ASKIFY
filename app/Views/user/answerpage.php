<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Answer Page</title>
    <link rel="stylesheet" href="<?= base_url('css/answerpage.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/footer.css') ?>">
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
                <div id="liveSearchResults"> </div>
            </div>
        </div>

        <ul class="navlink">
            <li><a href="/homepage">Home</a></li>
            <li><a href="/notification">Notification</a></li>
            <li><a href="/messages">Messages</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    </nav>



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
    <footer>
        <div class="foot-panel2">
            <div class="ul">
                <p>Get to know Us</p>
                <a href="/useofaskify">About Askify</a>
            </div>
            <div class="ul">
                <p>Use Of Askify </p>
                <a href="/profile">Your Account</a>
                <a href="/help">Help</a>
                <a id="feedbackBtn">Feedback</a>
            </div>
        </div>
        <div class="foot-panel4">
            <div class="pages">
                <a href="/content-policy">Content Policy</a>
                <a href="/privacy">Privacy And Notice</a>
            </div>
            <div class="copy">©2023, Askify, Inc. or its affiliates</div>
        </div>
    </footer>
    <script src="<?= base_url('js/answer.js') ?>"></script>
</body>

</html>