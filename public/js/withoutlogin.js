$(document).ready(function () {
  $("#searchInput").on("input", function () {
    document.getElementById("liveSearchResult").style.display = "block";
    var searchTerm = $(this).val();

    if (searchTerm.length >= 3) {
      $.ajax({
        url: "homepage/search/liveSearch", // Assuming the correct URL for question search
        type: "post",
        data: { searchTerm: searchTerm },
        dataType: "json",
        success: function (data) {
          // Clear previous results
          $("#liveSearchResult").html("");

          // Process and display the new results
          if (data.length > 0) {
            $.each(data, function (index, question) {
              // Customize the display based on your need
              console.log(data);
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
              $("#liveSearchResult").append(questionDiv);

              // Add click event to redirect to question page
              questionDiv.on("click", function () {
                window.location.href = "/answers?id=" + question.id;
              });
            });
          } else {
            $("#liveSearchResult").html("<div>No Questions found</div>");
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });
});
