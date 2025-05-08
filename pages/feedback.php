<?php
session_start();
require_once "../config.php"; // Secure database connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Feedback | ROAST-MS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="ROAST-MS" />
    <meta name="author" content="Author" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/adminlte.css" />
    <link rel="stylesheet" href="../assets/css/login-register.css" />
    <link rel="stylesheet" href="../assets/css/validate.css" />
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="login-page bg-body-secondary animate__animated animate__fadeIn">
    <div class="login-box">
        <div class="card card-outline card-dark rounded-5">
            <div class="d-flex justify-content-center pb-0 pt-3">
                <img src="/roast-ms/assets/images/logo.png" alt="ROAST-MS Logo" width="60">
            </div>
            <div class="card-header py-2">
                <h1 class="mt-0 text-center fs-3"><b>Feedback Form</b></h1>
            </div>
            <div class="card-body login-card-body rounded-5">
                <form action="/roast-ms/pages/api/submit_feedback" method="POST" class="needs-validation" novalidate
                    id="feedbackForm">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Your Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required><label
                                for="star5">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
                        </div>
                        <div class="invalid-feedback">
                            Please select your rating.
                        </div>
                    </div>
                    <div class="input-group mb-2">
                        <input id="name" type="text" name="name" onkeypress="return noNumber(event)"
                            class="form-control form-control-sm rounded-4" value="" placeholder="Name" required />
                        <div class="invalid-feedback">
                            Please enter your name.
                        </div>
                    </div>

                    <div class="input-group mb-2">
                        <input id="email" type="text" name="email" onkeypress="return noSpace(event)"
                            class="form-control form-control-sm rounded-4" value="" placeholder="Email Address"
                            required />
                        <div class="invalid-feedback">
                            Please enter your email.
                        </div>
                    </div>

                    <div class="input-group mb-2">
                        <textarea id="comment" type="text" name="comment" class="form-control form-control-sm rounded-4"
                            value="" placeholder="Comment" required rows="2"></textarea>
                        <div class="invalid-feedback">
                            Please enter your comment.
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn rounded-4" id="submitfeedbackButton">
                                <span id="loader" class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                                <span id="buttonText">Submit Feedback</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="/roast-ms/assets/js/adminlte.js"></script>
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: false,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
            };

            <?php
            if (isset($_SESSION['registrationsuccess'])) {
                echo "toastr.success('" . $_SESSION['registrationsuccess'] . "', 'Registration Successful');";
                unset($_SESSION['registrationsuccess']);
            }

            if (isset($_SESSION['registrationfailed'])) {
                echo "toastr.error('" . $_SESSION['registrationfailed'] . "', 'Registration Failed');";
                unset($_SESSION['registrationfailed']);
            }

            if (isset($_SESSION['invalidpassword'])) {
                echo "toastr.error('" . $_SESSION['invalidpassword'] . "', 'Incorrect Password');";
                unset($_SESSION['invalidpassword']);
            }

            if (isset($_SESSION['usernotfound'])) {
                echo "toastr.error('" . $_SESSION['usernotfound'] . "', 'Login Error');";
                unset($_SESSION['usernotfound']);
            }
            ?>
        });
    </script>
    <script src="/roast-ms/assets/js/script.js"></script>
    <script>
        document.getElementById("submitfeedbackButton").addEventListener("click", function (event) {
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
            buttonText.textContent = "Submitting Feedback ...";

            // Submit the form after a slight delay
            setTimeout(() => {
                form.submit();
            }, 1000);
        });
    </script>
</body>

</html>