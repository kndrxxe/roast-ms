<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/roast-ms/auth.php';
checkRole(['Administrator']); // Only Administrator can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sales Tracking | ROAST-MS</title>
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
      new DataTable('#salesTable', {
        dom: `<'d-flex justify-content-between mb-3 align-items-center'l<'d-flex align-items-center'<'d-none d-lg-block me-2'B>f>>
                rt
                <'d-flex justify-content-between align-items-center mt-3'ip>
                `,
        buttons: ['copy',
          {
            extend: 'csv',
            title: '',
            messageTop: 'SALES LIST - AXL ROSE CAFE',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excel',
            title: '',
            messageTop: 'SALES LIST - AXL ROSE CAFE',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
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
                  '<h3 style="text-align:center; margin-bottom:20px;">SALES LIST</h3>'
                );
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', '12pt');
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
              <a class="nav-link active">
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
              <h3 class="mb-0 fw-bold">Sales Tracking</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales Tracking</li>
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
                <span class="info-box-icon text-bg-primary shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-graph-up fs-3"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Total Sales</span>
                  <span class="info-box-number total_sales text-truncate">
                    <?php
                    // Query total sales
                    $query = "SELECT SUM(total_amount) AS total_sales FROM sales";
                    // Execute query
                    $result = $conn->query($query);

                    if ($result) {
                      $row = $result->fetch_assoc();
                      $total_sales = $row['total_sales'] ?? 0; // fallback to 0 if null
                    } else {
                      $total_sales = 0; // fallback if query fails
                    }

                    // Format for display
                    echo "₱" . number_format($total_sales, 2);
                    ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-danger shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-arrow-left-right"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">No. of Transactions</span>
                  <span class="info-box-number total_employees text-truncate">
                    <?php

                    // Query total number of transactions
                    $query = "SELECT COUNT(*) AS total_transactions FROM sales";
                    $result = $conn->query($query);

                    if ($result) {
                      $row = $result->fetch_assoc();
                      $total_transactions = $row['total_transactions'] ?? 0; // fallback to 0 if null
                    } else {
                      $total_transactions = 0; // fallback if query fails
                    }

                    // Display the total transactions
                    echo $total_transactions;
                    ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-cart-check-fill"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Average order value</span>
                  <span class="info-box-number attendance_status text-truncate">
                    <?php
                    // 1️⃣ Get total sales
                    $query_sales = "SELECT SUM(total_amount) AS total_sales FROM sales";
                    $result_sales = $conn->query($query_sales);
                    $row_sales = $result_sales->fetch_assoc();
                    $total_sales = $row_sales['total_sales'] ?? 0;

                    // 2️⃣ Get total number of transactions
                    $query_count = "SELECT COUNT(*) AS total_transactions FROM sales";
                    $result_count = $conn->query($query_count);
                    $row_count = $result_count->fetch_assoc();
                    $total_transactions = $row_count['total_transactions'] ?? 0;

                    // 3️⃣ Calculate Average Order Value
                    $average_order_value = $total_transactions > 0
                      ? $total_sales / $total_transactions
                      : 0;

                    // 4️⃣ Display formatted
                    echo "₱" . number_format($average_order_value, 2);
                    ?>

                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-warning shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-stars"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Top Product</span>
                  <span class="info-box-number inventory_status text-truncate">
                    <?php

                    $query = "
  SELECT 
      p.name,
      p.size,
      SUM(si.quantity) AS total_sold
  FROM sales_items si
  JOIN products p ON si.product_id = p.id
  GROUP BY si.product_id
  ORDER BY total_sold DESC
  LIMIT 1
";

                    $result = $conn->query($query);

                    if ($result && $row = $result->fetch_assoc()) {
                      $top_product_name = $row['name'];
                      $top_product_size = $row['size'];
                      $top_product_qty = $row['total_sold'];
                    } else {
                      $top_product_name = "-";
                      $top_product_size = "-";
                      $top_product_qty = 0;
                    }

                    // Display
                    echo $top_product_name . " ($top_product_size)";
                    ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="card-title">Sales per Category</h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                      <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                      <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="top-chart"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="card-title">Sales Distribution (by Product)</h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                      <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                      <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="sales-distribution"></div>
                      </di>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row g-2">
            <div class="col-12">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="card-title">Monthly Sales</h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                      <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                      <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="charte"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="table-responsive">
            <div class="data_table">
              <div class="d-flex justify-content-between ">
                <h4 class="fw-bold">Sales Record</h4>
                <!--<button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal"
                  data-bs-target="#addSalesModal">Add Sales
                </button> -->
              </div>
              <table id="salesTable" class="table table-hover table-bordered" style="width:100%">
                <thead>
                  <tr class="fs-6">
                    <th class="text-start">Date</th>
                    <th>Shift</th>
                    <th>Barista</th>
                    <th class="text-start">Total Quantity</th>
                    <th>Total Amount (₱)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result = $conn->prepare("SELECT * FROM sales ORDER BY sale_date");
                  $result->execute();
                  $data = $result->get_result();
                  while ($row = $data->fetch_assoc()):
                  ?>
                    <tr class="fs-6">
                      <td class="text-center"><?= htmlspecialchars($row['sale_date']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($row['shift']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($row['barista']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($row['total_quantity']) ?></td>
                      <td class="text-center">₱<?= number_format($row['total_amount'], 2) ?></td>
                      <td class="text-center">
                        <div class="btn-group me-2">
                          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#viewSalesModal"
                            data-id="<?= $row['id'] ?>" data-date="<?= $row['sale_date'] ?>"
                            data-shift="<?= $row['shift'] ?>" data-barista="<?= $row['barista'] ?>">
                            <i class="bi bi-eye-fill"></i>
                          </button>
                          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editSalesModal"
                            data-id="<?= $row['id']; ?>">
                            <i class="bi bi-pencil-fill"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- ADD Sales Modal -->
          <div class="modal fade" id="addSalesModal" tabindex="-1" aria-labelledby="addSalesLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addSalesLabel">Add Sales</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/roast-ms/pages/admin/api/add_sale" method="POST" class="needs-validation" novalidate>
                  <div class="modal-body">
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label class="fw-bold">Date</label>
                        <input type="date" name="sale_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                          required>
                      </div>
                      <div class="col-md-4">
                        <label class="fw-bold">Shift</label>
                        <select name="shift" class="form-control" required>
                          <option>Morning</option>
                          <option>Afternoon</option>
                          <option>Evening</option>
                          <option>Night</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label class="fw-bold">Barista</label>
                        <input type="text" name="barista" class="form-control readonly-input"
                          value="<?php echo $_SESSION['name']; ?>" readonly>
                      </div>
                    </div>
                    <!-- Sales Table -->
                    <table class="table table-bordered" id="addsalesTable">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Size</th>
                          <th>Quantity</th>
                          <th>Unit Price</th>
                          <th>Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <select name="product_id[]" class="form-control productSelect" required>
                              <option value="">-- Select Product --</option>
                              <?php
                              $result = $conn->query("SELECT id, category, name, size, price FROM products ORDER BY category, name, size");
                              while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id']}' 
                                data-price='{$row['price']}' 
                                data-size='{$row['size']}'>
                                {$row['category']} - {$row['name']} - {$row['size']}
                                </option>";
                              }
                              ?>
                            </select>
                          </td>
                          <td><span class="productSize"></span></td>
                          <td>
                            <input type="number" name="quantity[]" class="form-control quantityInput" value="1" min="1"
                              required>
                          </td>
                          <td>
                            <span class="unitPrice">₱0</span>
                            <!-- Hidden input to send unit price -->
                            <input type="hidden" name="unit_price[]" class="unitPriceInput" value="0">
                          </td>
                          <td>
                            <span class="totalPrice">₱0</span>
                            <!-- Hidden input to send total -->
                            <input type="hidden" name="total[]" class="totalPriceInput" value="0">
                          </td>
                          <td>
                            <button type="button" class="btn btn-dark btn-sm removeRow"><i
                                class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                      <button type="button" id="addRowBtn" class="btn btn-dark btn-sm"><i class="bi bi-plus-circle"></i>
                        Add
                        Row</button>
                    </div>
                    <!-- Summary -->
                    <div class="mt-3">
                      <p><strong>Total Quantity Sold:</strong> <span id="totalQty">0</span></p>
                      <p><strong>Total Sales Amount:</strong> ₱<span id="grandTotal">0</span></p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Save Sales</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- EDIT Sales Modal -->
          <div class="modal fade" id="editSalesModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <form id="editSalesForm" action="/roast-ms/pages/admin/api/update_sale" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Sale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    <!-- Hidden Sale ID -->
                    <input type="hidden" name="sale_id" id="editSaleId">

                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label class="fw-bold">Date</label>
                        <input type="date" name="sale_date" id="editSaleDate" class="form-control" required>
                      </div>
                      <div class="col-md-4">
                        <label class="fw-bold">Shift</label>
                        <select name="shift" id="editShift" class="form-select" required>
                          <option>Morning</option>
                          <option>Afternoon</option>
                          <option>Evening</option>
                          <option>Night</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label class="fw-bold">Barista</label>
                        <input type="text" name="barista" id="editBarista" class="form-control readonly-input" readonly>
                      </div>
                    </div>

                    <!-- Sales Items Table -->
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Size</th>
                          <th>Quantity</th>
                          <th>Unit Price</th>
                          <th>Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="editSalesTableBody">
                        <!-- JS will fill rows here -->
                      </tbody>
                    </table>

                    <button type="button" id="addEditRow" class="btn btn-sm btn-dark"><i class="bi bi-plus-circle"></i>
                      Add Row</button>

                    <div class="mt-3">
                      <p><strong>Total Quantity Sold:</strong> <span id="editTotalQty">0</span></p>
                      <p><strong>Total Sales Amount:</strong> ₱<span id="editGrandTotal">0</span></p>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Update Sale</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- VIEW Sales Modal -->
          <div class="modal fade" id="viewSalesModal" tabindex="-1" aria-labelledby="viewSalesLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="viewSalesLabel">View Sales Record</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <button type="button" class="btn btn-dark float-end btn-print" id="printSalesBtn"><i class="bi bi-printer-fill"></i> Print</button>
                  <!-- Header Info -->
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label class="fw-bold">Date:</label>
                      <p id="viewDate" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                      <label class="fw-bold">Shift:</label>
                      <p id="viewShift" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                      <label class="fw-bold">Barista:</label>
                      <p id="viewBarista" class="form-control-plaintext"></p>
                    </div>
                  </div>

                  <!-- Sales Table -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody id="viewSalesTableBody">
                      <!-- Populated dynamically -->
                    </tbody>
                  </table>

                  <!-- Summary -->
                  <div class="mt-3">
                    <p><strong>Total Quantity Sold:</strong> <span id="viewTotalQty">0</span></p>
                    <p><strong>Total Sales Amount:</strong> ₱<span id="viewGrandTotal">0</span></p>
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
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const tableBody = document.querySelector("#addsalesTable tbody");
      const addRowBtn = document.getElementById("addRowBtn");
      const totalQty = document.getElementById("totalQty");
      const grandTotal = document.getElementById("grandTotal");

      function updateTotals() {
        let qtySum = 0,
          totalSum = 0;
        tableBody.querySelectorAll("tr").forEach(row => {
          const select = row.querySelector(".productSelect");
          const qty = parseInt(row.querySelector(".quantityInput").value) || 0;
          const unitPrice = parseFloat(select?.selectedOptions[0]?.dataset.price) || 0;
          const size = select?.selectedOptions[0]?.dataset.size || "";

          const total = qty * unitPrice;

          // update UI
          row.querySelector(".productSize").textContent = size;
          row.querySelector(".unitPrice").textContent = `₱${unitPrice}`;
          row.querySelector(".totalPrice").textContent = `₱${total}`;

          // update hidden inputs
          row.querySelector(".unitPriceInput").value = unitPrice;
          row.querySelector(".totalPriceInput").value = total;

          qtySum += qty;
          totalSum += total;
        });

        totalQty.textContent = qtySum;
        grandTotal.textContent = totalSum;
      }

      // Add new row
      addRowBtn.addEventListener("click", () => {
        const newRow = tableBody.querySelector("tr").cloneNode(true);
        newRow.querySelectorAll("input, select, span").forEach(el => {
          if (el.tagName === "INPUT") el.value = 1;
          if (el.tagName === "SELECT") el.selectedIndex = 0;
          if (el.tagName === "SPAN") el.textContent = "";
        });
        tableBody.appendChild(newRow);
      });

      // Update totals on product/quantity change
      tableBody.addEventListener("input", updateTotals);
      tableBody.addEventListener("change", updateTotals);

      // Remove row
      tableBody.addEventListener("click", e => {
        if (e.target.closest(".removeRow") && tableBody.querySelectorAll("tr").length > 1) {
          e.target.closest("tr").remove();
          updateTotals();
        }
      });


      // ✅ Validate before submit
      salesForm.addEventListener("submit", function(e) {
        let valid = true;

        tableBody.querySelectorAll("tr").forEach(row => {
          const select = row.querySelector(".productSelect");
          const qty = row.querySelector(".quantityInput");

          // Reset error styles
          select.classList.remove("is-invalid");
          qty.classList.remove("is-invalid");

          if (!select.value) {
            select.classList.add("is-invalid");
            valid = false;
          }
          if (qty.value <= 0) {
            qty.classList.add("is-invalid");
            valid = false;
          }
        });

        if (!valid) {
          e.preventDefault();
          e.stopPropagation();
          alert("⚠️ Please select a product and enter a quantity greater than 0 for all rows.");
        }
      });
      updateTotals();
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const viewModal = document.getElementById("viewSalesModal");

      viewModal.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let saleId = button.getAttribute("data-id");

        // Fill header info (optional: pass from table)
        document.getElementById("viewDate").innerText = button.getAttribute("data-date");
        document.getElementById("viewShift").innerText = button.getAttribute("data-shift");
        document.getElementById("viewBarista").innerText = button.getAttribute("data-barista");

        // Clear table
        const tbody = document.getElementById("viewSalesTableBody");
        tbody.innerHTML = "";

        fetch(`/roast-ms/pages/admin/api/get_sale.php?sale_id=${saleId}`)
          .then(res => res.json())
          .then(items => {
            let totalQty = 0,
              grandTotal = 0;

            items.forEach(item => {
              let row = `
            <tr>
              <td>${item.product}</td>
              <td>${item.size}</td>
              <td>${item.quantity}</td>
              <td>₱${parseFloat(item.unit_price).toFixed(2)}</td>
              <td>₱${parseFloat(item.total).toFixed(2)}</td>
            </tr>
          `;
              tbody.insertAdjacentHTML("beforeend", row);
              totalQty += parseInt(item.quantity);
              grandTotal += parseFloat(item.total);
            });

            document.getElementById("viewTotalQty").innerText = totalQty;
            document.getElementById("viewGrandTotal").innerText = grandTotal.toFixed(2);
          })
          .catch(err => {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center">Error loading items</td></tr>`;
            console.error(err);
          });
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const editButtons = document.querySelectorAll("[data-bs-target='#editSalesModal']");
      const tableBody = document.getElementById("editSalesTableBody");
      const totalQty = document.getElementById("editTotalQty");
      const grandTotal = document.getElementById("editGrandTotal");
      const addEditRowBtn = document.getElementById("addEditRow"); // button to add row

      function updateTotals() {
        let qtySum = 0,
          totalSum = 0;
        tableBody.querySelectorAll("tr").forEach(row => {
          const qty = parseInt(row.querySelector(".quantityInput").value) || 0;
          const price = parseFloat(row.querySelector(".unitPriceInput").value) || 0;
          const total = qty * price;

          row.querySelector(".totalPrice").textContent = `₱${total}`;
          row.querySelector(".totalPriceInput").value = total;

          qtySum += qty;
          totalSum += total;
        });
        totalQty.textContent = qtySum;
        grandTotal.textContent = totalSum;
      }

      // Load existing sales data into modal
      editButtons.forEach(btn => {
        btn.addEventListener("click", () => {
          const saleId = btn.getAttribute("data-id");

          fetch(`/roast-ms/pages/admin/api/get_saledetails.php?id=${saleId}`)
            .then(res => res.json())
            .then(data => {
              // Fill main info
              document.getElementById("editSaleId").value = data.sale.id;
              document.getElementById("editSaleDate").value = data.sale.sale_date;
              document.getElementById("editShift").value = data.sale.shift;
              document.getElementById("editBarista").value = data.sale.barista;

              // Fill items
              tableBody.innerHTML = "";
              data.items.forEach(item => {
                const row = document.createElement("tr");
                row.innerHTML = `
                <td>${item.name}<input type="hidden" name="product_id[]" value="${item.product_id}"></td>
                <td>${item.size}</td>
                <td><input type="number" name="quantity[]" class="form-control quantityInput" value="${item.quantity}" min="1"></td>
                <td>₱${item.unit_price}<input type="hidden" name="unit_price[]" class="unitPriceInput" value="${item.unit_price}"></td>
                <td><span class="totalPrice">₱${item.total}</span><input type="hidden" name="total[]" class="totalPriceInput" value="${item.total}"></td>
                <td><button type="button" class="btn btn-dark btn-sm removeRow"><i class="bi bi-trash"></i></button></td>
              `;
                tableBody.appendChild(row);
              });

              updateTotals();
            });
        });
      });

      // Add new row (blank for editing)
      if (addEditRowBtn) {
        addEditRowBtn.addEventListener("click", () => {
          const row = document.createElement("tr");
          row.innerHTML = `
          <td>
            <select name="product_id[]" class="form-select productSelect" required>
              <option value="">-- Select Product --</option>
              <?php
              $result = $conn->query("SELECT id, category, name, size, price FROM products ORDER BY category, name, size");
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}' data-price='{$row['price']}' data-size='{$row['size']}'>
                          {$row['category']} - {$row['name']} - {$row['size']}
                        </option>";
              }
              ?>
            </select>
          </td>
          <td><span class="productSize"></span></td>
          <td><input type="number" name="quantity[]" class="form-control quantityInput" value="1" min="1"></td>
          <td><span class="unitPrice">₱0</span><input type="hidden" name="unit_price[]" class="unitPriceInput" value="0"></td>
          <td><span class="totalPrice">₱0</span><input type="hidden" name="total[]" class="totalPriceInput" value="0"></td>
          <td><button type="button" class="btn btn-dark btn-sm removeRow"><i class="bi bi-trash"></i></button></td>
        `;
          tableBody.appendChild(row);
        });
      }

      // Update totals when qty changes
      tableBody.addEventListener("input", updateTotals);

      // Remove row
      tableBody.addEventListener("click", e => {
        if (e.target.closest(".removeRow")) {
          e.target.closest("tr").remove();
          updateTotals();
        }
      });

      // Update price/size when product changes
      tableBody.addEventListener("change", e => {
        if (e.target.classList.contains("productSelect")) {
          const option = e.target.selectedOptions[0];
          const row = e.target.closest("tr");

          const price = option.getAttribute("data-price") || 0;
          const size = option.getAttribute("data-size") || "";

          row.querySelector(".productSize").textContent = size;
          row.querySelector(".unitPrice").textContent = `₱${price}`;
          row.querySelector(".unitPriceInput").value = price;

          updateTotals();
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
  <script src="/roast-ms/assets/js/main.js"></script>
  <script src="/roast-ms/assets/js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
      if (isset($_SESSION['salesfailed'])) {
        echo "toastr.error('" . $_SESSION['salesfailed'] . "', 'Error');";
        unset($_SESSION['salesfailed']);
      }
      if (isset($_SESSION['salessuccess'])) {
        echo "toastr.success('" . $_SESSION['salessuccess'] . "', 'Success');";
        unset($_SESSION['salessuccess']);
      }
      ?>
    });
  </script>
  <script>
    document.getElementById('printSalesBtn').addEventListener('click', function() {
      // Clone modal content so we don't affect the actual modal
      const modalContentClone = document.querySelector('#viewSalesModal .modal-content').cloneNode(true);

      // Remove the close button (assuming it has class 'btn-close' or similar)
      const closeBtn = modalContentClone.querySelector('.btn-close');
      const printBtn = modalContentClone.querySelector('.btn-print');
      const modalTitle = modalContentClone.querySelector('.modal-title');
      if (closeBtn) {
        closeBtn.remove();
      }
      if (printBtn) {
        printBtn.remove();
      }
      if (modalTitle) {
        modalTitle.remove();
      }

      // Open a new window for printing
      const printWindow = window.open('', '_blank');
      printWindow.document.write('<html><head><title>Print Sales Record | ROAST-MS</title>');
      printWindow.document.write('<link rel="stylesheet" href="/roast-ms/assets/css/style.css" />');
      printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">');
      printWindow.document.write('</head><body>');
      printWindow.document.write('<div style="text-align:center;"><img src="/roast-ms/assets/images/axl-rose-cafe.png" style="width:100px;" /></div>');
      printWindow.document.write('<h4 style="text-align:center; margin-bottom:20px;">SALES RECORD</h4>');
      printWindow.document.write(modalContentClone.innerHTML);
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.print();
    });
  </script>
</body>

</html>