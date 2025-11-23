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
            messageTop: 'INVENTORY - AXL ROSE CAFE',
            exportOptions: {
              columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
            }
          },
          {
            extend: 'excel',
            title: '',
            messageTop: 'INVENTORY - AXL ROSE CAFE',
            exportOptions: {
              columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
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
                  '<h3 style="text-align:center; margin-bottom:20px;">INVENTORY</h3>'
                );
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', '14pt');
            },
            exportOptions: {
              columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
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
              <div class="info-box d-flex align-items-center rounded">
                <span class="info-box-icon text-bg-primary shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-box2-heart fs-3"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Products in Stock</span>
                  <span class="info-box-number total_sales text-truncate">
                    <?php
                    // Sum the quantity of all products in stock
                    $result = $conn->query("SELECT SUM(quantity_in_stock) AS total_stock FROM inventory");
                    $row = $result->fetch_assoc();
                    $total_stock = $row['total_stock'] ?? 0; // default to 0 if null
                    ?>
                    <?= $total_stock; ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box d-flex align-items-center rounded">
                <span class="info-box-icon text-bg-danger shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-graph-down-arrow"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Low Stock Items</span>
                  <span class="info-box-number total_employees text-truncate">
                    <?php
                    // Count items where quantity_in_stock is less than or equal to reorder_level
                    $result = $conn->query("SELECT COUNT(*) AS low_stock_count FROM inventory WHERE quantity_in_stock <= reorder_level AND quantity_in_stock > 0");
                    $row = $result->fetch_assoc();
                    $low_stock_count = $row['low_stock_count'] ?? 0; // default to 0 if null
                    ?>
                    <?= $low_stock_count; ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box d-flex align-items-center rounded">
                <span class="info-box-icon text-bg-success shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-cart-x"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Out-of-stock items</span>
                  <span class="info-box-number attendance_status text-truncate">
                    <?php
                    // Query to count items where quantity_in_stock = 0
                    $query = "SELECT COUNT(*) AS out_of_stock_count FROM inventory WHERE quantity_in_stock = 0";
                    $result = $conn->query($query);

                    $outOfStockCount = 0;
                    if ($result && $row = $result->fetch_assoc()) {
                      $outOfStockCount = $row['out_of_stock_count'];
                    }
                    ?>
                    <?php echo $outOfStockCount; ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box d-flex align-items-center rounded">
                <span class="info-box-icon text-bg-warning shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="bi bi-cart-plus"></i>
                </span>
                <div class="info-box-content flex-grow-1 text-truncate">
                  <span class="info-box-text">Recently Added Items</span>
                  <span class="info-box-number inventory_status text-truncate">
                    <?php
                    // Query to get the most recently added item
                    $query = "SELECT product_name 
          FROM inventory 
          ORDER BY last_updated DESC 
          LIMIT 1";
                    $result = $conn->query($query);

                    $recentItem = "No recent items";
                    if ($result && $row = $result->fetch_assoc()) {
                      $recentItem = $row['product_name'];
                    }
                    ?>
                    <?php echo $recentItem; ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="d-flex justify-content-between mb-3 align-items-center">
            <h4 class="fw-bold">Inventory List</h4>
            <div
              class="btn-group mb-2"
              role="group"
              aria-label="Inventory Actions">
              <button
                type="button"
                class="btn btn-dark fw-bold d-flex"
                data-bs-toggle="modal"
                data-bs-target="#addItemModal">
                <i class="bi bi-plus-circle"></i> <span class="d-none d-sm-block ms-1">Add New Item</span>
              </button>
              <button
                type="button"
                class="btn btn-dark fw-bold d-flex"
                data-bs-toggle="modal"
                data-bs-target="#stockInModal">
                <i class="bi bi-cart-plus"></i> <span class="d-none d-sm-block ms-1">Stock In</span>
              </button>
              <button
                type="button"
                class="btn btn-dark fw-bold d-flex"
                data-bs-toggle="modal"
                data-bs-target="#stockOutModal">
                <i class="bi bi-cart-plus"></i> <span class="d-none d-sm-block ms-1">Stock Out</span>
              </button>
            </div>
          </div>
          <div class="table-responsive">
            <div class="data_table">
              <div class="mb-3 d-flex justify-content-end align-items-center gap-2">
                <label for="statusFilter" class="form-label">Filter:</label>
                <select id="statusFilter" class="form-select" style="width:150px; border: 1px solid #212529; box-shadow: none;">
                  <option value="" selected disabled hidden>Status</option>
                  <option value="">All Status</option>
                  <option value="Available">Available</option>
                  <option value="Low Stock">Low Stock</option>
                  <option value="Out of Stock">Out of Stock</option>
                </select>
              </div>
              <table id="salesTable" class="table table-hover table-bordered" style="width:100%">
                <thead>
                  <tr class="fs-6 text-center">
                    <th>ID</th>
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
                  <?php

                  $query = "SELECT * FROM inventory ORDER BY item_id ASC";
                  $result = $conn->query($query);

                  if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      // Dynamically calculate status based on stock
                      if ($row['quantity_in_stock'] == 0) {
                        $status = 'Out of Stock';
                      } elseif ($row['quantity_in_stock'] <= $row['reorder_level']) {
                        $status = 'Low Stock';
                      } else {
                        $status = 'Available';
                      }

                      // Use the dynamically calculated status for the badge class
                      $statusClass = match ($status) {
                        'Available' => 'bg-success text-white',
                        'Low Stock' => 'bg-warning text-dark',
                        'Out of Stock' => 'bg-danger text-white',
                        default => 'bg-secondary text-white'
                      };


                      echo "<tr class='text-center'>";
                      echo "<td class='text-center'>{$row['id']}</td>";
                      echo "<td>{$row['item_id']}</td>";
                      echo "<td>{$row['product_name']}</td>";
                      echo "<td>{$row['category']}</td>";
                      echo "<td>{$row['supplier']}</td>";
                      echo "<td>{$row['quantity_in_stock']}</td>";
                      echo "<td>{$row['unit_of_measure']}</td>";
                      echo "<td>₱" . number_format($row['cost_price'], 2) . "</td>";
                      echo "<td>₱" . number_format($row['selling_price'], 2) . "</td>";
                      echo "<td>₱" . number_format($row['stock_value'], 2) . "</td>";
                      echo "<td>{$row['reorder_level']}</td>";
                      echo "<td><span class='badge {$statusClass}'>{$status}</span></td>";
                      echo "<td>" . date("Y-m-d", strtotime($row['last_updated'])) . "</td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='12' class='text-center text-muted'>No records found.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>

              <!-- Add New Item Modal -->
              <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="/roast-ms/pages/admin/api/add_inventory" method="POST" class="needs-validation" novalidate>
                      <div class="modal-body">
                        <div class="row g-3">
                          <!-- Item ID / SKU / Barcode -->
                          <div class="col-md-6">
                            <div class="form-floating">
                              <input type="text" class="form-control form-control-md" id="item_id" name="item_id" placeholder="Item ID / SKU / Barcode" required />
                              <label for="item_id">Item ID / SKU / Barcode</label>
                            </div>
                            <div class="invalid-feedback">
                              Please enter the name.
                            </div>
                          </div>
                          <!-- Product Name -->
                          <div class="col-md-6">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required />
                              <label for="product_name">Product Name</label>
                            </div>
                          </div>
                          <!-- Category -->
                          <div class="col-md-6">
                            <div class="form-floating">
                              <select class="form-select" id="category" name="category" required>
                                <option value="" selected disabled>Select category</option>
                                <option value="Drinks">Drinks</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Ingredients">Ingredients</option>
                                <option value="Condiments">Condiments</option>
                                <option value="Packaging">Packaging</option>
                                <option value="Utensils">Utensils</option>
                                <option value="Equipment">Equipment</option>
                                <option value="Cleaning Supplies">Cleaning Supplies</option>
                                <option value="Hardware">Hardware</option>
                                <option value="Others">Others</option>
                              </select>
                              <label for="category">Category</label>
                            </div>
                          </div>

                          <!-- Supplier/Vendor -->
                          <div class="col-md-6">
                            <div class="form-floating">
                              <select class="form-select" id="supplier" name="supplier" required>
                                <option value="" disabled selected>Select Supplier/Vendor</option>
                                <?php
                                // Fetch supplier list from the database
                                $suppliers = $conn->query("SELECT id, supplier_name FROM suppliers ORDER BY supplier_name ASC");
                                while ($row = $suppliers->fetch_assoc()) {
                                  echo "<option value='{$row['supplier_name']}'>{$row['supplier_name']}</option>";
                                }
                                ?>
                              </select>
                              <label for="supplier">Supplier/Vendor</label>
                            </div>
                          </div>


                          <!-- Quantity in Stock -->
                          <div class="col-md-4">
                            <div class="form-floating">
                              <input type="number" class="form-control" id="quantity" name="quantity" min="0" placeholder="0" required />
                              <label for="quantity">Quantity in Stock</label>
                            </div>
                          </div>

                          <!-- Unit of Measure -->
                          <div class="col-md-4">
                            <div class="form-floating">
                              <select class="form-select" id="unit" name="unit" required>
                                <option value="" selected disabled>Select unit</option>
                                <option value="pcs">pcs</option>
                                <option value="pack">pack</option>
                                <option value="packs">packs</option>
                                <option value="box">box</option>
                                <option value="bottle">bottle</option>
                                <option value="liter">liter</option>
                                <option value="liters">liters</option>
                                <option value="ml">ml</option>
                                <option value="kg">kg</option>
                                <option value="kilos">kilos</option>
                                <option value="gram">gram</option>
                                <option value="grams">grams</option>
                                <option value="can">can</option>
                                <option value="jar">jar</option>
                                <option value="sachet">sachet</option>
                                <option value="bag">bag</option>

                              </select>
                              <label for="unit">Unit of Measure</label>
                            </div>
                          </div>

                          <!-- Cost Price -->
                          <div class="col-md-4">
                            <div class="form-floating">
                              <input type="number" min="0" step="0.01" class="form-control" value="0.00" oninput="this.value = this.value.match(/^\d*\.?\d{0,2}/)[0]" id="cost_price" name="cost_price" placeholder="0.00" required />
                              <label for="cost_price">Cost Price (₱)</label>
                            </div>
                          </div>

                          <!-- Selling Price -->
                          <div class="col-md-4">
                            <div class="form-floating">
                              <input type="number" min="0" step="0.01" value="0.00" class="form-control" id="selling_price" name="selling_price" placeholder="0.00" required />
                              <label for="selling_price">Selling Price (₱)</label>
                            </div>
                          </div>

                          <!-- Stock Value -->
                          <div class="col-md-4">
                            <div class="form-floating">
                              <input type="number" min="0" step="0.01" value="0.00" class="form-control readonly-input" id="stock_value" name="stock_value" placeholder="Auto-calculated" readonly />
                              <label for="stock_value">Stock Value (₱)</label>
                            </div>
                          </div>

                          <!-- Reorder Level -->
                          <div class="col-md-4">
                            <div class="form-floating">
                              <input type="number" min="0" class="form-control" id="reorder_level" name="reorder_level" placeholder="Enter threshold" required />
                              <label for="reorder_level">Reorder Level</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                          Cancel
                        </button>
                        <button type="submit" class="btn btn-dark">Save Item</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Stock In Modal -->
              <div class="modal fade" id="stockInModal" tabindex="-1" aria-labelledby="stockInModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="stockInModalLabel">Stock In</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="/roast-ms/pages/admin/api/stock_in" method="POST" class="needs-validation" novalidate>
                      <div class="modal-body">
                        <!-- Select Item -->
                        <div class="mb-3">
                          <div class="form-floating">
                            <select class="form-select" name="item_id" id="item_id_stockin" required>
                              <option disabled selected>Select item</option>
                              <?php
                              $result = $conn->query("SELECT item_id, product_name, supplier FROM inventory");
                              while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['item_id']}'>{$row['supplier']} - {$row['product_name']}</option>";
                              }
                              ?>
                            </select>
                            <label class="form-label">Item</label>
                          </div>
                        </div>

                        <!-- Current Stock (Readonly) -->
                        <div class="mb-3">
                          <div class="form-floating">
                            <input type="number" class="form-control" name="current_stock" id="current_stock_stockin" readonly>
                            <label class="form-label">Current Stock</label>
                          </div>
                        </div>

                        <!-- Stock to Add -->
                        <div class="mb-3">
                          <div class="form-floating">
                            <input type="number" class="form-control" name="add_qty" id="add_qty" min="1" required>
                            <label class="form-label">Add Quantity</label>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                          Cancel
                        </button>
                        <button type="submit" class="btn btn-dark">Confirm</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Stock Out Modal -->
              <div class="modal fade" id="stockOutModal" tabindex="-1" aria-labelledby="stockOutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="stockOutModalLabel">Stock Out Item</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="/roast-ms/pages/admin/api/stock_out" method="POST" class="needs-validation" novalidate>
                      <div class="modal-body">

                        <!-- Select Item -->
                        <div class="mb-3">
                          <div class="form-floating">
                            <select class="form-select" name="item_id" id="item_id_stockout" required>
                              <option disabled selected>Select item</option>
                              <?php
                              $result = $conn->query("SELECT item_id, product_name, supplier FROM inventory");
                              while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['item_id']}'>{$row['supplier']} - {$row['product_name']}</option>";
                              }
                              ?>
                            </select>
                            <label class="form-label">Item</label>
                          </div>
                        </div>

                        <!-- Current Stock (Readonly) -->
                        <div class="mb-3">
                          <div class="form-floating">
                            <input type="number" class="form-control" name="current_stock" id="current_stock_stockout" readonly>
                            <label class="form-label">Current Stock</label>
                          </div>
                        </div>

                        <!-- Quantity to Remove -->
                        <div class="mb-3">
                          <div class="form-floating">
                            <input type="number" class="form-control" name="remove_qty" id="remove_qty" min="1" required>
                            <label class="form-label">Remove Quantity</label>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                          Cancel
                        </button>
                        <button type="submit" class="btn btn-dark">Confirm</button>
                      </div>
                    </form>
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
      if (isset($_SESSION['inventoryfailed'])) {
        echo "toastr.error('" . $_SESSION['inventoryfailed'] . "', 'Error');";
        unset($_SESSION['inventoryfailed']);
      }
      if (isset($_SESSION['inventorysuccess'])) {
        echo "toastr.success('" . $_SESSION['inventorysuccess'] . "', 'Success');";
        unset($_SESSION['inventorysuccess']);
      }
      ?>
    });
  </script>
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
    const qty = document.getElementById('quantity');
    const cost = document.getElementById('cost_price');
    const stockValue = document.getElementById('stock_value');

    function calculateStockValue() {
      const q = parseFloat(qty.value) || 0;
      const c = parseFloat(cost.value) || 0;
      stockValue.value = (q * c).toFixed(2);
    }

    qty.addEventListener('input', calculateStockValue);
    cost.addEventListener('input', calculateStockValue);
  </script>
  <script>
    $(document).ready(function() {
      $('#item_id_stockin').on('change', function() {
        const itemId = $(this).val();

        if (!itemId) return;

        $.ajax({
          url: '/roast-ms/pages/admin/api/get_stock.php',
          method: 'GET',
          data: {
            item_id: itemId
          },
          dataType: 'json',
          success: function(response) {
            console.log(response); // 👈 check this in browser console
            $('#current_stock_stockin').val(response.stock);
          },
          error: function() {
            alert('Error fetching stock data.');
          }
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#item_id_stockout').on('change', function() {
        const itemId = $(this).val();

        if (!itemId) return;

        $.ajax({
          url: '/roast-ms/pages/admin/api/get_stock.php',
          method: 'GET',
          data: {
            item_id: itemId
          },
          dataType: 'json',
          success: function(response) {
            console.log(response); // 👈 check this in browser console
            $('#current_stock_stockout').val(response.stock);
          },
          error: function() {
            alert('Error fetching stock data.');
          }
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form')[0]?.reset();
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      var table = new DataTable('#salesTable'); // initialize DataTable

      // Filter by Rating dropdown
      $('#statusFilter').on('change', function() {
        var value = $(this).val(); // selected value
        if (value) {
          table.column(11).search('^' + value + '$', true, false).draw();
        } else {
          // Show all rows
          table.column(11).search('').draw();
        }
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
  <script src="/roast-ms/assets/js/main.js"></script>
  <script src="/roast-ms/assets/js/script.js"></script>
</body>

</html>