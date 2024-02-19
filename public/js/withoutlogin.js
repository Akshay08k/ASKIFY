function createQuestionBox(data) {
  const { name, title, description, profile_photo, likes, id, media } = data;

  const profilePictureHTML = profile_photo
    ? `<div class="profile-picture"><img src="data:image/png;base64,${profile_photo}" alt="Profile Pic"></div>`
    : "";

  const mediaHTML = media
    ? `<div class="media-section"><img src="data:image/png;base64,${media}" style="width: 100px; height: 100px;"></div>`
    : "";

  const questionBoxHTML = `
    <div class="post-box">
      <div class="profile-section">
        ${profilePictureHTML}
        <p>${name}</p>
      </div>
      <div class="title-section">
        <h3>${title}</h3>
      </div>
      <div class="description-section">
        <p>${description}</p>
        ${mediaHTML}
      </div>
      <div class="like-section">
        <div class="heart-like-button" id="likebtn"></div>
        <span class="heart-count">${likes}</span>
      </div>
        <button class="ans-btn" onclick="redirectToAnswers(${id})">
          <img src="/images/answer.png" class="ans-img">
        </button>
      
      
      <div class="post-actions" onclick="redirect()">
        <div class="share-button">
          <img src="https://cdn2.iconfinder.com/data/icons/line-drawn-social-media/31/share-1024.png" height="30" width="30">
        </div>
        <div class="report-button" onclick="redirect()">
          <img src="https://cdn2.iconfinder.com/data/icons/user-interface-glyph-24/32/warning_danger_report-512.png" height="30" width="30">
        </div>
      </div>
    </div>
  `;

  const questionBox = document.createElement("div");
  questionBox.insertAdjacentHTML("beforeend", questionBoxHTML);

  // Add event listener to the like button
  const likeButton = questionBox.querySelector(".heart-like-button");
  likeButton.addEventListener("click", function () {
    // Toggle the 'liked' class for styling
    window.location.href = "/login";

    // Update like count within the current question box
  });

  questionBox.setAttribute("data-question-id", id);
  return questionBox;
}

function redirectToAnswers() {
  window.location.href = "/login";
}
function redirect() {
  window.location.href = "/login";
}

document.addEventListener("DOMContentLoaded", function () {
  const questionContainer = document.querySelector(".content");

  // Fetch questions from the server
  fetch("/homepage/getQuestions")
    .then((response) => response.json())
    .then((questions) => {
      questions.forEach((questionData) => {
        const questionBox = createQuestionBox(questionData);
        questionContainer.appendChild(questionBox);
      }, console.log("Enjoy Running"));
    })
    .catch((error) => console.error("Error fetching questions:", error));
});
