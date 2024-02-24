function createQuestionBox(data) {
  const { name, title, description, profile_photo, likes, id, media } = data;

  const profilePictureHTML = profile_photo
    ? `<div class="profile-picture"><img src="data:image/png;base64,${profile_photo}" alt="Profile Pic"></div>`
    : "";

  const mediaHTML = media
    ? `<div class="media-section"><img src="data:image/png;base64,${media}"></div>`
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
<p>${description ? description : ""}</p>
${mediaHTML}
</div>
<div class="like-section">
<div class="heart-like-button">Likes</div>
<span class="heart-count">${likes}</span>
</div>
<button class="ans-btn" onclick="redirectToAnswers(${id})">
<img src="/images/answer.png" class="ans-img">
</button>
<div class="post-actions">
<div class="delete-button"  onclick="deleteQuestion(${id})">
  <img src="/delete.png" height="30" width="30">
</div>

</div>
</div>
`;

  const questionBox = document.createElement("div");
  questionBox.insertAdjacentHTML("beforeend", questionBoxHTML);

  const likeButton = questionBox.querySelector(".heart-like-button");
  const likeCount = questionBox.querySelector(".heart-count");

  questionBox.setAttribute("data-question-id", id);
  return questionBox;
}

function redirectToAnswers(id) {
  window.location.href = `/answers?id=${id}`;
}

document.addEventListener("DOMContentLoaded", function () {
  const questionContainer = document.querySelector(".content");
  const userId = document.querySelector("#hidden").value;

  fetch("/homepage/getQuestions")
    .then((response) => response.json())
    .then((questions) => {
      // Filter questions based on user_id
      const userQuestions = questions.filter(
        (question) => question.user_id == userId
      );

      // Display filtered questions
      userQuestions.forEach((questionData) => {
        const questionBox = createQuestionBox(questionData);
        questionContainer.appendChild(questionBox);
      });
    })
    .catch((error) => console.error("Error fetching questions:", error));
});
function deleteQuestion(questionId) {
  fetch("/delete-question", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `question_id=${questionId}`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Question deleted successfully");
      } else {
        console.error("Failed to delete question");
      }
    })
    .catch((error) => console.error("Error deleting question:", error));
}
function createAnswerBox(data) {
  const { username, answer, profile_photo, likes, id } = data;
  const answerBox = document.createElement("div");
  answerBox.classList.add("answer-box");

  const answerBoxHTML = `
<div class="profile-section">
<div class="profile-picture">
<img src="${
    profile_photo
      ? `data:image/png;base64,${profile_photo}`
      : "path/to/default/profile/photo.jpg"
  }" alt="User">
</div>
<p>${username}</p>
</div>

<div class="answer-section">
<p>${answer}</p>
</div>
<div class="answer-like-section">
<span class="answer-heart-count">Likes : ${likes}</span>
</div>
<div class="delete-button"  onclick="deleteAnswer(${id})">
  <img src="https://th.bing.com/th/id/R.27299b1faed2d63a3e9512bd8cd187ad?rik=%2fVRT3CdCaWVC3w&riu=http%3a%2f%2fpluspng.com%2fimg-png%2fdelete-button-png-delete-icon-1600.png&ehk=mRIiUoExO9FPzeoYwqDk%2bfWDlxlcYGmfTbaQ2Pbwyak%3d&risl=&pid=ImgRaw&r=0" height="30" width="30">
</div>
`;

  answerBox.innerHTML = answerBoxHTML;

  return answerBox;
}

document.addEventListener("DOMContentLoaded", function () {
  const answerContainer = document.querySelector(".answer-container");

  const userIdInput = document.querySelector("#hidden");
  if (userIdInput) {
    const userId = userIdInput.value;

    fetch("/answers/getanswers")
      .then((response) => {
        console.log(response);
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
      })
      .then((allAnswers) => {
        // Filter answers based on the user_id
        const filteredAnswers = allAnswers.filter(
          (answer) => answer.user_id === userId
        );

        filteredAnswers.forEach((answerData) => {
          const answerBox = createAnswerBox(answerData);
          answerContainer.appendChild(answerBox);
        });
      })
      .catch((error) => {
        console.error("Error fetching answers:", error);
      });
  } else {
    console.error("User ID input not found.");
  }
});
function deleteAnswer(AnswerId) {
  fetch("/delete-answer", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `AnswerId=${AnswerId}`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Answer deleted successfully");
      } else {
        console.error("Failed to delete Answer");
      }
    });
  // .catch(error => console.error('Error deleting Answer:', error));
  // alert('Answer deleted successfully');
  window.location.reload();
}
