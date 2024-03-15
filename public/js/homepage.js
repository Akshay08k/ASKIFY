function openPopup(popupId) {
  var popups = document.querySelectorAll(".popup");
  popups.forEach(function (popup) {
    popup.style.opacity = 0;
    popup.style.display = "none";
  });

  // Open the specified popup
  var popup = document.getElementById(popupId);
  popup.style.display = "block";
  setTimeout(function () {
    popup.style.opacity = 1;
  }, 5);
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
  var createPostPopup = document.getElementById("createPostPopup");
  createPostPopup.style.opacity = 0;
  setTimeout(function () {
    createPostPopup.style.display = "none";
  }, 30); // Adjust the duration to match the transition time
});

document.getElementById("queclsbtn").addEventListener("click", function () {
  var askQuestionPopup = document.getElementById("askQuestionPopup");
  askQuestionPopup.style.opacity = 0;
  setTimeout(function () {
    askQuestionPopup.style.display = "none";
  }, 300);
});

function shareQuestionLink(questionId) {
  const questionLink = window.location.origin + `/answers?id=${questionId}`;
  const tempInput = document.createElement("input");
  tempInput.value = questionLink;
  document.body.appendChild(tempInput);
  tempInput.select();
  tempInput.setSelectionRange(0, 99999);
  document.execCommand("copy");
  document.body.removeChild(tempInput);
  alert("Question link copied to clipboard!");
}
function createQuestionBox(data) {
  const { name, title, description, profile_photo, likes, id, media } = data;

  const mediaHTML = media
    ? `<div class="media-section"><img src="/uploads/questionimages/${media}"></div>`
    : "";

  const profilePictureHTML = profile_photo
    ? `<div class="profile-picture"><img src="/uploads/userprofilephotos/${profile_photo}" alt="Profile Pic"></div>`
    : " ";

  const questionBoxHTML = `
    <div class="post-box">
      <div class="profile-section">
        ${profilePictureHTML}
        <p class="opacity-80">${name}</p>
      </div>
      <div class="title-section">
        <h3 class="font-bold">${title}</h3>
      </div>
    <div class="description-section">
      <p>${description ? description : ""}</p>
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
      <div class="report-button" onclick="openReportModal(${id})">
      <img src="report.png" height="30" width="30">
      </div>
      <div class="share-button" onclick="shareQuestionLink(${id})">
        <img src="/share.png" height="30" width="30">
      </div>
      </div>
    </div>
  `;

  const questionBox = document.createElement("div");
  questionBox.insertAdjacentHTML("beforeend", questionBoxHTML);

  // Add event listener to the like button
  const likeButton = questionBox.querySelector(".heart-like-button");
  const likeCount = questionBox.querySelector(".heart-count");

  // Function to check user's like status for the current question
  const checkUserLikeStatusQuestion = () => {
    fetch(`/homepage/checkUserLikeStatus/${id}`)
      .then((response) => response.json())
      .then((data) => {
        const userLiked = data.userLiked;

        if (userLiked) {
          likeButton.classList.add("liked");
        } else {
          likeButton.classList.remove("liked");
        }
      })
      .catch((error) =>
        console.error("Error checking user's like status:", error)
      );
  };

  // Call the function to check user's like status when creating the question box
  checkUserLikeStatusQuestion();

  likeButton.addEventListener("click", function () {
    // Toggle the 'liked' class for styling
    likeButton.classList.toggle("liked");

    // Update like count within the current question box
    let currentLikes = parseInt(likeCount.textContent);

    // Determine the new like count based on the 'liked' class
    const newLikes = likeButton.classList.contains("liked")
      ? currentLikes + 1
      : Math.max(0, currentLikes - 1);

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

  questionBox.setAttribute("data-question-id", id);
  return questionBox;
}
let questionContainer = document.querySelector(".content");

function redirectToAnswers(id) {
  window.location.href = `/answers?id=${id}`;
}
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}
function loadAllQuestions() {
  fetch("/homepage/getQuestions")
    .then((response) => response.json())
    .then((questions) => {
      // Shuffle the array of questions
      const shuffledQuestions = shuffleArray(questions);

      // Clear existing content
      questionContainer.innerHTML = "";

      // Display questions
      shuffledQuestions.forEach((question) => {
        const questionBox = createQuestionBox(question);
        questionContainer.appendChild(questionBox);
      });
    })
    .catch((error) => console.error("Error fetching questions:", error));
}

document.addEventListener("DOMContentLoaded", function () {
  // Load all questions
  loadAllQuestions();
});

// Example function to simulate liking a question
function likeQuestion(questionId) {
  likedQuestionIds.push(questionId);
}

// Function to log categoryId and dynamically add HTML
function logCategoryId(categoryId) {
  const questionContainer = document.querySelector(".content");

  // Fetch all questions from the server
  fetch("/homepage/getQuestions")
    .then((response) => response.json())
    .then((questions) => {
      // console.log("Fetched Questions:", questions);

      // Filter questions based on the desired categoryId
      const filteredQuestions = questions.filter(
        (question) => question.category_id == categoryId
      );

      // console.log("Filtered Questions:", filteredQuestions);

      // Clear the existing questions in the container
      questionContainer.innerHTML = "";

      // Iterate through filtered questions and create question boxes
      filteredQuestions.forEach((questionData) => {
        const questionBox = createQuestionBox(questionData);
        questionContainer.appendChild(questionBox);
      });
      console.log(filteredQuestions == [""]);

      // Fetch category information
      fetch("/homepage/getcategories")
        .then((response) => response.json())
        .then((categories) => {
          // console.log("Fetched Categories:", categories);

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
          categoryImg.src = "/uploads/categoryimages/" + base64ImageData;
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

//Report Function
document.addEventListener("DOMContentLoaded", function () {
  // Your existing code here

  // Add event listener to a parent element that is present in the DOM
  document
    .querySelector(".content")
    .addEventListener("click", function (event) {
      const target = event.target;

      // Check if the clicked element is a report button
      if (target.classList.contains("report-button")) {
        openReportModal();
      }

      // Add other conditions for different buttons if needed
    });
});

function openReportModal(id) {
  document.getElementById("reportModal").setAttribute("data-question-id", id);
  document.getElementById("reportModal").style.display = "block";
}

function closeReportModal() {
  document.getElementById("reportModal").style.display = "none";
}

function submitReport() {
  const reportReason = document.getElementById("reportReason").value;
  const questionId = document
    .getElementById("reportModal")
    .getAttribute("data-question-id");

  fetch(`/report/question/${questionId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ reason: reportReason }),
  })
    .then((response) => response.json())
    .then((result) => {
      // Handle the server response as needed
      console.log("Report submitted successfully", result);
      closeReportModal();
    })
    .catch((error) => console.error("Error submitting report:", error));
}
$(document).ready(function () {
  $("#searchInput").on("input", function () {
    document.getElementById("liveSearchResults").style.display = "block";
    var searchTerm = $(this).val();

    if (searchTerm.length >= 3) {
      $.ajax({
        url: "homepage/search/liveSearch", // Assuming the correct URL for question search
        type: "post",
        data: { searchTerm: searchTerm },
        dataType: "json",
        success: function (data) {
          // Clear previous results
          $("#liveSearchResults").html("");

          // Process and display the new results
          if (data.length > 0) {
            $.each(data, function (index, question) {
              // Customize the display based on your need
              var questionDiv = $(
                '<div class="question-link" data-questionid="' +
                  question.id +
                  '">' +
                  "<h4>" +
                  question.title +
                  "</h4>" +
                  "<p>" +
                  question.description +
                  "</p>" +
                  "</div>"
              );
              $("#liveSearchResults").append(questionDiv);

              // Add click event to redirect to question page
              questionDiv.on("click", function () {
                window.location.href = "/answers?id=" + question.id;
              });
            });
          } else {
            $("#liveSearchResults").html("<div>No Questions found</div>");
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });
});
