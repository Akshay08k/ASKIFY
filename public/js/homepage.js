function createQuestionBox(data) {
  const { username, title, description ,profile_photo} = data;


  const questionBox = document.createElement("div");
  questionBox.classList.add("post-box");

  const profileSection = document.createElement("div");
  profileSection.classList.add("profile-section");

  const profilePicture = document.createElement("div");
  profilePicture.classList.add("profile-picture");
  const img = document.createElement("img");
  img.src = data.profile_photo; 
  img.alt = "User Profile Picture";
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
  answerButton.textContent = "Answer ";
  answerButton.classList = "ans-btn";

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
  questionBox.appendChild(descriptionSection);
  questionBox.appendChild(postActions);
  questionBox.appendChild(shareButton);

  return questionBox;
}

document.addEventListener("DOMContentLoaded", function () {
  const questionContainer = document.querySelector(".content");

  // Fetch questions from the server
  fetch("/homepage/getQuestions") // Adjust the URL based on your routes
    .then((response) => response.json())
    .then((questions) => {
      // Loop through each question data and create question boxes dynamically
      questions.forEach((questionData) => {
        const questionBox = createQuestionBox(questionData);
        questionContainer.appendChild(questionBox);
      });
    })
    .catch((error) => console.error("Error fetching questions:", error));
});
