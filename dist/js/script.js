$(document).ready(function () {
  $.ajax({
    url: "/roast-ms/dist/api/fetch_roles.php", // Fetch data from PHP file
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#role").html(
        '<option value="">Select from options</option>'
      ); // Reset dropdown
      $.each(data, function (index, value) {
        $("#role").append(
          '<option value="' + value + '">' + value + "</option>"
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error loading data:", error);
    },
  });

  // Set the current year dynamically
  var currentYear = new Date().getFullYear();
  var yearElement = document.getElementById("year");
  if (yearElement) {
    yearElement.textContent = currentYear;
  }
});

function noSpace(event) {
  if (event.key === " ") {
    return false; // Block space key
  }
  return true;
}

function noNumber(event) {
  if (event.key >= "0" && event.key <= "9") {
    return false; // Block number keys
  }
  return true;
}

function showPassword() {
  var pass = document.getElementById("password");
  if (pass.type === "password") {
    pass.type = "text";
  } else {
    pass.type = "password";
  }
}