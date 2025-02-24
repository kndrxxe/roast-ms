<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Register | ROAST-MS</title>
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
  <!--<link rel="stylesheet" href="../../dist/css/login-register.css" />-->
  <link rel="stylesheet" href="/roast-ms/dist/css/style.css" />
  <link rel="stylesheet" href="/roast-ms/dist/css/login-register.css" />
  <link rel="stylesheet" href="/roast-ms/dist/css/adminlte.css" />
  <!--end::Required Plugin(AdminLTE)-->
  <!-- JQuery JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Toastr CSS & JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="register-page bg-body-secondary">
  <div class="register-box">
    <!-- /.register-logo -->
    <div class="card card-outline card-dark">
      <div class="card-header">
        <h1 class="mb-0 text-center"><b>Register</b></h1>
      </div>
      <div class="card-body register-card-body">
        <form action="/roast-ms/dist/api/create_user" method="post">
          <div class="input-group mb-2">
            <div class="form-floating">
              <input id="name" type="text" name="name" value="<?php echo isset($_SESSION['entered_name']) ? htmlspecialchars($_SESSION['entered_name']) : ''; ?>" onkeypress="return noNumber(event)" class="form-control"
                placeholder="" required />
              <label for="name">Full Name</label>
            </div>
            <div class="input-group-text"><span class="bi bi-person"></span></div>
          </div>
          <div class="input-group mb-2">
            <div class="form-floating">
              <select class="form-select" id="role" name="role">
              <option value="">Select from options</option>
              </select>
              <label for="role">Role</label>
            </div>
            <div class="input-group-text"><span class="bi bi-person-gear"></span></div>
          </div>
          <div class="input-group mb-2">
            <div class="form-floating">
              <input id="username" name="username" value="<?php echo isset($_SESSION['entered_username']) ? htmlspecialchars($_SESSION['entered_username']) : ''; ?>" type="text" onkeypress="return noSpace(event)" class="form-control"
                placeholder="" required />
              <label for="username">Username</label>
            </div>
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
          </div>
          <div class="input-group mb-2">
            <div class="form-floating">
              <input id="password" name="password" type="password" onkeypress="return noSpace(event)"
                class="form-control" placeholder="" required />
              <label for="password">Password</label>
            </div>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>
          <!--begin::Row-->
          <div class="form-check my-2">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="showPassword()" />
            <label class="form-check-label" for="flexCheckDefault">Show Password</label>
          </div>
          <!-- /.col -->
          <div class="col-12 my-3">
            <div class="d-grid gap-2">
              <button type="submit" class="btn">Register</button>
            </div>
          </div>
          <!-- /.col -->
          <!--end::Row-->
        </form>
        <hr class="my-3">
        <p class="mb-2 text-center">
          <a href="./login" class="link-dark text-decoration-none"> I already have a membership </a>
        </p>
      </div>
      <!-- /.register-card-body -->
    </div>
  </div>
  <!-- /.register-box -->
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
  <script src="/roast-ms/dist/js/adminlte.js"></script>
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

      if (isset($_SESSION['userexists'])) {
        echo "toastr.error('" . $_SESSION['userexists'] . "', 'Registration Failed');";
        unset($_SESSION['userexists']);
      }
      ?>
    });
  </script>
  <script src="/roast-ms/dist/js/script.js"></script>
  <!--end::OverlayScrollbars Configure-->
  <!--end::Script-->
</body>
<!--end::Body-->

</html>