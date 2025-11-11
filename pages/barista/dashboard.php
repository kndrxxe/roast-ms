<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/roast-ms/auth.php';
checkRole(['Barista']);

$id = userID(); // ✅ Now $id is available for your card + modal
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Dashboard | ROAST-MS</title>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
  <?php
  // Fetch the logged-in user's profile picture
  $query = $conn->prepare("SELECT picture FROM users WHERE user_id = ?");
  $query->bind_param("s", $id);
  $query->execute();
  $result = $query->get_result()->fetch_assoc();

  // Set $picture to the uploaded path or default
  $picture = !empty($result['picture']) ? $result['picture'] : '/roast-ms/assets/images/default-150x150.png';
  ?>
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
              <img src="<?php echo htmlspecialchars($picture); ?>" class="user-image rounded-circle shadow"
                alt="User" />
              <span class="d-none d-md-inline"><?php echo getUsername(); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <li class="user-header text-bg-dark">
                <img src="<?php echo htmlspecialchars($picture); ?>" class="rounded-circle shadow" alt="User" />
                <p>
                  <?php echo getFullname(); ?>
                  <small><?php echo getRole(); ?></small>
                </p>
              </li>
          </li>
          <li class="user-footer">
            <a href="/roast-ms/pages/barista/settings" class="btn btn-default btn-flat">Settings</a>
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
            <img width="50" src="<?php echo htmlspecialchars($picture); ?>" class="rounded-circle shadow ms-1 me-2"
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
              <a class="nav-link active">
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
          </ul>
        </nav>
      </div>
    </aside>
    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0 fw-bold">Dashboard</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="row d-flex justify-content-center">
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box d-flex align-items-center rounded">
                <span class="info-box-icon text-bg-primary shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-calendar"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Today's Attendance Status</span>
                  <span class="info-box-number attendance-status text-truncate">Loading...</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box d-flex align-items-center rounded">
                <span class="info-box-icon text-bg-danger shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-clock"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Total Hours (This Week)</span>
                  <span class="info-box-number total-hours-week text-truncate">Loading...</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box d-flex align-items-center rounded">
                <span class="info-box-icon text-bg-success shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-person-fill-check"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Shifts Completed (This Month)</span>
                  <span class="info-box-number shifts-completed text-truncate">Loading...</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row g-2">
            <div class="col-md-12 col-lg-8">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="card-title">Attendance Over Time</h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                      <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                      <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div id="attendance-chart"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-4">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="card-title">Upcoming Holidays</h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                      <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                      <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <small class="d-flex justify-content-center" style="font-size: 12px;">
                      <p class="me-2">
                        <span style="display:inline-block;width:10px;height:10px;background-color:#28a745;"></span> Regular
                      </p>
                      <p>
                        <span style="display:inline-block;width:10px;height:10px;background-color:#ffc107;"></span> Special
                      </p>
                    </small>
                  </div>
                  <table class="table table-sm table-hover mb-0">
                    <tbody>
                      <?php
                      // Fetch upcoming holidays (today and forward)
                      $query = "SELECT holiday_date, holiday_name, holiday_type 
                      FROM holidays 
                      WHERE holiday_date >= CURDATE() 
                      ORDER BY holiday_date ASC";
                      $result = $conn->query($query);

                      while ($row = $result->fetch_assoc()):
                        $date = date_create($row['holiday_date']);
                        $formatted_date = date_format($date, 'F j (D)'); // e.g., August 21 (Thu)
                        $color = $row['holiday_type'] === 'Regular' ? '#28a745' : '#ffc107';
                      ?>
                        <tr>
                          <td>
                            <span style="display:inline-block;width:12px;height:12px;background-color:<?= $color ?>;"></span>
                          </td>
                          <td><?= htmlspecialchars($formatted_date) ?></td>
                          <td style="max-width:150px;" title="<?= htmlspecialchars($row['holiday_name']) ?>">
                            <?= htmlspecialchars($row['holiday_name']) ?>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
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
      // Fetch dashboard data
      $.ajax({
        url: '/roast-ms/pages/barista/api/dashboard-data.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
          if (data.error) {
            alert(data.error);
            return;
          }

          // Update the DOM with fetched data
          $('.attendance-status').text(data.attendance_status);
          $('.total-hours-week').text(data.total_hours_week);
          $('.shifts-completed').text(data.shifts_completed);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching dashboard data:', error);
        },
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $.ajax({
        url: '/roast-ms/pages/barista/api/attendance-data.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
          if (data.error) {
            alert(data.error);
            return;
          }

          const attendance_chart_options = {
            series: [{
                name: 'Present',
                data: data.present_days
              },
              {
                name: 'Absent',
                data: data.absent_days
              }
            ],
            chart: {
              type: 'bar',
              height: 350,
              stacked: true,
              toolbar: {
                show: true
              }
            },
            plotOptions: {
              bar: {
                columnWidth: '25%'
              }
            },
            colors: ['#28a745', '#dc3545'], // green = Present, red = Absent
            dataLabels: {
              enabled: true
            },
            xaxis: {
              categories: data.months
            },
            yaxis: {
              title: {
                text: 'Days'
              },
              min: 0
            },
            tooltip: {
              y: {
                formatter: function(val) {
                  return val + " days";
                }
              }
            },
            legend: {
              position: 'top'
            }
          };

          const attendance_chart = new ApexCharts(
            document.querySelector("#attendance-chart"),
            attendance_chart_options
          );
          attendance_chart.render();
        },
        error: function(xhr, status, error) {
          console.error('Error fetching monthly attendance:', error);
        }
      });
    });
  </script>
</body>

</html>