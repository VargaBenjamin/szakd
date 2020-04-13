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
        <title>Beállítások</title>
				<link href="homeStyle.css" type="text/css" rel="stylesheet" />
				<link href="profileStyle.css" type="text/css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home.php">Coach2Client</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
				<div id="layoutSidenav">
						<?php require 'parts/sideNav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Beállítások</h1>
                    </div>
                </main>
								<div class="container bootstrap snippets">
								<div class="row">
								  <div class="col-xs-12 col-sm-9">
								    <form class="form-horizontal" action="authenticateSettings.php">
											<div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">Fontosabb adatok</h4>
								        </div>
								        <div class="panel-body">
								          <div class="form-group">
								            <label class="col-sm-3 control-label">Felhasználónév</label>
														<div class="col-sm-7">
								              <input type="text" class="form-control">
								            </div>
								          </div>
													<div class="form-group">
								            <label class="col-sm-3 control-label">Email cím</label>
														<div class="col-sm-7">
								              <input type="email" class="form-control">
								            </div>
								          </div>
								        </div>
								      </div>

								      <div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">Egyéb adatok</h4>
								        </div>
								        <div class="panel-body">
													<div class="form-group">
								            <label class="col-sm-3 control-label">Telefonszám</label>
								            <div class="col-sm-7">
								              <input type="tel" class="form-control">
								            </div>
								          </div>
													<div class="form-group">
														<button type="button" class="col-sm-4 btn btn-danger" onclick="window.location.href='syncCallback.php?provider=Google'">Szinkronizálás a Google-lel</button>
													</div>
													<div class="form-group">
														<button type="button" class="col-sm-4 btn btn-primary" onclick="window.location.href='syncCallback.php?provider=Facebook'">Szinkronizálás a Facebookkal</button>
													</div>
													<div class="form-group">
														<button type="button" class="col-sm-4 btn btn-info" onclick="window.location.href='syncCallback.php?provider=Twitter'">Szinkronizálás a Twitterrel</button>
													</div>
								        </div>
								      </div>

											<div class="panel panel-default">
												<div class="panel-heading">
												<h4 class="panel-title">Jelszó</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<label class="col-sm-3 control-label">Új jelszó</label>
														<div class="col-sm-7">
															<input type="password" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Új jelszó újra</label>
														<div class="col-sm-7">
															<input type="password" class="form-control">
														</div>
													</div>
												</div>
											</div>

											<div class="panel panel-default">
												<div class="panel-heading">
												<h4 class="panel-title">Mentéshez adja meg a jelenlegi jelszavát</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<label class="col-sm-3 control-label">Jelszó</label>
														<div class="col-sm-7">
															<input type="password" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Jelszó újra</label>
														<div class="col-sm-7">
															<input type="password" class="form-control">
														</div>
													</div>
												</div>
											</div>
											<button type="submit" class="col-sm-7 btn btn-success">Módosítások mentése</button>
								    </form>
								  </div>
								</div>
								</div>
                <?php require 'parts/footer.php'; ?>
            </div>
        </div>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
    </body>
</html>
