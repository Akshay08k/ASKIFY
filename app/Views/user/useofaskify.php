<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url('/favicon.ico') ?>">
    <title>Use of Askify</title>
    <!-- Tailwind CSS -->
    <style>
        /* Your provided CSS styles here */
        @import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap');

        * {
            font-family: 'Work Sans', sans-serif;
        }

        body {
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #222;
            color: #eee;
        }

        .content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #333;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #336699;
        }

        h1,
        h2 {
            color: #336699;
            text-align: center;
        }

        p {
            color: #ccc;
        }

        /* Dark mode styles */
    </style>
    <!-- Custom styles for black mode -->

</head>

<body class="content bg-white dark-mode">

    <header class=" bg-gray-800 text-white p-4">
        <h1 class="text-2xl font-bold">Askify - Your Question Answer Hub</h1>
    </header>

    <main class="container mx-auto mt-8">
        <section>
            <h2 class="text-xl font-bold mb-4">What is Askify?</h2>
            <p class="text-gray-700 leading-6">
                Askify is a user-friendly question-answer platform designed to facilitate knowledge sharing and
                community engagement.
                Users can ask questions, provide answers, and contribute to a diverse range of topics(categories).
            </p>
        </section>

        <section class="mt-8">
            <h2 class="text-xl font-bold mb-4">Key Features</h2>
            <ul class="list-disc list-inside text-gray-700">
                <li>Ask questions on various topics.</li>
                <li>Receive answers from a community of knowledgeable users.</li>
                <li>Upvote answers based on helpfulness.</li>
                <li>Participate in discussions through comments.</li>
                <li>User-friendly interface for seamless navigation.</li>
                <li>Messaging Between Users To Solve More Doubts</li>
            </ul>
        </section>


    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <p align="center">&copy; 2024 Askify - All rights reserved.</p>
    </footer>

</body>

</html>