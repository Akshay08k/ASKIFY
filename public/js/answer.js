function createAnswerBox(data) {
  const { username, answer, profile_photo, likes, id } = data;

  const answerBox = document.createElement("div");
  answerBox.classList.add("answer-box");

  const profileSection = document.createElement("div");
  profileSection.classList.add("profile-section");

  const likeSection = document.createElement("div");
  likeSection.classList.add("like-section");
  const likeButton = document.createElement("div");
  likeButton.classList.add("heart-like-button");

  // Fetch user's like status for the answer
  fetch(`/answers/checkUserLikeStatus/${id}`)
    .then((response) => response.json())
    .then((userLiked) => {
      if (userLiked) {
        likeButton.classList.add("liked");
        likeButton.style.color = "red";
      }
    })
    .catch((error) =>
      console.error("Error checking user's like status:", error)
    );

  likeButton.addEventListener("click", function () {
    // Toggle the 'liked' class for styling
    likeButton.classList.toggle("liked");

    // Update like count within the current answer box
    const likeCount = answerBox.querySelector(".heart-count");
    let currentLikes = parseInt(likeCount.textContent);

    // Determine the new like count based on the 'liked' class
    const newLikes = likeButton.classList.contains("liked")
      ? currentLikes + 1
      : Math.max(0, currentLikes - 1);

    // Update the displayed like count
    likeCount.textContent = newLikes;

    // Send a request to the server to update the like count in the database
    fetch(
      `/answers/updateAnswerLikeCount/${id}/${
        likeButton.classList.contains("liked") ? "true" : "false"
      }`,
      {
        method: "POST",
      }
    )
      .then((response) => response.json())
      .then((updatedLikes) => {
        // Log the updated likes count
        console.log("Updated likes in the database:", updatedLikes);
      })
      .catch((error) => console.error("Error updating like count:", error));
  });

  const likeCount = document.createElement("span");
  likeCount.classList.add("heart-count");
  likeCount.textContent = likes;
  likeSection.appendChild(likeButton);
  likeSection.appendChild(likeCount);

  const profilePicture = document.createElement("div");
  profilePicture.classList.add("profile-picture");
  const img = document.createElement("img");

  if (profile_photo) {
    img.src = `data:image/png;base64,${profile_photo}`;
  } else {
    img.src = "path/to/default/profile/photo.jpg";
  }

  img.alt = "User Profile Picture";
  profilePicture.appendChild(img);

  const profileName = document.createElement("p");
  profileName.textContent = username;

  profileSection.appendChild(profilePicture);
  profileSection.appendChild(profileName);

  // Answer Section
  const answerSection = document.createElement("div");
  answerSection.classList.add("answer-section");
  const answerElement = document.createElement("p");
  answerElement.textContent = answer;
  answerSection.appendChild(answerElement);

  answerBox.appendChild(profileSection);
  answerBox.appendChild(likeSection);
  answerBox.appendChild(answerSection);

  return answerBox;
}

document.addEventListener("DOMContentLoaded", function () {
  const answerContainer = document.querySelector(".answer-container");

  const urlParams = new URLSearchParams(window.location.search);
  const questionId = urlParams.get("id");

  if (questionId) {
    // Fetch all answers from the server
    fetch("/answers/getanswers")
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
      })
      .then((allAnswers) => {
        // Filter answers based on the question_id
        const filteredAnswers = allAnswers.filter(
          (answer) => answer.question_id === questionId
        );

        // Loop through each filtered answer data and create answer boxes dynamically
        filteredAnswers.forEach((answerData) => {
          const answerBox = createAnswerBox(answerData);
          answerContainer.appendChild(answerBox);
        });
      })
      .catch((error) => {
        console.error("Error fetching answers:", error);
      });
  } else {
    console.error("Question ID not provided in the URL.");
  }
});
