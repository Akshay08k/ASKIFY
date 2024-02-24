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
                window.location.href = "/visitprofile/" + user.id;
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
