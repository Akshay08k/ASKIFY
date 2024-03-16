<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= base_url('/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('css/feedback.css') ?>">
    <title>FeedbackSubmit - Askify</title>
</head>

<body>
    <div id="feedbackPopup" class="popup">
        <div class="popup-content">
            <h2>Submit Your Valuable Feedback</h2>
            <textarea id="feedbackText" placeholder="Enter your feedback..."></textarea><br>
            <button onclick="submitFeedback()">Submit Feedback</button>
        </div>
    </div>
    <script>

        function submitFeedback() {
            const feedback = document.getElementById("feedbackText").value;
            fetch(`feedback/submitFeedback/`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ Feedback: feedback }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Failed to submit feedback');
                    }
                    return response.json();
                })
                .then((result) => {
                    if (result.success) {
                        // Redirect to the homepage
                        window.location.href = window.location.origin + '/homepage';
                    } else {
                        // Show error message
                        alert('Failed to submit feedback');
                    }
                })
                .catch((error) => console.error("Error submitting report:", error));
        }

    </script>
</body>

</html>