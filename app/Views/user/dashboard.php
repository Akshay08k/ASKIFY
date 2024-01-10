<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            font-family: "Roboto Slab", serif;
        }

        nav {
            background-image: linear-gradient(to right,
                    rgb(3, 192, 205),
                    rgb(122, 46, 231));
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 35px;
        }

        .logo {
            background: url("/images/Askify\ \(2\).png");
            height: 40px;
            width: 92px;
            background-size: contain;
            background-repeat: no-repeat;
        }

        .nav-links {
            width: 400px;
            list-style: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-right: 10px;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links li:first-child {
            margin-left: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .searchbar {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-bar input[type="text"] {
            height: 35px;
            font-size: 15px;
            width: 300px;
            border: hidden;
            border-radius: 7px;
            text-align: center;
            margin-right: 9px;
        }

        .search:focus {
            outline: none;
        }

        .search:hover {
            border: black 1px;
        }

        .search-bar input[type="button"] {
            height: 35px;
            color: white;
            border: hidden;
            width: 50px;
            background-color: black;
            font-size: 17px;
            border-radius: 7px;
            margin-right: 20px;
        }

        .nav-links svg {
            font-size: 30px;
        }

        .nav-links svg:hover {
            height: 40px;
            width: 40px;
        }

        main {
            display: flex;
            background-color: black;
            color: white;
        }

        .profile {
            flex: 1;
            padding: 20px;
            background-color: black;
            color: white;
            border: 1px solid black;
        }

        .profile p {
            color: white;
        }

        .profile-info {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .user-details {
            flex: 1;
        }

        .profile-image {
            margin-bottom: 10px;
        }

        .profile-image img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .user-stats h3 {
            margin-bottom: 5px;
        }

        .user-stats ul {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style-type: none;
            margin-bottom: 10px;
        }

        .user-stats li {
            padding: 10px;
        }

        .stat {
            font-size: 23px;
            padding-right: 2px;
            font-weight: bolder;
        }

        .edit-profile {
            padding: 8px 16px;
            background-color: rgb(94, 94, 218);
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .user-bio {
            padding-top: 20px;
        }

        .user-bio h4 {
            margin-bottom: 5px;
            font-size: 25px;
        }

        .user-bio p {
            font-size: 15px;
            color: white;
        }

        .activity {
            flex: 1;
            padding: 45px;
            background-color: black;
            color: white;
        }

        .activity h2 {
            margin-bottom: 10px;
            color: white;
        }

        .activity ul {
            list-style-type: none;
            margin-left: 0;
            padding-left: 0;
        }

        .activity li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .activity-type {
            font-weight: bold;
            margin-right: 5px;
        }

        .activity-content {
            color: whitesmoke;
        }

        .upvote-icon {
            display: inline-block;
            width: 16px;
            height: 16px;
            background-color: #333;
            margin-left: 10px;
        }

        footer {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            position: sticky;
            left: 0;
            bottom: 0px;
            width: 100%;
        }

        .profile-img {
            width: 33.75px;
            height: 30px;
            border-radius: 45%;
        }

        .follower-count,
        .following-count {
            font-weight: bold;
            margin-right: 5px;
        }

        .settings {
            flex: 1;
            padding: 20px;
            display: none;
            /* Initially hide the settings section */
        }

        .settings-header {

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .settings-header h2 {
            margin-bottom: 10px;
            color: white;
        }

        .settings-content {
            margin-bottom: 20px;
        }

        .settings-content h3 {
            margin-bottom: 10px;
            color: white;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .input,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 16px;
            background-color: rgb(94, 94, 218);
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .checkbox-container input[type="checkbox"] {
            font-size: 20px;
        }

        .checkbox-container label {
            margin: 0;
        }

        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editProfileButton = document.querySelector('.edit-profile');
            const settingsSection = document.querySelector('.settings');
            const closeSettingsButton = document.querySelector('.close-settings');

            editProfileButton.addEventListener('click', function () {
                settingsSection.style.display = 'block';
            });

            closeSettingsButton.addEventListener('click', function () {
                settingsSection.style.display = 'none';
            });
        });
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="logo">
            <!-- Logo image or text -->
        </div>
        <ul class="nav-links">
            <li><a href="/homepage/homepage.html"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 576 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                    </svg></a></li>
            <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                    </svg></a></li>
            <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3V245.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V389.2C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112h32c24 0 46.2 7.5 64.4 20.3zM448 416V394.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176h32c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2V416c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3V261.7c-10 11.3-16 26.1-16 42.3zm144-42.3v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2V448c0 17.7-14.3 32-32 32H288c-17.7 0-32-14.3-32-32V405.2c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112h32c61.9 0 112 50.1 112 112z" />
                    </svg></a></li>
            <li><a href="#"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"
                        preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000"
                            stroke="none">
                            <path d="M2480 5104 c-19 -8 -48 -27 -63 -42 -55 -52 -62 -75 -67 -236 l-5
                -149 -92 -18 c-176 -36 -367 -117 -533 -227 -117 -78 -318 -280 -399 -401
                -106 -160 -182 -338 -224 -526 -17 -80 -20 -143 -27 -570 -8 -530 -13 -585
                -75 -771 -76 -230 -190 -409 -378 -597 -164 -162 -182 -197 -182 -342 0 -89 3
                -106 27 -156 53 -107 158 -186 277 -209 77 -14 3567 -14 3647 1 114 21 219
                101 272 208 24 50 27 67 27 156 0 144 -20 182 -173 333 -130 128 -188 201
                -258 319 -88 147 -147 308 -179 483 -15 77 -19 184 -25 575 -6 428 -9 490 -27
                570 -67 298 -194 527 -412 746 -216 215 -463 351 -744 408 l-92 18 -5 149 c-5
                161 -12 184 -67 236 -58 56 -151 73 -223 42z" />
                            <path d="M1780 625 c0 -33 62 -182 104 -249 172 -274 506 -422 818 -362 219
                42 402 164 526 351 44 66 111 220 112 258 0 16 -44 17 -780 17 -680 0 -780 -2
                -780 -15z" />
                        </g>
                    </svg></a></li>
            <li><a href="/dashboard/dashboard.html"><img class="profile-img" src="/images/NYCTOPHILE.png" alt=""></a>
            </li>
        </ul>
        <div class="search-bar">
            <input type="text" placeholder="Ask anything here.." class="search" autocomplete="name">
            <input type="button" value="Go" />
        </div>
        <div class="create-post">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" height="2.2em" viewBox="0 0 512 512"
                preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                    <path d="M1050 5113 c-79 -8 -230 -48 -319 -84 -152 -62 -251 -129 -381 -259
-170 -171 -261 -332 -321 -570 l-24 -95 0 -1545 0 -1545 24 -95 c59 -236 152
-400 321 -570 168 -168 314 -251 558 -318 l97 -27 1550 0 1550 0 110 29 c226
59 395 154 556 315 192 193 309 432 340 695 7 61 9 586 7 1581 l-3 1490 -27
97 c-65 236 -150 387 -308 549 -164 167 -335 266 -564 327 l-101 27 -1515 1
c-833 1 -1531 -1 -1550 -3z m1629 -1300 c27 -17 58 -48 76 -77 l30 -49 3 -431
c2 -289 6 -434 14 -443 8 -10 94 -13 412 -13 237 0 419 -5 446 -11 128 -29
205 -159 169 -286 -17 -61 -89 -137 -145 -152 -25 -7 -189 -11 -455 -11 -330
0 -419 -3 -427 -13 -8 -9 -12 -153 -14 -443 -3 -418 -4 -430 -25 -469 -59
-111 -188 -156 -299 -106 -53 24 -109 91 -123 146 -7 28 -11 188 -11 454 0
395 -1 411 -19 421 -13 6 -165 10 -427 10 -291 0 -418 3 -448 12 -25 8 -59 31
-86 58 -74 74 -90 166 -44 258 14 29 41 64 60 78 67 51 94 54 534 54 323 0
410 3 418 13 8 9 12 153 14 443 l3 429 28 47 c66 113 205 149 316 81z" />
                </g>
            </svg>

        </div>
    </nav>

    <main>
        <section class="profile">
            <div class="profile-info">
                <div class="user-details">
                    <div class="profile-image">
                        <img src="/images/NYCTOPHILE.png" alt=" Profile Picture">
                    </div>
                    <div class="user-stats">
                        <h3>John Doe</h3>
                        <ul>
                            <li><span class="stat">250</span> followers</li>
                            <li><span class="stat">300</span> following</li>
                        </ul>
                        <button class="edit-profile">Edit Profile</button>
                    </div>
                </div>
                <div class="user-bio">
                    <h4>About Me</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed tortor a libero feugiat
                        viverra. Etiam in libero in nisl placerat iaculis. Ut commodo orci sed nisl elementum, ac
                        ullamcorper ligula consequat. Donec lacinia nisl ac commodo consequat.</p>
                </div>
            </div>
        </section>

        <section class="settings">
            <div class="settings-header">
                <h2>User Settings</h2>
            </div>
            <div class="settings-content">
                <h3>General</h3>
                <form>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="John Doe" class="input"><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="johndoe@example.com" class="input"><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="********" class="input"><br>
                </form>
            </div>

            <div class="settings-content">
                <h3>Privacy</h3>
                <form>
                    <label for="visibility">Profile Visibility:</label>
                    <select id="visibility" name="visibility">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select><br>
                    <h3>About Me</h3>
                    <form>
                        <label for="about">About Me:</label>
                        <textarea id="about" name="about"
                            rows="4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea>
                    </form>
            </div>
            <label for="notifications">Receive Notifications</label>

            <input type="checkbox" id="notifications" name="notifications" checked> <br> <br>
            <button>Save</button> <button class="close-settings">Close</button> <a
                href="/login page/loginregister.html"><button>Logout</button></a>
            </form>
            </div>
        </section>


    </main>



    <footer>
        <p>&copy; 2023 Askify Copyright Reserved</p>

    </footer>
</body>

</html>