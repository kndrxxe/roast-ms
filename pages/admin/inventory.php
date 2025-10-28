<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/roast-ms/auth.php';
checkRole(['Administrator']); // Only Administrator can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Inventory Management | ROAST-MS</title>
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
      new DataTable('#salesTable', {
        dom: `<'d-flex justify-content-between mb-3 align-items-center'l<'d-flex align-items-center'<'d-none d-lg-block me-2'B>f>>
                rt
                <'d-flex justify-content-between align-items-center mt-3'ip>
                `,
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
            <a href="#" class="btn btn-default btn-flat">Settings</a>
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
            <li class="nav-item">
              <a href="feedback.php" class="nav-link">
                <i class="nav-icon bi bi-chat-left-quote"></i>
                <p>Customer Feedback</p>
              </a>
            </li>
            <li class="nav-header">INVENTORY</li>
            <li class="nav-item">
              <a class="nav-link active">
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
          </ul>
        </nav>
      </div>
    </aside>
    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0 fw-bold">Inventory Management</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inventory Management</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm d-flex align-items-center justify-content-center">
                  <i class="bi bi-box2-heart"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">Products in Stock</span>
                  <span class="info-box-number total_sales">
                    0
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-danger shadow-sm d-flex align-items-center justify-content-center">
                  <i class="bi bi-graph-down-arrow"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">Low Stock Items</span>
                  <span class="info-box-number total_employees">
                    0
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart-x"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text truncate">Out-of-stock items</span>
                  <span class="info-box-number attendance_status">
                    0
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-warning shadow-sm d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart-plus"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">Recently Added Items</span>
                  <span class="info-box-number inventory_status text-truncate">
                    0
                  </span>
                </div>
              </div>
            </div>
            <hr>
            <div class="table-responsive">
              <div class="data_table">
                <div class="d-flex justify-content-between">
                  <h4 class="fw-bold">Inventory List</h4>
                  <div class="btn-group mb-2" role="group" aria-label="Inventory Actions">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addItemModal">
                      Add New Item
                    </button>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#stockInModal">
                      Stock In
                    </button>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#stockOutModal">
                      Stock Out
                    </button>
                  </div>

                </div>
                <table id="salesTable" class="table table-hover table-bordered" style="width:100%">
                  <thead>
                    <tr class="fs-6 text-center">
                      <th>Item ID</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Supplier/Vendor</th>
                      <th>Quantity in Stock</th>
                      <th>Unit of Measure</th>
                      <th>Cost Price</th>
                      <th>Selling Price</th>
                      <th>Stock Value</th>
                      <th>Reorder Level</th>
                      <th>Status</th>
                      <th>Last Updated Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <!-- Add New Item Modal -->
                <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                                  <div class="row g-3">
            <!-- Item ID / SKU / Barcode -->
            <div class="col-md-6">
              <label for="item_id" class="form-label">Item ID / SKU / Barcode</label>
              <input type="text" class="form-control" id="item_id" name="item_id" placeholder="Enter ID or SKU" required>
            </div>

            <!-- Product Name -->
            <div class="col-md-6">
              <label for="product_name" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
            </div>

            <!-- Category -->
            <div class="col-md-6">
              <label for="category" class="form-label">Category</label>
              <select class="form-select" id="category" name="category" required>
                <option value="" selected disabled>Select category</option>
                <option value="Drinks">Drinks</option>
                <option value="Snacks">Snacks</option>
                <option value="Hardware">Hardware</option>
                <option value="Others">Others</option>
              </select>
            </div>

            <!-- Supplier/Vendor -->
            <div class="col-md-6">
              <label for="supplier" class="form-label">Supplier/Vendor</label>
              <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Enter supplier/vendor" required>
            </div>

            <!-- Quantity in Stock -->
            <div class="col-md-4">
              <label for="quantity" class="form-label">Quantity in Stock</label>
              <input type="number" class="form-control" id="quantity" name="quantity" min="0" placeholder="0" required>
            </div>

            <!-- Unit of Measure -->
            <div class="col-md-4">
              <label for="unit" class="form-label">Unit of Measure</label>
              <select class="form-select" id="unit" name="unit" required>
                <option value="" selected disabled>Select unit</option>
                <option value="pcs">pcs</option>
                <option value="kg">kg</option>
                <option value="packs">packs</option>
                <option value="liters">liters</option>
                <option value="box">box</option>
              </select>
            </div>

            <!-- Cost Price -->
            <div class="col-md-4">
              <label for="cost_price" class="form-label">Cost Price (₱)</label>
              <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" placeholder="0.00" required>
            </div>

            <!-- Selling Price -->
            <div class="col-md-4">
              <label for="selling_price" class="form-label">Selling Price (₱)</label>
              <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" placeholder="0.00" required>
            </div>

            <!-- Stock Value -->
            <div class="col-md-4">
              <label for="stock_value" class="form-label">Stock Value (₱)</label>
              <input type="number" step="0.01" class="form-control" id="stock_value" name="stock_value" placeholder="Auto-calculated" readonly>
            </div>

            <!-- Reorder Level -->
            <div class="col-md-4">
              <label for="reorder_level" class="form-label">Reorder Level</label>
              <input type="number" class="form-control" id="reorder_level" name="reorder_level" placeholder="Enter threshold" required>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-dark">Save Item</button>
        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Stock In Modal -->
                <div class="modal fade" id="stockInModal" tabindex="-1" aria-labelledby="stockInModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="stockInModalLabel">Stock In</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Stock In Form Here -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Stock Out Modal -->
                <div class="modal fade" id="stockOutModal" tabindex="-1" aria-labelledby="stockOutModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="stockOutModalLabel">Stock Out</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Stock Out Form Here -->
                      </div>
                    </div>
                  </div>
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
</body>

</html>