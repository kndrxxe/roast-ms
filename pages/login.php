<?php
session_start();
require_once "../config.php"; // Secure database connection

// Redirect logged-in users to their respective dashboard
if (isset($_SESSION['username'])) {
  switch ($_SESSION['role']) {
    case 'Administrator':
      header("Location: /roast-ms/pages/admin/dashboard.php");
      break;
    case 'Manager':
      header("Location: /roast-ms/pages/manager/manager_dashboard.php");
      break;
    case 'Accountant':
      header("Location: /roast-ms/pages/accountant/accountant_dashboard.php");
      break;
    case 'Staff':
      header("Location: /roast-ms/pages/barista/barista_dashboard.php");
      break;
  }
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ROAST-MS | Sign In</title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="ROAST-MS" />
  <meta name="author" content="Author" />
  <!--end::Primary Meta Tags-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->
  <!--begin::Required Plugin(AdminLTE)-->
  <!--<link rel="stylesheet" href="../../dist/css/login-register.css" /> -->
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/adminlte.css" />
  <link rel="stylesheet" href="../assets/css/login-register.css" />
  <link rel="stylesheet" href="../assets/css/validate.css" />
  <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
  <!--end::Required Plugin(AdminLTE)-->
  <!-- JQuery JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Toastr CSS & JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary animate__animated animate__fadeIn">
  <div class="login-box">
    <div class="card card-outline card-dark rounded-5" >
      <div class="d-flex justify-content-center pb-0 pt-3">
        <img src="/roast-ms/assets/images/logo.png" alt="ROAST-MS Logo" width="80">
      </div>
      <div class="card-header py-2">
        <h1 class="mt-0 text-center"><b>Sign In</b></h1>
      </div>
      <div class="card-body login-card-body rounded-5">
        <form action="/roast-ms/api/login" method="post" class="needs-validation" novalidate>
          <div class="input-group mb-3">
            <input id="username" type="text" name="username"
              value="<?php echo isset($_SESSION['entered_username']) ? htmlspecialchars($_SESSION['entered_username']) : ''; ?>"
              onkeypress="return noSpace(event)" class="form-control form-control-md rounded-start-4" value="" placeholder="Username"
              required />
            <div class="input-group-text rounded-end-4"><span class="bi bi-person-lines-fill"></span></div>
            <div class="invalid-feedback">
              Please enter your username!
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" name="password" onkeypress="return noSpace(event)"
              class="form-control form-control-md rounded-start-4" placeholder="Password" required />
            <div class="input-group-text rounded-end-4"><span class="bi bi-lock-fill"></span></div>
            <div class="invalid-feedback">
              Please enter your password!
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12 my-3">
            <div class="d-grid gap-2">
              <button type="submit" class="btn rounded-4" id="loginButton">
              <span id="loader" class="spinner-border spinner-border-sm d-none" role="status"
              aria-hidden="true"></span>
                <span id="buttonText">Sign In</span>
              </button>
            </div>
          </div>
          <!-- /.col -->
          <!--end::Row-->
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="/roast-ms/assets/js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
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
  <!--end::OverlayScrollbars Configure-->
  <!--end::Script-->
</body>
<!--end::Body-->

</html>