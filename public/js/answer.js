// answers.js

function createAnswerBox(data) {
  const { username, answer, profile_photo } = data;

  const answerBox = document.createElement("div");
  answerBox.classList.add("answer-box");

  const profileSection = document.createElement("div");
  profileSection.classList.add("profile-section");

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
