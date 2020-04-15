<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
	 header("Location: index.php?error=out");
	 exit();
}
if (isset($_SESSION['id'])) {
echo("<script>console.log('PHP: " . $_SESSION['id'] . "');</script>");
} else {
echo("<script>console.log('baj van');</script>");
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
				<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> <!--alap-->
				<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"><!--responsive-->
				<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css"><!--fixhead-->
				<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"><!--custombutton-->
				<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"><!--select-->
				<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">-->
				<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <h1 class="mt-4">Naplóm</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
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
								<!-- Modal -->
								<div id="creatModal" class="modal fade">
									<div class="modal-dialog">
											<div class="modal-content">
												<form class="form-addExEv" action="tableCreat.php" method="post">
														<div class="modal-header">
																<h4 class="modal-title">Eredmények felírása</h4>
																<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
														</div>
														<div class="modal-body">
															<div class="form-group">
																<label for="">Súly (kg)</label>
																<input id="sulyC" type="text" name="sulyC" value="90">
															</div>
															<div class="form-group">
																<label for="">Testzsírszázalék (%)</label>
																<input id="zsirC" type="text" name="zsirC" value="20">
															</div>
															<div class="form-group">
																<label for="">Combbőség (cm)</label>
																<input id="combC" type="text" name="combC" value="40">
															</div>
															<div class="form-group">
																<label for="">Derékbőség (cm)</label>
																<input id="derekC" type="text" name="derekC" value="100">
															</div>
															<div class="form-group">
																<label for="">Csipőbőség (cm)</label>
																<input id="csipoC" type="text" name="csipoC" value="80">
															</div>
															<div class="form-group">
																<label for="">Mellbőség (cm)</label>
																<input id="mellC" type="text" name="mell" value="110">
															</div>
															<div class="form-group">
																<label for="">Vállszélesség (cm)</label>
																<input id="vallC" type="text" name="vall" value="120">
															</div>
															<div class="form-group">
																<label for="">Karbőség (cm)</label>
																<input id="karC" type="text" name="kar" value="35">
															</div>
															<div class="form-group">
																<label for="">Adott idő alatt futás (15 perc/km)</label>
																<input id="futidoC" type="text" name="futido" value="5">
															</div>
															<div class="form-group">
																<label for="">Adott km alatti idő (5 km/perc)</label>
																<input id="futkmC" type="text" name="futkm" value="15">
															</div>
															<div class="form-group">
																<label for="">Felhúzás max (kg)</label>
																<input id="huzmaxC" type="text" name="huzmax" value="95">
															</div>
															<div class="form-group">
																<label for="">Fekvenyomás max (kg)</label>
																<input id="nyommaxC" type="text" name="nyommax" value="100">
															</div>
															<div class="form-group">
																<label for="">Gugolás max (kg)</label>
																<input id="gugmaxC" type="text" name="gugmax" value="100">
															</div>
															<div class="form-group">
																<label for="">Felhúzás saját súly (db)</label>
																<input id="huzsajatC" type="text" name="huzsajat" value="20">
															</div>
															<div class="form-group">
																<label for="">Fekvenyomás saját súly (db)</label>
																<input id="nyomsajatC" type="text" name="nyomsajat" value="30">
															</div>
															<div class="form-group">
																<label for="">Gugolás saját súly (db)</label>
																<input id="gugsajatC" type="text" name="gugsajat" value="50">
															</div>
														</div>
														<div class="modal-footer">
															<input id="idC" type="hidden" name="id" value='<?php echo $_SESSION["id"] ?>'>
															<button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
															<button id="creatSumbit" type="submit" name="creatSumbit" class="btn btn-primary">Létrehozás</button>
														</div>
													</form>
											</div>
									</div>
								</div>
								<!-- Modal -->
								<div id="updateModal" class="modal fade">
									<div class="modal-dialog">
											<div class="modal-content">
												<form class="form-addExEv" action="tableCreat.php" method="post">
														<div class="modal-header">
																<h4 class="modal-title">Eredmények frissítése</h4>
																<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
														</div>
														<div class="modal-body">
															<div class="form-group">
																<label for="">Súly (kg)</label>
																<input id="sulyU" type="text" name="suly" value="">
															</div>
															<div class="form-group">
																<label for="">Testzsírszázalék (%)</label>
																<input id="zsirU" type="text" name="zsir" value="">
															</div>
															<div class="form-group">
																<label for="">Combbőség (cm)</label>
																<input id="combU" type="text" name="comb" value="">
															</div>
															<div class="form-group">
																<label for="">Derékbőség (cm)</label>
																<input id="derekU" type="text" name="derek" value="">
															</div>
															<div class="form-group">
																<label for="">Csipőbőség (cm)</label>
																<input id="csipoU" type="text" name="csipo" value="">
															</div>
															<div class="form-group">
																<label for="">Mellbőség (cm)</label>
																<input id="mellU" type="text" name="mell" value="">
															</div>
															<div class="form-group">
																<label for="">Vállszélesség (cm)</label>
																<input id="vallU" type="text" name="vall" value="">
															</div>
															<div class="form-group">
																<label for="">Karbőség (cm)</label>
																<input id="karU" type="text" name="kar" value="">
															</div>
															<div class="form-group">
																<label for="">Adott idő alatt futás (15 perc/km)</label>
																<input id="futidoU" type="text" name="futido" value="">
															</div>
															<div class="form-group">
																<label for="">Adott km alatti idő (5 km/perc)</label>
																<input id="futkmU" type="text" name="futkm" value="">
															</div>
															<div class="form-group">
																<label for="">Felhúzás max (kg)</label>
																<input id="huzmaxU" type="text" name="huzmax" value="">
															</div>
															<div class="form-group">
																<label for="">Fekvenyomás max (kg)</label>
																<input id="nyommaxU" type="text" name="nyommax" value="">
															</div>
															<div class="form-group">
																<label for="">Gugolás max (kg)</label>
																<input id="gugmaxU" type="text" name="gugmax" value="">
															</div>
															<div class="form-group">
																<label for="">Felhúzás saját súly (db)</label>
																<input id="huzsajatU" type="text" name="huzsajat" value="">
															</div>
															<div class="form-group">
																<label for="">Fekvenyomás saját súly (db)</label>
																<input id="nyomsajatU" type="text" name="nyomsajat" value="">
															</div>
															<div class="form-group">
																<label for="">Gugolás saját súly (db)</label>
																<input id="gugsajatU" type="text" name="gugsajat" value="">
															</div>
														</div>
														<div class="modal-footer">
																<input id="idU" type="hidden" name="id" value="">
																<button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
																<button id="updateSubmit" type="submit" name="updateSubmit" class="btn btn-primary">Frissítés</button>
														</div>
													</form>
											</div>
									</div>
								</div>
                <?php require 'parts/footer.php'; ?>
            </div>
        </div>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
				<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/homeScripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script><!--alap-->
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" charset="utf-8"></script><!--responsive-->
				<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js" charset="utf-8"></script><!--fixhead-->
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" charset="utf-8"></script><!--custombutton-->
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js" charset="utf-8"></script><!--colVisibility-->
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" charset="utf-8"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" charset="utf-8"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js" charset="utf-8"></script>
				<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" charset="utf-8"></script><!--select-->
				<!--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js" charset="utf-8"></script>-->
				<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js" charset="utf-8"></script>
        <script src="js/datatables.js"></script>
    </body>
</html>
