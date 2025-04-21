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

function goBack() {
  window.history.back();
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

document.getElementById("loginButton").addEventListener("click", function (event) {
  event.preventDefault(); // Prevent default form submission

  let btn = this;
  let loader = document.getElementById("loader");
  let buttonText = document.getElementById("buttonText");
  let form = document.querySelector(".needs-validation"); // Ensure the form has this class

  // Check form validity
  if (!form.checkValidity()) {
    form.classList.add("was-validated"); // Apply Bootstrap validation styles
    return; // Stop submission if invalid
  }

  // If valid, disable button and show loader
  btn.disabled = true;
  loader.classList.remove("d-none");
  buttonText.textContent = "Logging in ...";

  // Submit the form after a slight delay
  setTimeout(() => {
    form.submit();
  }, 1000);
});