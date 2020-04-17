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
        <title>Lista</title>
				<link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
				<link href="vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
				<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.semanticui.min.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
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
                        <h1 class="mt-4">Tables</h1>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Felvitt adatok</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="dataTable">
                                      <?php include 'parts/tableLoad.php' ?>
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
				<script src="https://cdn.datatables.net/1.10.20/js/dataTables.semanticui.min.js" charset="utf-8"></script>
				<script src="https://code.jquery.com/jquery-3.3.1.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js" charset="utf-8"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" charset="utf-8"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" charset="utf-8"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" charset="utf-8"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
        <script src="js/datatables.js"></script>
    </body>
</html>
