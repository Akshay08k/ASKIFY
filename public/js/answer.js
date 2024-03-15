function createAnswerBox(data) {
  const { username, answer, profile_photo, likes, id } = data;
  const answerBox = document.createElement("div");
  answerBox.classList.add("answer-box");

  const checkUserLikeStatusAnswer = () => {
    fetch(`/answers/checkUserLikeStatus/${id}`)
      .then((response) => response.json())
      .then((userData) => {
        const userLiked = userData.userLiked;
        // console.log("User Liked:", userLiked);

        const likeButton = answerBox.querySelector(".answer-heart-like-button");

        if (userLiked) {
          // console.log("Applying 'liked' class");
          likeButton.classList.add("liked");
        } else {
          // console.log("Removing 'liked' class");
          likeButton.classList.remove("liked");
        }
      })
      .catch((error) =>
        console.error("Error checking user's like status:", error)
      );
  };

  // HTML content for the answer box
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
    <div class="answer-like-section">
      <div class="answer-heart-like-button" ></div>
      <span class="answer-heart-count">${likes}</span>
    </div>
    <div class="answer-section">
      <p>${answer}</p>
    </div>
  `;

  // Set HTML content using innerHTML
  answerBox.innerHTML = answerBoxHTML;

  checkUserLikeStatusAnswer();

  // Event listener for like button
  const likeButton = answerBox.querySelector(".answer-heart-like-button");
  const likeCount = answerBox.querySelector(".answer-heart-count");

  likeButton.addEventListener("click", function () {
    // Toggle the 'liked' class for styling
    likeButton.classList.toggle("liked");

    // Update like count within the current answer box
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
      { method: "POST" }
    )
      .then((response) => response.json())
      .then((updatedLikes) => {
        // Log the updated likes count
        console.log("Updated likes in the database:", updatedLikes);
      })
      .catch((error) => console.error("Error updating like count:", error));
  });

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

//questions data generation

document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const questionId = urlParams.get("id");

  if (questionId) {
    fetch("/homepage/getQuestions")
      .then((response) => response.json())
      .then((questions) => {
        const selectedQuestion = questions.find(
          (question) => question.id === questionId
        );

        if (selectedQuestion) {
          const questionBox = createQuestionBox(selectedQuestion);
          const questionContainer = document.querySelector(".content");
          questionContainer.appendChild(questionBox);
        } else {
          console.error("Question not found with the specified ID.");
        }
      })
      .catch((error) => console.error("Error fetching questions:", error));
  } else {
    console.error("Question ID not found in the URL.");
  }
});
function createQuestionBox(data) {
  const { name, title, description, profile_photo, likes, id } = data;
  // console.log(data);
  const questionBoxHTML = `
    <div class="post-box">
      <div class="profile-section">
        <div class="profile-picture">
          <img src="${
            profile_photo
              ? `data:image/png;base64,${profile_photo}`
              : "path/to/default/profile/photo.jpg"
          }" alt="User">
        </div>
        <p>${name}</p>
      </div>
      <div class="title-section">
        <h3>${title}</h3>
      </div>
      <div class="description-section">
        <p>${description}</p>
      </div>
      <div class="like-section">
        <div class="question-heart-like-button"></div>
        <span class="question-heart-count">${likes}</span>
      </div>
      <div class="share-button">
        <img src="https://cdn2.iconfinder.com/data/icons/line-drawn-social-media/31/share-1024.png" height="30" width="30">
      </div>
    </div>
  `;

  const questionBox = document.createElement("div");
  questionBox.insertAdjacentHTML("beforeend", questionBoxHTML);
  let hidden = document.getElementById("questionid");
  hidden.value = id;
  // Event listener for like button
  const likeButton = questionBox.querySelector(".question-heart-like-button");
  const likeCount = questionBox.querySelector(".question-heart-count");

  // Function to check user's like status for the current question
  const checkUserLikeStatus = () => {
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
        console.error("Error checking user like status:", error)
      );
  };

  // Call the function to check user's like status when creating the question box
  checkUserLikeStatus();

  likeButton.addEventListener("click", function () {
    // Toggle the 'liked' class for styling
    likeButton.classList.toggle("liked");

    // Update like count within the current question box
    const currentLikes = parseInt(likeCount.textContent);

    // Determine the new like count based on the 'liked' class
    const newLikes = likeButton.classList.contains("liked")
      ? currentLikes + 1
      : currentLikes - 1;

    // Update the displayed like count
    likeCount.textContent = newLikes;
    console.log(id);
    // Send a request to the server to update the like count in the database
    fetch(
      `/homepage/updateLikeCount/${id}/${likeButton.classList.contains(
        "liked"
      )}`,
      { method: "POST" }
    )
      .then((response) => response.json())
      .then((updatedLikes) => {
        // You can handle the response if needed
        console.log("Updated likes in the database:", updatedLikes);
      })
      .catch((error) => console.error("Error updating like count:", error));
  });

  return questionBox;
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
