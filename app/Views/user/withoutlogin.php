<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('css/homepage.css')?>">
  <link rel="shortcut icon"
    href="https://static.vecteezy.com/system/resources/previews/000/568/825/original/question-answer-icon-vector.jpg">
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
      <li><a href="#home">Login</a></li>
      <li><a href="#about">Register</a></li>
    </ul>
  </nav>
  <div class="categories">
    <div class="category-item">Lifestyle</div>
    <div class="category-item">Sports</div>
    <div class="category-item">E Sports</div>
    <div class="category-item">Bollywood</div>
    <div class="category-item">Tech & Science</div>
    <div class="category-item">Coding</div>

    <!-- Dropdown for additional categories -->
    <div class="dropdown">
      <div>More Categories</div>
      <div class="dropdown-content">
        <div>Category</div>
        <div>Category</div>
        <div>Category</div>
        <div>Category</div>
        <div>Category</div>
        <div>Category</div>
        <div>Category</div>
        <div>Category</div>
        <div>Category</div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="post-box">
      <!-- User Profile Section -->
      <div class="profile-section">
        <div class="profile-picture">
          <img src="nycto.jpg" alt="User Profile Picture">
        </div>
        <p>User Profile</p>
        <!-- Add user profile information here -->
      </div>

      <!-- Title Section -->
      <div class="title-section">
        <h3>Title of the Question</h3>
      </div>

      <!-- Question Description Section -->
      <div class="description-section">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ipsa adipisci officia accusantium
          nam minima eligendi, dolores itaque asperiores. In ullam nesciunt reprehenderit commodi suscipit,
          tempore consequuntur quidem eos tenetur.

      </div>

      <!-- Like and Answer Buttons -->
      <div class="post-actions">
        <div class="svg-container">
          <input type="checkbox" id="checkbox" />
          <label for="checkbox">
            <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
              <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                <path
                  d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z"
                  id="heart" fill="#AAB8C2" />
                <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5" />

                <g id="grp7" opacity="0" transform="translate(7 6)">
                  <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2" />
                  <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2" />
                </g>

                <g id="grp6" opacity="0" transform="translate(0 28)">
                  <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2" />
                  <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2" />
                </g>

                <g id="grp3" opacity="0" transform="translate(52 28)">
                  <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2" />
                  <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2" />
                </g>

                <g id="grp2" opacity="0" transform="translate(44 6)">
                  <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2" />
                  <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2" />
                </g>

                <g id="grp5" opacity="0" transform="translate(14 50)">
                  <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2" />
                  <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2" />
                </g>

                <g id="grp4" opacity="0" transform="translate(35 50)">
                  <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2" />
                  <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2" />
                </g>

                <g id="grp1" opacity="0" transform="translate(24)">
                  <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2" />
                  <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2" />
                </g>
              </g>
            </svg>
          </label>
        </div>
        <button class="ans-btn">Answer 🔽</button>
      </div>

      <!-- Share Button -->
      <div class="share-button">
        <img src="https://cdn2.iconfinder.com/data/icons/line-drawn-social-media/31/share-1024.png" height="30"
          width="30" alt="">
      </div>
    </div>
  </section>
  <script src="<?= base_url('js/homepage.js')?>"></script>
</body>

</html>