// delete ajax call
$(document).ready(function () {
  $(".delete").click(function () {
    var id = $(this).data("id");
    var element = this;

    $.ajax({
      url: "function.php",
      type: "post",
      data: {
        id: id,
        op: "delete",
      },
      success: function (data) {
        if (data.trim() === "success") {
          alert("Your post has been deleted.");
          $(element).closest(".remove-article").fadeOut();
        } else {
          alert("Failed to delete the article.");
        }
      },
    });
  });

  // data filter
  $(".post-filter-form").on("submit", function (e) {
    e.preventDefault();
    var searchQuery = $(".search-article").val();
    var sortOrder = $(".sort-order").val();
    $.ajax({
      url: "function.php",
      type: "post",
      data: {
        search: searchQuery,
        sortOrder: sortOrder,
        op: "search-article",
      },
      success: function (data) {
        $(".append-article").html(data);
      },
    });
  });
});
