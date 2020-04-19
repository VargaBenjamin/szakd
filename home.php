<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php?error=out");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Főoldal</title>
        <link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> <!--alap-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"><!--responsive-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Coach2Client</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <?php require 'parts/sideNav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Irányítópult</h1>
                        <div class="row">
                          <div class="col-xl-10">
                            <div class="card-header bg-warning"><i class="fas fa-comment-alt"></i>Friss hírünk</div>
                            <?php require 'parts/postLoadsMain.php'; ?>
                          </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Area Chart Example</div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Bar Chart Example</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Feljegyzett eredményeim</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>Dátum</th>
                                            <th>Súly (kg)</th>
                                            <th>Testzsírszázalék (%)</th>
                                            <th>Combbőség (cm)</th>
                                            <th>Derékbőség (cm)</th>
                                            <th>Csipőbőség (cm)</th>
                                            <th>Mellbőség (cm)</th>
                                            <th>Vállszélesség (cm)</th>
                                            <th>Karbőség (cm)</th>
                                            <th>Adott idő alatt futás (15 perc/km)</th>
                                            <th>Adott km alatti idő (5 km/perc)</th>
                                            <th>Felhúzás max (kg)</th>
                                            <th>Fekvenyomás max (kg)</th>
                                            <th>Gugolás max (kg)</th>
                                            <th>Felhúzás saját súly (db)</th>
                                            <th>Fekvenyomás saját súly (db)</th>
                                            <th>Gugolás saját súly (db)</th>
                                          </tr>
                                      </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php require 'parts/footer.php'; ?>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/homeScripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script><!--alap-->
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" charset="utf-8"></script><!--responsive-->
        <script src="js/datatablesScript.js"></script>

    </body>
</html>
