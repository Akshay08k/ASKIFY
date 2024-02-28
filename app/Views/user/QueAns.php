<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Stylish Website</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Add custom styles here */
        .category {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .question-card {
            width: 800px;
            transition: transform 0.2s;
        }

        .question-card:hover {
            background-color: whitesmoke;
        }

        .like-btn {
            cursor: pointer;
            transition: color 0.3s;
        }

        .liked {
            color: #ff6347;
            /* Tomato color */
        }

        .like-count {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
            /* Gray-600 */
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        /* Custom Navbar Styles */
        nav {
            background-color: #4a90e2;
            /* Dodger Blue */
        }

        .nav-link {
            color: #fff;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #ffcc00;
            /* Highlight Yellow */
        }

        .logo {
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        .logo:hover {
            color: #ffcc00;
            /* Highlight Yellow */
        }

        .search-bar {
            background-color: #fff;
            border-radius: 5px;
            padding: 8px;
            margin-left: 10px;
            width: 200px;
            transition: background-color 0.3s;
        }

        .search-bar:focus {
            background-color: #f0f0f0;
            /* Light Gray */
        }
    </style>
</head>

<body class="font-sans bg-gray-100">

    <!-- Enhanced Navbar -->
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Animated Logo -->
            <a href="#" class="logo text-white animate__animated animate__heartBeat">Your Stylish Website</a>

            <!-- Responsive Navigation Menu -->
            <div class="lg:hidden">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="hidden lg:flex space-x-4">
                <a href="#" class="nav-link">Home</a>
                <a href="#" class="nav-link">Questions</a>
                <a href="#" class="nav-link">Answers</a>
                <a href="#" class="nav-link">Search</a>
                <a href="#" class="nav-link">Categories</a>
                <a href="#" class="nav-link">Ask a Question</a>
                <a href="#" class="nav-link">User Profile</a>
                <a href="#" class="nav-link">Login/Register</a>
                <!-- Add more links as needed -->
            </div>

            <!-- Search Bar -->
            <input type="text" placeholder="Search..." class="search-bar">
        </div>
    </nav>

    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div id="mobile-menu" class="lg:hidden hidden bg-blue-500 p-4">
        <div class="flex flex-col space-y-2">
            <a href="#" class="text-white">Home</a>
            <a href="#" class="text-white">Questions</a>
            <a href="#" class="text-white">Answers</a>
            <a href="#" class="text-white">Categories</a>
            <a href="#" class="text-white">Ask a Question</a>
            <a href="#" class="text-white">User Profile</a>
            <a href="#" class="text-white">Login/Register</a>
            <!-- Add more links as needed -->
        </div>
    </div>

    <!-- Main Content (Homepage) -->
    <div class="container mx-auto mt-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8">Welcome to Your Interactive Website!</h1>

        <!-- Dynamic Question Categories -->
        <section class="mb-8">
            <!-- Category: Web Development -->
            <div class="flex flex-col gap-10 align-center items-center">
                <div class="question-card bg-white p-6 rounded-md shadow-md card hover:shadow-lg">
                    <h3 class="text-lg font-semibold mb-3 text-blue-500">How to customize Tailwind CSS?</h3>
                    <p class="text-gray-600">Learn the tricks to make your website stand out with customized
                    <div class="flex items-center space-x-4">
                        <button class="like-btn" onclick="toggleLike(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                </path>
                            </svg>
                            <span class="inline-block"></span>

                            <span class="like-count"></span>
                        </button>
                        <button class="like-btn" onclick="toggleLike(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <span class="inline-block"></span>
                        </button>
                    </div>
                </div>
                <!-- Add more questions for this category -->

                <div class="question-card bg-white p-6 rounded-md shadow-md card hover:shadow-lg">
                    <h3 class="text-lg font-semibold mb-3 text-blue-500">Getting started with Python programming
                    </h3>
                    <p class="text-gray-600">Explore the basics of Python programming and start building your first
                        program.</p>
                    <div class="flex items-center space-x-4">
                        <button class="like-btn" onclick="toggleLike(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                </path>
                            </svg>
                            <span class="inline-block"></span>

                            <span class="like-count"></span>
                        </button>
                        <button class="like-btn" onclick="toggleLike(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <span class="inline-block"></span>
                        </button>
                    </div>
                </div>
                <!-- Add more questions for this category -->

                <div class="question-card bg-white p-6 rounded-md shadow-md card hover:shadow-lg">
                    <div class="flex items-start justify-between mb-3">
                        <!-- Profile Photo and User Info -->
                        <div class="flex items-center space-x-4">
                            <img src="path/to/profile-photo.jpg" alt="Profile Photo" class="h-10 w-10 rounded-full">
                            <div>
                                <span class="text-gray-600">Username</span>
                                <!-- Add user profile link or other details if needed -->
                            </div>
                        </div>

                        <!-- Report and Share Buttons -->
                        <div class="flex items-center space-x-2">
                            <button class="text-gray-600 hover:text-blue-500 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 19a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6l2-2h4a2 2 0 0 1 2 2v12zM10 9a2 2 0 0 1 2-2h1a2 2 0 1 1 0 4h-1a2 2 0 0 1-2-2z">
                                    </path>
                                </svg>
                            </button>
                            <button class="text-gray-600 hover:text-blue-500 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 3a3 3 0 0 0-3 3v5a3 3 0 0 0 3 3v5l6-6-6-6z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Question Title -->
                    <h3 class="text-lg font-semibold mb-2 text-blue-500">Best practices for UI/UX design</h3>

                    <!-- Question Description -->
                    <p class="text-gray-600 mb-4">Discover the essential principles and best practices for designing a
                        user-friendly interface.</p>

                    <!-- Like Buttons -->
                    <div class="flex items-center space-x-4">
                        <button class="like-btn" onclick="toggleLike(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                </path>
                            </svg>
                            <span class="inline-block"></span>

                            <span class="like-count"></span>
                        </button>
                        <button class="like-btn" onclick="toggleLike(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>
                </div>


            </div>
        </section>
    </div>

    <script>
        function toggleLike(button) {
            button.classList.toggle('liked');
            updateLikeCount(button);
            animateLikeButton(button);
        }

        function updateLikeCount(button) {
            const countElement = button.nextSibling;
            const isLiked = button.classList.contains('liked');
            let count = parseInt(countElement.textContent);

            if (isNaN(count)) {
                count = 0;
            }

            if (isLiked) {
                count++;
            }

            countElement.textContent = `${count}`;
        }

        function animateLikeButton(button) {
            button.classList.add('animate__animated', 'animate__bounce');
            setTimeout(() => {
                button.classList.remove('animate__animated', 'animate__bounce');
            }, 1000);
        }

        // Toggle mobile menu visibility
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>


    <!-- Add Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</body>

</html>