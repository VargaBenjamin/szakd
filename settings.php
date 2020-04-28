<?php
//settings.php
session_start();
if (!isset($_SESSION['loggedin'])) {
	 header("Location: index.php?error=out");
	 exit();
}
require 'parts/db.php';

if ($stmt = $con->prepare('SELECT * FROM gym'))
{
	$stmt->execute();
	$result = $stmt->get_result();
	$gymoutput = '<option value="">Válassz!</option>';
	while ($row = $result->fetch_assoc()) {
		$gymoutput .='<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
	}
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
				<link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
				<script src="vendor/fontAwesome/js/all.min.js" charset="utf-8"></script>
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
								  <div class="col-sm-12">
								    <form class="form" action="" method="post" id="settingsUpdate">
											<div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">Fontosabb adatok</h4>
								        </div>
								        <div class="panel-body">
								          <div class="form-group row">
								            <label class="col-md-4 control-label">Felhasználónév</label>
														<div class="col-md-8">
								              <input type="text" class="form-control" id="username">
								            </div>
								          </div>
													<div class="form-group row">
								            <label class="col-md-4 control-label">Email cím</label>
														<div class="col-md-8">
								              <input type="email" class="form-control" id="email">
								            </div>
								          </div>
													<div class="form-group row">
								            <label class="col-md-4 control-label">Edzőterem választás</label>
														<div class="col-md-8">
															<select class="form-control" id="gym">
																<?php echo $gymoutput; ?>
															</select>
								            </div>
								          </div>
													<div class="form-group row" id="coaches" style="display: none">
								            <label class="col-md-4 control-label">Edző választás</label>
														<div class="col-md-8">
															<select class="form-control" id="coach">
															</select>
								            </div>
								          </div>
								        </div>
								      </div>

								      <div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">Egyéb adatok</h4>
								        </div>
								        <div class="panel-body">
													<div class="form-group row">
								            <label class="col-md-4 control-label">Telefonszám</label>
								            <div class="col-md-8">
								              <input type="tel" class="form-control" id="telephone">
								            </div>
								          </div>
													<div class="form-group row">
														<div class="col-md-4"></div>
														<button type="button" class="col-md-8 btn btn-danger" onclick="window.location.href='syncCallback.php?provider=Google'">Szinkronizálás a Google-lel</button>
													</div>
													<div class="form-group row">
														<div class="col-md-4"></div>
														<button type="button" class="col-md-8 btn btn-primary" onclick="window.location.href='syncCallback.php?provider=Facebook'">Szinkronizálás a Facebookkal</button>
													</div>
													<div class="form-group row">
														<div class="col-md-4"></div>
														<button type="button" class="col-md-8 btn btn-info" onclick="window.location.href='syncCallback.php?provider=Twitter'">Szinkronizálás a Twitterrel</button>
													</div>
								        </div>
								      </div>

											<div class="panel panel-default">
												<div class="panel-heading">
												<h4 class="panel-title">Jelszó</h4>
												</div>
												<div class="panel-body">
													<div class="form-group row">
														<label class="col-md-4 control-label">Új jelszó</label>
														<div class="col-md-8">
															<input type="password" class="form-control" id="newPass">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-md-4 control-label">Új jelszó újra</label>
														<div class="col-md-8">
															<input type="password" class="form-control" id="newPassRe">
														</div>
													</div>
												</div>
											</div>

											<div class="panel panel-default">
												<div class="panel-heading">
												<h4 class="panel-title">Mentéshez adja meg a jelenlegi jelszavát</h4>
												</div>
												<div class="panel-body">
													<div class="form-group row">
														<label class="col-md-4 control-label">Jelszó</label>
														<div class="col-md-8">
															<input type="password" class="form-control" required id="pass">
														</div>
													</div>
												</div>
											</div>
											<span id="alert"></span>
											<button type="submit" class="col-md-12 btn btn-success">Módosítások mentése</button>
								    </form>
								  </div>
								</div>
								</div>
                <?php require 'parts/footer.php'; ?>
            </div>
        </div>
				<input id="id" type="hidden" name="id" value='<?php echo $_SESSION["id"] ?>'>
				<input id="role" type="hidden" name="role" value='<?php echo $_SESSION["coach"] ?>'>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
				<script src="js/settingScripts.js"></script>
    </body>
</html>
