<?php
session_start();
require "parts/db.php";

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
        <title>Kimutatásaim beállítás</title>
				<link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
				<link href="vendor/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
				<script src="vendor/fontAwesome/js/all.min.js" charset="utf-8"></script>

				<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Coach2Client</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
				<div id="layoutSidenav">
						<?php require 'parts/sideNav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
									<div id="alert"></div>
                    <div class="container-fluid">
                        <h1 class="mt-4">Kimutatásaim beállítás</h1>
                    </div>
                </main>
								<div class="container bootstrap snippets">
								<div class="row">
								  <div class="col-md-12">
								    <form class="form-horizontal" action="" method="post" id="chartMainForm">

											<div class="form-group">
												<div class="col-md-12 row">
													<label for="formControlRange">Visszamenőleg nézendő aktív napok száma:</label>
													<input type="range" min="0" max="60" value="" class="form-control-range col-md-11" id="valueRange">
													<span class="font-weight-bold col-md-1" id="valueSpan"></span>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-md-12 control-label">Vezérlőpulton megjelenő kimutatások kiválasztása (min. 1, max. 8 db)</label>
												<div class="col-md-6">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="0" value="0">Súly<br>
														<input class="form-check-input" type="checkbox" id="1" value="1">Testzsírszázalék<br>
														<input class="form-check-input" type="checkbox" id="2" value="2">Combbőség<br>
														<input class="form-check-input" type="checkbox" id="3" value="3">Derékbőség<br>
														<input class="form-check-input" type="checkbox" id="4" value="4">Csípőbőség<br>
														<input class="form-check-input" type="checkbox" id="5" value="5">Mellbőség<br>
														<input class="form-check-input" type="checkbox" id="6" value="6">Vállszélesség<br>
														<input class="form-check-input" type="checkbox" id="7" value="7">Karbőség<br>
														<input class="form-check-input" type="checkbox" id="8" value="8">12perc / m<br>
														<input class="form-check-input" type="checkbox" id="9" value="9">2300m / perc<br>
														<input class="form-check-input" type="checkbox" id="10" value="10">Felhúzás max<br>
														<input class="form-check-input" type="checkbox" id="11" value="11">Fekvenyomás max<br>
														<input class="form-check-input" type="checkbox" id="12" value="12">Gugolás max<br>
														<input class="form-check-input" type="checkbox" id="13" value="13">Felhúzás saját<br>
														<input class="form-check-input" type="checkbox" id="14" value="14">Fekvenyomás saját<br>
														<input class="form-check-input" type="checkbox" id="15" value="15">Gugolás saját<br>
													</div>
												</div>
											</div>

											<button type="submit" class="col-sm-7 btn btn-warning">Naptáram adatainak módosítása</button>
								    </form>
								  </div>
								</div>
								</div>
                <?php require 'parts/footer.php'; ?>
            </div>
        </div>
				<input id="useridOpt" type="hidden" name="id" value='<?php echo $_SESSION["id"] ?>'>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
				<script src="js/chartOptScript.js"></script>
				<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    </body>
</html>
