<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('/css/header.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/css/footer.css') ?>">
  <title>Askify</title>
  <link rel="stylesheet" href="<?= base_url('/css/withoutlogin.css') ?>">
  <link rel="shortcut icon" href="<?= base_url('/favicon.ico') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Work+Sans:wght@300&display=swap" rel="stylesheet">
  <style>
    .main {
      background: url('<?= base_url(' /background.png') ?>') center/cover;
    }
  </style>
</head>

<body>

  <nav>
    <div class="logo">
      <a href="#"> <img src="images/logo.png" alt="Logo" width="100"></a>

    </div>
    <div class="search-box">
    </div>
    <ul class="navlink">
      <li><a href="/login">Login</a></li>
      <li><a href="/register">Register</a></li>
    </ul>
  </nav>

  <div class="main">
    <div class="searcharea">
      <h1 align="center" class="heading">Welcome to Askify</h1>
      <input type="search" name="" id="searchInput" placeholder="end your curiosity">
      <div id="liveSearchResult"></div>
      <h2 class="cat-head">Popular Categories</h2>
      <div class="categories-boxes">

        <?php
        $desiredCategoryIds = [18, 29, 20, 21, 22, 23, 24, 25];
        ?>
        <?php foreach ($categories as $category): ?>
          <?php if (in_array($category['id'], $desiredCategoryIds)): ?>

            <div class="category-item2" onclick="redirect()">
              <div class="category-box">
                <img src="<?= base_url('uploads/categoryimages/' . $category['image']) ?>" class="cat-img"
                  alt="Category Image">
                <p class="category-name">
                  <?= $category['name']; ?>
                </p>
              </div>
            </div>


          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

  </div>


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