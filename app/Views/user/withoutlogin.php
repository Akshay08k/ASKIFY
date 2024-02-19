<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('/css/header.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/css/footer.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/css/homepage.css') ?>">
  <link rel="shortcut icon"
    href="https://static.vecteezy.com/system/resources/previews/000/568/825/original/question-answer-icon-vector.jpg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Work+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>

  <nav>
    <div class="logo">
      <a href="#"> <img src="images/logo.png" alt="Logo" width="100"></a>

    </div>
    <div class="search-box">
      <div class="search__container">
        <input class="search__input" type="text" placeholder="Search">
      </div>

    </div>
    <ul class="navlink">
      <li><a href="/login">Login</a></li>
      <li><a href="/register">Register</a></li>
    </ul>
  </nav>
  <div class="categories">
    <?php
    $desiredCategoryIds = [18, 29, 20, 21, 22];
    ?>
    <?php foreach ($categories as $category): ?>
      <?php if (in_array($category['id'], $desiredCategoryIds)): ?>
        <div class="category-item" onclick="redirect()">
          <?= $category['name']; ?>
        </div>

      <?php endif; ?>
    <?php endforeach; ?>


    <div class="dropdown">
      <div>More Categories</div>


      <div class="dropdown-content">
        <?php foreach ($categories as $category): ?>
          <div onclick="redirect()">
            <?= $category['name']; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  &nbsp;
  <h3 align="center">Login/Register To Get Full Access Of Website</h3>
  &nbsp;
  <section class="content"></section>
  <script src="<?= base_url('js/withoutlogin.js') ?>"></script>
  <footer>
    <div class="foot-panel2">
      <div class="ul">
        <p>Get to know Us</p>
        <a href="">Blog</a>
        <a href="">About Askify</a>
      </div>


      <div class="ul">
        <p>Let Us Help you</p>

        <a>Use Of Askify </a>
        <a>Your Account</a>
        <a>Help</a>
        <a>Feedback</a>
      </div>
    </div>
    <div class="foot-panel4">
      <div class="pages">
        <a href="#">Condition Of Use</a>
        <a href="#">Privacy And Notice</a>
        <a href="#">Your Ads Privacy Choice</a>
      </div>
      <div class="copy">©2023, Askify, Inc. or its affiliates</div>
    </div>
  </footer>
</body>

</html>