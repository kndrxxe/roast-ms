<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/roast-ms/auth.php';
checkRole(['Administrator']); // Only Administrator can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DTR & Payroll | ROAST-MS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="ROAST-MS" />
  <meta name="author" content="Author" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <link rel="stylesheet" href="/roast-ms/assets/css/style.css" />
  <link rel="stylesheet" href="/roast-ms/assets/css/adminlte.css" />
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
      new DataTable('#dtrTable', {
        dom: `<'d-flex justify-content-between mb-3 align-items-center'l<'d-flex align-items-center'<'d-none d-lg-block me-2'B>f>>
                rt
                <'d-flex justify-content-between align-items-center mt-3'ip>
                `,
        buttons: ['copy',
          {
            extend: 'csv',
            title: '',
            messageTop: 'DAILY TIME RECORD - AXL ROSE CAFE',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excel',
            title: '',
            messageTop: 'DAILY TIME RECORD - AXL ROSE CAFE',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'print',
            title: '',
            customize: function(win) {
              $(win.document.body)
                .css('font-size', '10pt')
                .prepend(
                  '<div style="text-align:center;"><img src="/roast-ms/assets/images/axl-rose-cafe.png" style="width:100px;" /></div>',
                  '<h3 style="text-align:center; margin-bottom:20px;">DAILY TIME RECORD</h3>'
                );
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', '10pt');
            },
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          }
        ],
        columnDefs: [{
          targets: [0, 1, 2, 3]
        }]
      });

      new DataTable('#payrollSummaryTable', {
        dom: `<'d-flex justify-content-between mb-3 align-items-center'l<'d-flex align-items-center'<'d-none d-lg-block me-2'B>f>>
                rt
                <'d-flex justify-content-between align-items-center mt-3'ip>
                `,
        buttons: ['copy',
          {
            extend: 'csv',
            title: '',
            messageTop: 'PAYROLL SUMMARY - AXL ROSE CAFE',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5]
            }
          },
          {
            extend: 'excel',
            title: '',
            messageTop: 'PAYROLL SUMMARY - AXL ROSE CAFE',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5]
            }
          },
          {
            extend: 'print',
            title: '',
            customize: function(win) {
              $(win.document.body)
                .css('font-size', '10pt')
                .prepend(
                  '<div style="text-align:center;"><img src="/roast-ms/assets/images/axl-rose-cafe.png" style="width:100px;" /></div>',
                  '<h3 style="text-align:center; margin-bottom:20px;">PAYROLL SUMMARY</h3>'
                );
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', '10pt');
            },
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5]
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
              <a class="nav-link active">
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
              <a href="usermanagement.php" class="nav-link">
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
              <h3 class="mb-0 fw-bold">DTR & Payroll</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">DTR & Payroll</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="table-responsive">
            <div class="data_table">
              <div class="d-flex justify-content-between">
                <h4 class="mb-3 fw-bold">Daily Time Record</h4>
              </div>
              <table id="dtrTable" class="table table-hover table-bordered" style="width:100%">
                <thead>
                  <tr class="fs-6 text-center">
                    <th>Date</th>
                    <th>Name</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Total Hours</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result = $conn->prepare("SELECT * FROM dtr_logs ORDER BY date DESC");
                  $result->execute();
                  $data = $result->get_result();
                  while ($row = $data->fetch_assoc()):
                  ?>
                    <tr class="text-center">
                      <td><?= htmlspecialchars($row['date']) ?></td>
                      <td><?= htmlspecialchars($row['name']) ?></td>
                      <td><?= htmlspecialchars($row['time_in']) ?></td>
                      <td><?= htmlspecialchars($row['time_out']) ?></td>
                      <td><?= htmlspecialchars($row['total_hours']) ?></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
          <hr>
          <div class="table-responsive">
            <div class="data_table">
              <h4 class="mb-3 fw-bold">Payroll Summary</h4>
              <table id="payrollSummaryTable" class="table table-hover table-bordered" style="width:100%">
                <thead>
                  <tr class="fs-6 text-center">
                    <th>Employee Name</th>
                    <th>Payroll Period (Start–End Date)</th>
                    <th>Total Days Worked</th>
                    <th>Total Hours</th>
                    <th>Gross Pay</th>
                    <th>Net Pay</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Query to group logs into payroll cutoffs
                  $result = $conn->query("
      SELECT 
        name,
        YEAR(date) AS year,
        MONTH(date) AS month,
        CASE 
          WHEN DAY(date) <= 15 THEN '1-15'
          ELSE '16-EOM'
        END AS cutoff,
        COUNT(DISTINCT date) AS total_days_worked,
        SUM(total_hours) AS total_hours
      FROM dtr_logs
      GROUP BY name, year, month, cutoff
      ORDER BY year DESC, month DESC, cutoff
    ");

                  $hourly_rate = 100; // Example fixed rate
                  while ($row = $result->fetch_assoc()):
                    $gross_pay = $row['total_hours'] * $hourly_rate;
                    $net_pay = $gross_pay * 0.9; // Example 10% deduction

                    // Format month with leading zeros
                    $month = str_pad($row['month'], 2, '0', STR_PAD_LEFT);

                    if ($row['cutoff'] === '1-15') {
                      $period = "{$row['year']}-$month-01 to {$row['year']}-$month-15";
                    } else {
                      $period = "{$row['year']}-$month-16 to " . date("Y-m-t", strtotime("{$row['year']}-$month-01"));
                    }

                  ?>
                    <tr class="text-center">
                      <td><?= htmlspecialchars($row['name']) ?></td>
                      <td><?= htmlspecialchars($period) ?></td>
                      <td><?= htmlspecialchars($row['total_days_worked']) ?></td>
                      <td><?= htmlspecialchars($row['total_hours']) ?></td>
                      <td><?= number_format($gross_pay, 2) ?></td>
                      <td><?= number_format($net_pay, 2) ?></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
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
</body>

</html>