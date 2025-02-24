<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/roast-ms/dist/api/auth.php';
checkRole(['Accountant']); // Only Accountant can access
?>

<!DOCTYPE html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard | ROAST-MS</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="ROAST-MS" />
    <meta name="author" content="Author" />
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <!--end::Primary Meta Tags-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="/roast-ms/dist/css/style.css" />
    <link rel="stylesheet" href="/roast-ms/dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- JQuery JS -->
  </head>
  <body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-dark" data-bs-theme="dark">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">0</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-bell me-2"></i> 4 new notifications
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="/roast-ms/dist/assets/img/default-150x150.png"
                  class="user-image rounded-circle shadow"
                  alt="User"
                />
                <span class="d-none d-md-inline"><?php echo getUsername(); ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-dark">
                  <img
                    src="/roast-ms/dist/assets/img/default-150x150.png"
                    class="rounded-circle shadow"
                    alt="User"
                  />
                  <p>
                    <?php echo getFullname(); ?>
                    <small><?php echo getRole(); ?></small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4 text-center"><a href="#">Tool1</a></div>
                    <div class="col-4 text-center"><a href="#">Tool2</a></div>
                    <div class="col-4 text-center"><a href="#">Tool3</a></div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  <a href="/roast-ms/dist/api/logout" class="btn btn-default btn-flat float-end">Log out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="#"
              alt="Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">ROAST-MS</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <div class="user-panel py-2 d-flex align-items-center">
            <div class="image">
              <img width="50" src="/roast-ms/dist/assets/img/default-150x150.png" class="rounded-circle shadow ms-1 me-2" alt="User Image">
            </div>
            <div class="info">
              <a class="d-block nav-link text-light brand-text text-decoration-none overflow-hidden text-nowrap lh-1 fs-5 fw-bold">WELCOME<br><span class="fw-light fs-7"><?php echo getFullname(); ?></span></a>
            </div>
          </div>
          <hr class="text-secondary my-2">
          <nav class="mt-3">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <a href="" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-header">PAYROLL AND ATTENDANCE</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-lines-fill"></i>
                  <p>DTR & Payroll</p>
                </a>
              </li>
              <li class="nav-header">SALES AND ANALYTICS</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-clipboard-data"></i>
                  <p>Sales Forecasting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-chat-left-quote"></i>
                  <p>Product Analytics</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-chat-left-quote"></i>
                  <p>Customer Feedback</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-graph-up-arrow"></i>
                  <p>Product Analytics</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-clock-history"></i>
                  <p>Peak Hours</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-bar-chart-steps"></i>
                  <p>Sales Tracking</p>
                </a>
              </li>
              <li class="nav-header">FINANCIAL MANAGEMENT</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-lines-fill"></i>
                  <p>Cash Flow & Expenses</p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0 fw-bold">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-gear-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">CPU Traffic</span>
                    <span class="info-box-number">
                      10
                      <small>%</small>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon text-bg-danger shadow-sm">
                    <i class="bi bi-hand-thumbs-up-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <!-- fix for small devices only -->
              <!-- <div class="clearfix hidden-md-up"></div> -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon text-bg-success shadow-sm">
                    <i class="bi bi-cart-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon text-bg-warning shadow-sm">
                    <i class="bi bi-people-fill"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Monthly Recap Report</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-tool dropdown-toggle"
                          data-bs-toggle="dropdown"
                        >
                          <i class="bi bi-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" role="menu">
                          <a href="#" class="dropdown-item">Action</a>
                          <a href="#" class="dropdown-item">Another action</a>
                          <a href="#" class="dropdown-item"> Something else here </a>
                          <a class="dropdown-divider"></a>
                          <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                      </div>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-8">
                        <p class="text-center">
                          <strong>Sales: 1 Jan, 2023 - 30 Jul, 2023</strong>
                        </p>
                        <div id="sales-chart"></div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-4">
                        <p class="text-center"><strong>Goal Completion</strong></p>
                        <div class="progress-group">
                          Add Products to Cart
                          <span class="float-end"><b>160</b>/200</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-primary" style="width: 80%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Complete Purchase
                          <span class="float-end"><b>310</b>/400</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-danger" style="width: 75%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">Visit Premium Page</span>
                          <span class="float-end"><b>480</b>/800</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-success" style="width: 60%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Send Inquiries
                          <span class="float-end"><b>250</b>/500</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-warning" style="width: 50%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- ./card-body -->
                  <div class="card-footer">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> 17%
                          </span>
                          <h5 class="fw-bold mb-0">$35,210.43</h5>
                          <span class="text-uppercase">TOTAL REVENUE</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-info"> <i class="bi bi-caret-left-fill"></i> 0% </span>
                          <h5 class="fw-bold mb-0">$10,390.90</h5>
                          <span class="text-uppercase">TOTAL COST</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                            <i class="bi bi-caret-up-fill"></i> 20%
                          </span>
                          <h5 class="fw-bold mb-0">$24,813.53</h5>
                          <span class="text-uppercase">TOTAL PROFIT</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center">
                          <span class="text-danger">
                            <i class="bi bi-caret-down-fill"></i> 18%
                          </span>
                          <h5 class="fw-bold mb-0">1200</h5>
                          <span class="text-uppercase">GOAL COMPLETIONS</span>
                        </div>
                      </div>
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
              <!-- Start col -->
              <div class="col-md-8">
                <!--begin::Latest Order Widget-->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Orders</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th>Order ID</th>
                            <th>Item</th>
                            <th>Status</th>
                            <th>Popularity</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR9842</a
                              >
                            </td>
                            <td>Call of Duty IV</td>
                            <td><span class="badge text-bg-success"> Shipped </span></td>
                            <td><div id="table-sparkline-1"></div></td>
                          </tr>
                          <tr>
                            <td>
                              <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR1848</a
                              >
                            </td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge text-bg-warning">Pending</span></td>
                            <td><div id="table-sparkline-2"></div></td>
                          </tr>
                          <tr>
                            <td>
                              <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR7429</a
                              >
                            </td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="badge text-bg-danger"> Delivered </span></td>
                            <td><div id="table-sparkline-3"></div></td>
                          </tr>
                          <tr>
                            <td>
                              <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR7429</a
                              >
                            </td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge text-bg-info">Processing</span></td>
                            <td><div id="table-sparkline-4"></div></td>
                          </tr>
                          <tr>
                            <td>
                              <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR1848</a
                              >
                            </td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge text-bg-warning">Pending</span></td>
                            <td><div id="table-sparkline-5"></div></td>
                          </tr>
                          <tr>
                            <td>
                              <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR7429</a
                              >
                            </td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="badge text-bg-danger"> Delivered </span></td>
                            <td><div id="table-sparkline-6"></div></td>
                          </tr>
                          <tr>
                            <td>
                              <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR9842</a
                              >
                            </td>
                            <td>Call of Duty IV</td>
                            <td><span class="badge text-bg-success">Shipped</span></td>
                            <td><div id="table-sparkline-7"></div></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary float-start">
                      Place New Order
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-end">
                      View All Orders
                    </a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="card mb-3">
                  <div class="card-header">
                    <h3 class="card-title">Browser Usage</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-12"><div id="pie-chart"></div></div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          United States of America
                          <span class="float-end text-danger">
                            <i class="bi bi-arrow-down fs-7"></i>
                            12%
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          India
                          <span class="float-end text-success">
                            <i class="bi bi-arrow-up fs-7"></i> 4%
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          China
                          <span class="float-end text-info">
                            <i class="bi bi-arrow-left fs-7"></i> 0%
                          </span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.footer -->
                </div>
                <!-- /.card -->
                <!-- PRODUCT LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Recently Added Products</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="px-2">
                      <div class="d-flex border-top py-2 px-1">
                        <div class="col-2">
                          <img
                            src="/roast-ms/dist/assets/img/default-150x150.png"
                            alt="Product Image"
                            class="img-size-50"
                          />
                        </div>
                        <div class="col-10">
                          <a href="javascript:void(0)" class="fw-bold">
                            Samsung TV
                            <span class="badge text-bg-warning float-end"> $1800 </span>
                          </a>
                          <div class="text-truncate">Samsung 32" 1080p 60Hz LED Smart HDTV.</div>
                        </div>
                      </div>
                      <!-- /.item -->
                      <div class="d-flex border-top py-2 px-1">
                        <div class="col-2">
                          <img
                            src="/roast-ms/dist/assets/img/default-150x150.png"
                            alt="Product Image"
                            class="img-size-50"
                          />
                        </div>
                        <div class="col-10">
                          <a href="javascript:void(0)" class="fw-bold">
                            Bicycle
                            <span class="badge text-bg-info float-end"> $700 </span>
                          </a>
                          <div class="text-truncate">
                            26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                          </div>
                        </div>
                      </div>
                      <!-- /.item -->
                      <div class="d-flex border-top py-2 px-1">
                        <div class="col-2">
                          <img
                            src="/roast-ms/dist/assets/img/default-150x150.png"
                            alt="Product Image"
                            class="img-size-50"
                          />
                        </div>
                        <div class="col-10">
                          <a href="javascript:void(0)" class="fw-bold">
                            Xbox One
                            <span class="badge text-bg-danger float-end"> $350 </span>
                          </a>
                          <div class="text-truncate">
                            Xbox One Console Bundle with Halo Master Chief Collection.
                          </div>
                        </div>
                      </div>
                      <!-- /.item -->
                      <div class="d-flex border-top py-2 px-1">
                        <div class="col-2">
                          <img
                            src="/roast-ms/dist/assets/img/default-150x150.png"
                            alt="Product Image"
                            class="img-size-50"
                          />
                        </div>
                        <div class="col-10">
                          <a href="javascript:void(0)" class="fw-bold">
                            PlayStation 4
                            <span class="badge text-bg-success float-end"> $399 </span>
                          </a>
                          <div class="text-truncate">PlayStation 4 500GB Console (PS4)</div>
                        </div>
                      </div>
                      <!-- /.item -->
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="javascript:void(0)" class="uppercase"> View All Products </a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline"></div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          © <span id="year"></span> ROAST-MS Dev. <span class="fw-light">|</span>
        </strong>
        All Rights Reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
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
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
    <script>
      // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
      // IT'S ALL JUST JUNK FOR DEMO
      // ++++++++++++++++++++++++++++++++++++++++++

      /* apexcharts
       * -------
       * Here we will create a few charts using apexcharts
       */

      //-----------------------
      // - MONTHLY SALES CHART -
      //-----------------------

      const sales_chart_options = {
        series: [
          {
            name: 'Digital Goods',
            data: [28, 48, 40, 19, 86, 27, 90],
          },
          {
            name: 'Electronics',
            data: [65, 59, 80, 81, 56, 55, 40],
          },
        ],
        chart: {
          height: 180,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2023-01-01',
            '2023-02-01',
            '2023-03-01',
            '2023-04-01',
            '2023-05-01',
            '2023-06-01',
            '2023-07-01',
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#sales-chart'),
        sales_chart_options,
      );
      sales_chart.render();

      //---------------------------
      // - END MONTHLY SALES CHART -
      //---------------------------

      function createSparklineChart(selector, data) {
        const options = {
          series: [{ data }],
          chart: {
            type: 'line',
            width: 150,
            height: 30,
            sparkline: {
              enabled: true,
            },
          },
          colors: ['var(--bs-primary)'],
          stroke: {
            width: 2,
          },
          tooltip: {
            fixed: {
              enabled: false,
            },
            x: {
              show: false,
            },
            y: {
              title: {
                formatter: function (seriesName) {
                  return '';
                },
              },
            },
            marker: {
              show: false,
            },
          },
        };

        const chart = new ApexCharts(document.querySelector(selector), options);
        chart.render();
      }

      const table_sparkline_1_data = [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54];
      const table_sparkline_2_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44];
      const table_sparkline_3_data = [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64];
      const table_sparkline_4_data = [30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64];
      const table_sparkline_5_data = [20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64];
      const table_sparkline_6_data = [5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44];
      const table_sparkline_7_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74];

      createSparklineChart('#table-sparkline-1', table_sparkline_1_data);
      createSparklineChart('#table-sparkline-2', table_sparkline_2_data);
      createSparklineChart('#table-sparkline-3', table_sparkline_3_data);
      createSparklineChart('#table-sparkline-4', table_sparkline_4_data);
      createSparklineChart('#table-sparkline-5', table_sparkline_5_data);
      createSparklineChart('#table-sparkline-6', table_sparkline_6_data);
      createSparklineChart('#table-sparkline-7', table_sparkline_7_data);

      //-------------
      // - PIE CHART -
      //-------------

      const pie_chart_options = {
        series: [700, 500, 400, 600, 300, 100],
        chart: {
          type: 'donut',
        },
        labels: ['Chrome', 'Edge', 'FireFox', 'Safari', 'Opera', 'IE'],
        dataLabels: {
          enabled: false,
        },
        colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'],
      };

      const pie_chart = new ApexCharts(document.querySelector('#pie-chart'), pie_chart_options);
      pie_chart.render();

      //-----------------
      // - END PIE CHART -
      //-----------------
    </script>
    <script src="/roast-ms/dist/js/script.js"></script>
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
