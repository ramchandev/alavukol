<?php include("lang/en.php");?>
<!DOCTYPE html>
<html lang="en">
    <head>
       <?php include("includes/header.php");?>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
        <?php include("includes/top-bar.php");?> 
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                <?php include("includes/sidebar.php");?>                     
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-dark pb-10">
                        <div class="container">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                                            Tables
                                        </h1>
                                        <div class="page-header-subtitle">An extended version of the DataTables library, customized for SB Admin Pro</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Extended DataTables</div>
                            <div class="card-body">
                                 <!-- Main Body -->
                            </div>
                        </div>
                       
                    </div>
                </main>
                <footer class="footer mt-auto footer-light">
                    <?php include("includes/footer.php");?>
                </footer>
            </div>
        </div>
        <?php include("includes/footer-scripts.php");?>
    </body>
</html>
