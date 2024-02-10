function openPopup(popupId) {
  var popups = document.querySelectorAll(".popup");
  popups.forEach(function (popup) {
    popup.style.display = "none";
  });

  // Open the specified popup
  document.getElementById(popupId).style.display = "block";
}

document
  .getElementById("askQuestionBtn")
  .addEventListener("click", function () {
    openPopup("askQuestionPopup");
  });

document.getElementById("createPostBtn").addEventListener("click", function () {
  openPopup("createPostPopup");
});

document.getElementById("postclsbtn").addEventListener("click", function () {
  document.getElementById("createPostPopup").style.display = "none";
});
document.getElementById("queclsbtn").addEventListener("click", function () {
  document.getElementById("askQuestionPopup").style.display = "none";
});
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
      
      
      <div class="post-actions">
        <div class="share-button">
          <img src="https://cdn2.iconfinder.com/data/icons/line-drawn-social-media/31/share-1024.png" height="30" width="30">
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
        // console.log("Updated likes in the database:", updatedLikes);
        // printing the status of like did or not in the database
      })
      .catch((error) => console.error("Error updating like count:", error));
  });

  return questionBox;
}

function redirectToAnswers(id) {
  window.location.href = `/answers?id=${id}`;
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

// Function to log categoryId and dynamically add HTML
function logCategoryId(categoryId) {
  const questionContainer = document.querySelector(".content");

  // Fetch all questions from the server
  fetch("/homepage/getQuestions")
    .then((response) => response.json())
    .then((questions) => {
      console.log("Fetched Questions:", questions);

      // Filter questions based on the desired categoryId
      const filteredQuestions = questions.filter(
        (question) => question.category_id == categoryId
      );

      console.log("Filtered Questions:", filteredQuestions);

      // Clear the existing questions in the container
      questionContainer.innerHTML = "";

      // Iterate through filtered questions and create question boxes
      filteredQuestions.forEach((questionData) => {
        const questionBox = createQuestionBox(questionData);
        questionContainer.appendChild(questionBox);
      });

      // Fetch category information
      fetch("/homepage/getcategories")
        .then((response) => response.json())
        .then((categories) => {
          console.log("Fetched Categories:", categories);

          // Find the category with the specified ID
          const selectedCategory = categories.find(
            (category) => category.id == categoryId
          );

          if (!selectedCategory) {
            console.error("Category not found");
            return;
          }

          // Create HTML elements for the dynamically added section
          const dynamicSection = document.querySelector(".categorybox");

          // Clear existing content in dynamic section
          dynamicSection.innerHTML = "";

          const mainCategoryBox = document.createElement("div");
          mainCategoryBox.className = "main-categorybox";

          const categoryBox = document.createElement("div");
          categoryBox.className = "category-box";

          const categoryImg = document.createElement("img");
          const base64ImageData = selectedCategory.image; // Replace with your actual base64-encoded image data
          categoryImg.src = "data:image/jpeg;base64," + base64ImageData;
          categoryImg.alt = "Cat Image";
          categoryImg.width = 100;

          const categoryInfo = document.createElement("div");
          categoryInfo.className = "category-info";

          const categoryName = document.createElement("div");
          categoryName.className = "category-name";
          categoryName.textContent = selectedCategory.name;

          // Append created elements to form the structure
          categoryInfo.appendChild(categoryName);
          categoryBox.appendChild(categoryImg);
          categoryBox.appendChild(categoryInfo);
          mainCategoryBox.appendChild(categoryBox);
          dynamicSection.appendChild(mainCategoryBox);
        })
        .catch((error) => console.error("Error fetching categories:", error));
    })
    .catch((error) => console.error("Error fetching questions:", error));
}
