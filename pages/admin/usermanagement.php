<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/roast-ms/auth.php';
checkRole(['Administrator']); // Only Administrator can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>User Management | ROAST-MS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="ROAST-MS" />
  <meta name="author" content="Author" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <link rel="stylesheet" href="/roast-ms/assets/css/style.css" />
  <link rel="stylesheet" href="/roast-ms/assets/css/adminlte.css" />
  <link rel="stylesheet" href="/roast-ms/assets/css/validate.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
  <link rel="icon" href="/roast-ms/assets/images/logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <link rel="icon" href="/roast-ms/assets/images/logo.png" type="image/x-icon">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      new DataTable('#userTable', {
        dom: `<'d-flex justify-content-between mb-3 align-items-center'l<'d-flex align-items-center'<'d-none d-lg-block me-2'>f>>
                rt
                <'d-flex justify-content-between align-items-center mt-3'ip>
                `,
        buttons: ['copy',
          {
            extend: 'csv',
            title: '',
            messageTop: 'EMPLOYEE LIST - AXL ROSE CAFE',
            exportOptions: {
              columns: [2, 3, 4, 5]
            }
          },
          {
            extend: 'excel',
            title: '',
            messageTop: 'EMPLOYEE LIST - AXL ROSE CAFE',
            exportOptions: {
              columns: [2, 3, 4, 5]
            }
          },
          {
            extend: 'print',
            title: '',
            customize: function(win) {
              $(win.document.body)
                .css('font-size', '12pt')
                .prepend(
                  '<div style="text-align:center;"><img src="/roast-ms/assets/images/axl-rose-cafe.png" style="width:100px;" /></div>',
                  '<h3 style="text-align:center; margin-bottom:20px;">EMPLOYEE LIST</h3>'
                );
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', '14pt');
            },
            exportOptions: {
              columns: [2, 3, 4, 5]
            }
          }
        ],
        columnDefs: [{
          targets: [0, 1, 2, 3]
        }]
      });
    });
  </script>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
  <div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
            </a>
          </li>
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img src="/roast-ms/assets/images/default-150x150.png" class="user-image rounded-circle shadow"
                alt="User" />
              <span class="d-none d-md-inline"><?php echo getUsername(); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <li class="user-header text-bg-dark">
                <img src="/roast-ms/assets/images/default-150x150.png" class="rounded-circle shadow" alt="User" />
                <p>
                  <?php echo getFullname(); ?>
                  <small><?php echo getRole(); ?></small>
                </p>
              </li>
          </li>
          <li class="user-footer">
            <a href="/roast-ms/pages/admin/settings" class="btn btn-default btn-flat">Settings</a>
            <a href="/roast-ms/logout" class="btn btn-default btn-flat float-end">Log out</a>
          </li>
        </ul>
        </li>
        </ul>
      </div>
    </nav>
    <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a href="dashboard.php" class="brand-link">
          <img src="/roast-ms/assets/images/logo.png" alt="Logo" class="brand-image opacity-75 shadow" />
          <span class="brand-text fw-light">ROAST-MS</span>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user-panel py-2 d-flex align-items-center">
          <div class="image">
            <img width="50" src="/roast-ms/assets/images/default-150x150.png" class="rounded-circle shadow ms-1 me-2"
              alt="User Image">
          </div>
          <div class="info">
            <a
              class="d-block nav-link text-light brand-text text-decoration-none overflow-hidden text-nowrap lh-1 fs-5 fw-bold">WELCOME<br><span
                class="fw-light fs-7"><?php echo getFullname(); ?></span></a>
          </div>
        </div>
        <hr class="text-secondary my-2">
        <nav class="mt-3">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-header">PAYROLL AND ATTENDANCE</li>
            <li class="nav-item">
              <a href="dtr.php" class="nav-link">
                <i class="nav-icon bi bi-calendar3"></i>
                <p>DTR & Payroll</p>
              </a>
            </li>
            <li class="nav-header">SALES AND ANALYTICS</li>
            <li class="nav-item">
              <a href="salestracking.php" class="nav-link">
                <i class="nav-icon bi bi-clipboard-data"></i>
                <p>Sales Tracking and Forecasting</p>
              </a>
            </li>
            <li class="nav-header">FEEDBACK</li>
            <li class="nav-item">
              <a href="feedback.php" class="nav-link">
                <i class="nav-icon bi bi-chat-left-quote"></i>
                <p>Customer Feedback</p>
              </a>
            </li>
            <li class="nav-header">INVENTORY</li>
            <li class="nav-item">
              <a href="inventory.php" class="nav-link">
                <i class="nav-icon bi bi-list-check"></i>
                <p>Inventory Management</p>
              </a>
            </li>
            <li class="nav-header">USERS</li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="nav-icon bi bi-person-gear"></i>
                <p>User Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="audit-trail.php" class="nav-link">
                <i class="nav-icon bi bi-clipboard-pulse"></i>
                <p>Audit Trail</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0 fw-bold">User Management</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Management</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-end mb-3 gap-2">
            <div class=" d-flex justify-content-end align-items-center gap-2">
              <label for="roleFilter" class="form-label">Filter:</label>
              <select id="roleFilter" class="form-select" style="width:150px; border: 1px solid #212529; box-shadow: none;">
                <option value="" selected disabled hidden>Roles</option>
                <option value="">All Roles</option>
                <option value="Barista">Barista</option>
                <option value="Manager">Manager</option>
              </select>
            </div>
            <button type="button" class="btn btn-md btn-dark fw-bold" data-bs-toggle="modal"
              data-bs-target="#addUserModal"><i class="bi bi-plus-circle">
              </i> Add User
            </button>
          </div>
          <div class="table-responsive">
            <div class="data_table">
              <table id="userTable" class="table table-hover table-bordered" style="width:100%">
                <thead>
                  <tr class="fs-6">
                    <th class="text-start">ID</th>
                    <th class="text-start">Picture</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th class="text-start">Date Created</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result = $conn->prepare("SELECT * FROM users WHERE role IN ('Manager', 'Barista')");
                  $result->execute();
                  $data = $result->get_result();
                  while ($row = $data->fetch_assoc()):
                  ?>
                    <tr class="fs-6">
                      <td class="text-center"><?= htmlspecialchars($row['id']) ?></td>
                      <td class="text-center">
                        <img src="<?= htmlspecialchars(!empty($row['picture']) ? $row['picture'] : '/roast-ms/assets/images/default-150x150.png') ?>"
                          alt="Profile Picture"
                          class="rounded-circle border border-1"
                          width="50" height="50">
                      </td>
                      <td class="text-center"><?= htmlspecialchars($row['name']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($row['username']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($row['role']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($row['created_at']) ?></td>
                      <td class="text-center">
                        <div class="btn-group me-2">
                          <button type="button" class="btn btn-dark editbtn">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <button type="button" class="btn btn-dark deletebtn">
                            <i class="bi bi-trash-fill"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- ADD User Modal -->
          <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/roast-ms/pages/admin/api/create_user" method="POST" class="needs-validation" novalidate>
                  <div class="modal-body">
                    <div class="form-floating mb-3">
                      <input id="updateService" type="text" name="name" maxlength="100"
                        class="form-control form-control-md rounded-3" placeholder="Name" required
                        onkeypress="return noNumber(event)" />
                      <label for="name">
                        Name
                      </label>
                      <div class="invalid-feedback">
                        Please enter the name.
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input id="username" type="text" name="username"
                        value="<?php echo isset($_SESSION['entered_username']) ? htmlspecialchars($_SESSION['entered_username']) : ''; ?>"
                        onkeypress="return noSpace(event)" class="form-control form-control-md rounded-3 mt-2" value=""
                        placeholder="Username" required />
                      <label for="username">
                        Username
                      </label>
                      <div class="invalid-feedback">
                        Please enter your username.
                      </div>
                    </div>
                    <div class="form-floating mb-3 position-relative">
                      <input id="password" type="password" name="password" onkeypress="return noSpace(event)"
                        class="form-control form-control-md rounded-3 mt-2" placeholder="Password" required />
                      <label for="password">Password</label>
                      <div class="invalid-feedback">Please enter your password.</div>
                      <!-- Eye Icon -->
                      <span class="position-absolute top-50 end-0 translate-middle-y me-3" onclick="toggleshowPassword()"
                        style="cursor: pointer;">
                        <i id="toggleIcon" class="bi bi-eye-fill"></i>
                      </span>
                    </div>
                    <div class="form-floating">
                      <select class="form-select rounded-3" name="role" id="role" required>
                        <option value="" selected disabled>Select Role</option>
                        <option value="Barista">Barista</option>
                        <option value="Manager">Manager</option>
                      </select>
                      <label for="role">
                        Role
                      </label>
                      <div class="invalid-feedback">
                        Please select a role.
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Add User</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Edit Modal -->
          <div class="modal fade" id="editmodal" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    <i class="bi bi-pencil-square"></i>
                    Edit User
                  </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <form action="/roast-ms/pages/admin/api/update_user" method="POST" class="needs-validation" novalidate>
                  <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-floating mb-2">
                      <input type="text" name="name" id="name"
                        class="form-control" required>
                      <label for="name" class="form-label">Name</label>
                      <div class="invalid-feedback">
                        Please enter your name.
                      </div>
                    </div>
                    <div class="form-floating mb-2">
                      <input type="text" name="username" id="userName"
                        class="form-control" required>
                      <label for="username" class="form-label">Username</label>
                      <div class="invalid-feedback">
                        Please enter your username.
                      </div>
                    </div>
                    <div class="form-floating mb-3 position-relative">
                      <input id="editpassword"
                        type="password"
                        name="password"
                        onkeypress="return noSpace(event)"
                        class="form-control form-control-md rounded-3 mt-2"
                        placeholder="Password" />
                      <label for="editpassword">Password</label>
                      <div class="invalid-feedback">Please enter your password.</div>

                      <!-- Eye Icon -->
                      <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                        onclick="toggleEditShowPassword()" style="cursor: pointer;">
                        <i id="toggleeditIcon" class="bi bi-eye-fill"></i>
                      </span>
                    </div>
                    <div class="form-floating mb-2">
                      <select class="form-select form-select-md"
                        value="<?php echo $row['role'] ?>" name="role" id="Role"
                        placeholder="Role" required>
                        <option selected disabled>Choose from options</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Barista">Barista</option>
                        <option value="Manager">Manager</option>
                      </select>
                      <label for="role">Role</label>
                      <div class="invalid-feedback">
                        Please select a role.
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Update User</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- DELETE Modal -->
          <div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteModal">
                    <i class="bi bi-exclamation-triangle-fill text-dark" width="24" height="24"></i>
                    Confirm Deletion
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/roast-ms/pages/admin/api/deleteuser" method="post">
                  <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <p class="lead">Are you sure you want to delete this user? This action cannot be
                      undone.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="deletedata" class="btn btn-dark">
                      <i class="bi bi-trash-fill"></i> Delete</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="app-footer">
      <div class="float-end d-none d-sm-inline"></div>
      <strong>
        © <span id="year"></span> ROAST-MS Dev. <span class="fw-light">|</span>
      </strong>
      All Rights Reserved.
    </footer>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
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

  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
  <script src="/roast-ms/assets/js/main.js"></script>
  <script src="/roast-ms/assets/js/script.js"></script>
  <script>
    $(document).ready(function() {
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
      if (isset($_SESSION['registrationfailed'])) {
        echo "toastr.error('" . $_SESSION['registrationfailed'] . "', 'Error');";
        unset($_SESSION['registrationfailed']);
      }
      if (isset($_SESSION['registrationsuccess'])) {
        echo "toastr.success('" . $_SESSION['registrationsuccess'] . "', 'Success');";
        unset($_SESSION['registrationsuccess']);
      }
      if (isset($_SESSION['deleteerror'])) {
        echo "toastr.error('" . $_SESSION['deleteerror'] . "', 'Error');";
        unset($_SESSION['deleteerror']);
      }
      if (isset($_SESSION['deletesuccess'])) {
        echo "toastr.success('" . $_SESSION['deletesuccess'] . "', 'Success');";
        unset($_SESSION['deletesuccess']);
      }
      if (isset($_SESSION['updateerror'])) {
        echo "toastr.error('" . $_SESSION['updateerror'] . "', 'Error');";
        unset($_SESSION['updateerror']);
      }
      if (isset($_SESSION['updatesuccess'])) {
        echo "toastr.success('" . $_SESSION['updatesuccess'] . "', 'Success');";
        unset($_SESSION['updatesuccess']);
      }
      ?>
    });
  </script>
  <script>
    $(document).ready(function() {
      $(document).on('click', '.deletebtn', function() {
        $('#deletemodal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
          return $(this).text().trim();
        }).get();
        console.log(data);
        $('#delete_id').val(data[0]);
      });
    });
  </script>
<script>
  $(document).ready(function() {

    // Use event delegation so clicks work on all pages
    $(document).on('click', '.editbtn', function () {

      let $tr = $(this).closest('tr');

      let data = $tr.children("td").map(function() {
        return $(this).text().trim();
      }).get();

      console.log(data);

      $('#update_id').val(data[0]);
      $('#name').val(data[2]);
      $('#userName').val(data[3]);
      $('#Role').val(data[4]);

      $('#editmodal').modal('show');
    });

  });
</script>

  <script>
    function toggleshowPassword() {
      const passwordInput = document.getElementById("password");
      const toggleIcon = document.getElementById("toggleIcon");
      const isPassword = passwordInput.type === "password";

      passwordInput.type = isPassword ? "text" : "password";
      toggleIcon.className = isPassword ? "bi bi-eye-slash-fill" : "bi bi-eye-fill";
    }

    function toggleEditShowPassword() {
      const passwordInput = document.getElementById("editpassword");
      const toggleIcon = document.getElementById("toggleeditIcon");
      const isPassword = passwordInput.type === "password";

      passwordInput.type = isPassword ? "text" : "password";
      toggleIcon.className = isPassword ? "bi bi-eye-slash-fill" : "bi bi-eye-fill";
    }
  </script>
  <script>
    $(document).ready(function() {
      var table = new DataTable('#userTable'); // initialize DataTable

      // Filter by Rating dropdown
      $('#roleFilter').on('change', function() {
        var value = $(this).val(); // selected value
        if (value) {
          table.column(4).search('^' + value + '$', true, false).draw();
        } else {
          // Show all rows
          table.column(4).search('').draw();
        }
      });
    });
  </script>
</body>

</html>