function createQuestionBox(data) {
  const { username, title, description, profile_photo, likes, id } = data;

  const questionBox = document.createElement("div");
  questionBox.classList.add("post-box");

  const profileSection = document.createElement("div");
  profileSection.classList.add("profile-section");

  const profilePicture = document.createElement("div");
  profilePicture.classList.add("profile-picture");
  const img = document.createElement("img");

  const likeSection = document.createElement("div");
  likeSection.classList.add("like-section");
  const likeButton = document.createElement("div");
  likeButton.classList.add("heart-like-button");
  likeButton.addEventListener("click", function () {
    // Toggle the 'liked' class for styling
    likeButton.classList.toggle("liked");

    // Update like count within the current question box
    const likeCount = questionBox.querySelector(".heart-count");
    const currentLikes = parseInt(likeCount.textContent);

    // Determine the new like count based on the 'liked' class
    const newLikes = likeButton.classList.contains("liked")
      ? currentLikes + 1
      : currentLikes - 1;

    // Update the displayed like count
    likeCount.textContent = newLikes;

    // Send a request to the server to update the like count in the database
    fetch(
      `/homepage/updateLikeCount/${id}/${
        likeButton.classList.contains("liked") ? "true" : "false"
      }`,
      { method: "POST" }
    )
      .then((response) => response.json())
      .then((updatedLikes) => {
        // You can handle the response if needed
        console.log("Updated likes in the database:", updatedLikes);
      })
      .catch((error) => console.error("Error updating like count:", error));
  });
  const likeCount = document.createElement("span");
  likeCount.classList.add("heart-count");
  likeCount.textContent = likes;
  likeSection.appendChild(likeButton);
  likeSection.appendChild(likeCount);

  if (profile_photo) {
    img.src = `data:image/png;base64,${profile_photo}`;
  }
  img.alt = "User";
  profilePicture.appendChild(img);

  const profileName = document.createElement("p");
  profileName.textContent = username;

  profileSection.appendChild(profilePicture);
  profileSection.appendChild(profileName);

  // Title Section
  const titleSection = document.createElement("div");
  titleSection.classList.add("title-section");
  const titleElement = document.createElement("h3");
  titleElement.textContent = title;
  titleSection.appendChild(titleElement);

  // Question Description Section
  const descriptionSection = document.createElement("div");
  descriptionSection.classList.add("description-section");
  const descriptionElement = document.createElement("p");
  descriptionElement.textContent = description;
  descriptionSection.appendChild(descriptionElement);

  const postActions = document.createElement("div");
  postActions.classList.add("post-actions");
  const answerButton = document.createElement("button");
  // Assuming 'public' is the base directory for your assets
  const imageUrl = "images/answer.png";
  answerButton.innerHTML = `<img src="${imageUrl}" class="ans-img">`;

  answerButton.classList.add("ans-btn");

  answerButton.addEventListener("click", function () {
    // Redirect to the answers page with the question ID as a query parameter
    window.location.href = `/answers?id=${id}`;
  });

  postActions.appendChild(answerButton);

  const shareButton = document.createElement("div");
  shareButton.classList.add("share-button");
  const shareBtn = document.createElement("img");
  shareBtn.src =
    "https://cdn2.iconfinder.com/data/icons/line-drawn-social-media/31/share-1024.png";
  shareBtn.height = 30;
  shareBtn.width = 30;

  shareButton.appendChild(shareBtn);

  // Append all sections to the question box
  questionBox.appendChild(profileSection);
  questionBox.appendChild(titleSection);
  questionBox.appendChild(likeSection);
  questionBox.appendChild(postActions);
  questionBox.appendChild(descriptionSection);
  questionBox.appendChild(postActions);
  questionBox.appendChild(shareButton);
  questionBox.appendChild(likeCount);

  return questionBox;
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
      });
    })
    .catch((error) => console.error("Error fetching questions:", error));
});
