<?php
session_start();
require "parts/db.php";

if (!isset($_SESSION['loggedin'])) {
	 header("Location: index.php?error=out");
	 exit();
}

if ($_SESSION['coach'] == 0) {
	header("Location: home.php");
}


$stmt = $con->prepare('SELECT email, coach, telephone, Google, Facebook, Twitter, activation_code, gymid, coachid FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $coach, $telephone, $gVal, $fVal, $tVal, $accode, $gid, $cid);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Naptár beállítás</title>
				<link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
				<link href="vendor/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
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
                        <h1 class="mt-4">Naptár beállítás</h1>
                    </div>
                </main>
								<div class="container bootstrap snippets">
								<div class="row">
								  <div class="col-md-12">
								    <form class="form-horizontal" action="" method="post" id="calendarOptionUpdate">
								      <div class="panel panel-default">
								        <div class="panel-body">
								          <div class="form-group row">
								            <label class="col-sm-4 control-label">Alapértelmezett nézet</label>
														<div class="col-md-6">
															<select class="form-control" id="basicView">
																<option value="timeGridDay">Napi nézet</option>
																<option value="timeGridWeek">Heti nézet</option>
																<option value="dayGridMonth">Havi nézet (nem ajánlott)</option>
															</select>
								            </div>
								          </div>
													<div class="form-group row">
								            <label class="col-sm-4 control-label">Nézetek</label>
														<div class="col-md-8">
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="timeGridDay" value="timeGridDay">
															  <label class="form-check-label" for="timeGridDay">Napi</label>
															</div>
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="timeGridWeek" value="timeGridWeek">
															  <label class="form-check-label" for="timeGridWeek">Heti</label>
															</div>
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="dayGridMonth" value="dayGridMonth">
															  <label class="form-check-label" for="dayGridMonth">Havi</label>
															</div>
								            </div>
								          </div>
													<div class="form-group row">
								            <label class="col-sm-4 control-label">Szabad napok</label>
														<div class="col-md-6">
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="1" value="1">
															  <label class="form-check-label" for="1">Hétfő</label>
															</div>
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="2" value="2">
															  <label class="form-check-label" for="2">Kedd</label>
															</div>
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="3" value="3">
															  <label class="form-check-label" for="3">Szerda</label>
															</div>
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="4" value="4">
															  <label class="form-check-label" for="4">Csütörtök</label>
															</div>
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="5" value="5">
															  <label class="form-check-label" for="5">Péntek</label>
															</div>
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="6" value="6">
															  <label class="form-check-label" for="6">Szombat</label>
															</div>
															<div class="form-check form-check-inline">
															  <input class="form-check-input" type="checkbox" id="0" value="0">
															  <label class="form-check-label" for="0">Vasárnap</label>
															</div>
								            </div>
								          </div>
													<div class="form-group row">
								            <label class="col-md-4 control-label">Kezdés ideje</label>
														<input id="dayStart" class="form-control col-md-6" type="text" name="dayStart">
								          </div>
													<div class="form-group row">
								            <label class="col-md-4 control-label">Befejezés ideje</label>
														<input id="dayEnd" class="form-control col-md-6" type="text" name="dayEnd">
								          </div>
													<div class="form-group row">
								            <label class="col-md-6 control-label">Egy időben több esemény engedélyezése</label>
														<input type="checkbox" name="overlap" id="overlap" data-toggle="toggle" data-on="Igen" data-off="Nem" data-onstyle="danger" data-offstyle="primary" data-width="240">
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
				<input id="coachidOpt" type="hidden" name="id" value='<?php echo $_SESSION["id"] ?>'>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
				<script src="js/calendarOptScript.js"></script>
				<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    </body>
</html>
