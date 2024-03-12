$(document).ready(function () {
  $("#searchInput").on("input", function () {
    document.getElementById("liveSearchResults").style.display = "block";
    var searchTerm = $(this).val();

    if (searchTerm.length >= 3) {
      $.ajax({
        url: "/search/liveSearch",
        type: "post",
        data: { searchTerm: searchTerm },
        dataType: "json",
        success: function (data) {
          // Clear previous results
          $("#liveSearchResults").html("");

          // DIPLAYING OUTPUT WITH CONDITION
          if (data.length > 0) {
            $.each(data, function (index, user) {
              var userDiv = $(
                '<div class="profile-link" data-userid="' +
                  user.id +
                  '">' +
                  user.name +
                  "</div>"
              );
              $("#liveSearchResults").append(userDiv);

              // REDIRECT LINK OF USERS PAGE
              userDiv.on("click", function () {
                window.location.href = "/visitprofile/" + user.username;
                console.log(user.username);
              });
            });
          } else {
            $("#liveSearchResults").html("<div>No Users found</div>");
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });
});

document.getElementById("showQuestions").addEventListener("click", function () {
  document.getElementById("questionsContainer").style.display = "grid";
  document.getElementById("answersContainer").style.display = "none";

  this.classList.add("border-blue-500");
  this.nextElementSibling.classList.remove("border-green-500");
});

document.getElementById("showAnswers").addEventListener("click", function () {
  document.getElementById("questionsContainer").style.display = "none";
  document.getElementById("answersContainer").style.display = "grid";

  this.classList.add("border-green-500");
  this.previousElementSibling.classList.remove("border-blue-500");
});
$(document).ready(function () {
  $("#followBtn").on("click", function () {
    var userId = $(this).data("user-id");
    var followerId = $(this).data("followed-user-id");

    $.ajax({
      url: "/follower/followAction",
      method: "POST",
      data: { userId: userId, followerId: followerId },
      success: function (response) {
        // Toggle button text based on response
        if (response.status === "followed") {
          $("#followBtn").text("Following");
        } else if (response.status === "unfollowed") {
          $("#followBtn").text("Follow");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });
});

document.getElementById("showQuestions").addEventListener("click", function () {
  document.getElementById("questionsContainer").style.display = "grid";
  document.getElementById("answersContainer").style.display = "none";

  this.classList.add("border-blue-500");
  this.nextElementSibling.classList.remove("border-green-500");
});

document.getElementById("showAnswers").addEventListener("click", function () {
  document.getElementById("questionsContainer").style.display = "none";
  document.getElementById("answersContainer").style.display = "grid";

  this.classList.add("border-green-500");
  this.previousElementSibling.classList.remove("border-blue-500");
});
