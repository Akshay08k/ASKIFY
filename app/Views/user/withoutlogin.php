<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('css/homepage.css') ?>">
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
    <ul>
      <li><a href="/login">Login</a></li>
      <li><a href="/register">Register</a></li>
    </ul>
  </nav>
  <div class="categories">
    <?php
    $desiredCategoryIds = [18, 19, 20, 21, 22];
    ?>
    <?php foreach ($categories as $category): ?>
      <?php if (in_array($category['id'], $desiredCategoryIds)): ?>
        <div class="category-item">
          <?= $category['name']; ?>
        </div>

      <?php endif; ?>
    <?php endforeach; ?>


    <div class="dropdown">
      <div>More Categories</div>


      <div class="dropdown-content">
        <?php foreach ($categories as $category): ?>
          <div>
            <?= $category['name']; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <section class="content"></section>
  <script src="<?= base_url('js/homepage.js') ?>"></script>
</body>

</html>