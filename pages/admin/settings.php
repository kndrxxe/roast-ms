<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/roast-ms/auth.php';
checkRole(['Administrator']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Settings | ROAST-MS</title>
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
                                <i class="nav-icon bi bi-chevron-left"></i>
                                <p>Back to Dashboard</p>
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
                            <h3 class="mb-0 fw-bold">Account Settings</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <div class="col">
                            <div class="card">
                                <div class="card-header fw-bold">
                                    <i class="bi bi-person-gear"></i> Username
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <?php echo getUsername() ?>
                                    <button type="button" class="btn btn-dark editbtn" data-bs-toggle="modal"
                                        data-bs-target="#editUsernameModal">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header fw-bold">
                                    <i class="bi bi-key-fill"></i> Password
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-dark editpassbtn" data-bs-toggle="modal"
                                        data-bs-target="#editPasswordModal">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <?php $conn->close(); ?>
</body>

</html>