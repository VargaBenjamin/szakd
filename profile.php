<?php
session_start();
require "parts/db.php";

if (!isset($_SESSION['loggedin'])) {
	 header("Location: index.php?error=out");
	 exit();
}

include 'hybridauth/autoload.php';
include 'parts/config.php';

use Hybridauth\Hybridauth;

$hybridauth = new Hybridauth($config);
$adapters = $hybridauth->getConnectedAdapters();
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
        <title>Adataim</title>
				<link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
				<link href="vendor/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
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
                        <h1 class="mt-4">Adataim</h1>
                    </div>
                </main>
								<div class="container bootstrap snippets">
								<div class="row">
								  <div class="col-md-12">
								    <form class="form-horizontal">
								      <div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">Fontosabb adatok</h4>
								        </div>
								        <div class="panel-body">
								          <div class="form-group">
								            <label class="col-sm-4 control-label">Felhasználónév</label>
														<label class="col-sm-4 control-label font-weight-bold"><?=$_SESSION['name']?></label>
								          </div>
													<div class="form-group">
								            <label class="col-sm-4 control-label">Email cím</label>
														<label class="col-sm-4 control-label font-weight-bold"><?=$email?></label>
								          </div>
													<div class="form-group">
								            <label class="col-sm-4 control-label">Titulus</label>
														<label class="col-sm-4 control-label font-weight-bold">
															<?php
															if ($coach == 1) {
																echo "Edző";
															}
															else {
																echo "Vendég";
															}
															?>
													</label>
								          </div>
													<div class="form-group">
								            <label class="col-sm-4 control-label">Edzőterem</label>
														<label class="col-sm-4 control-label font-weight-bold">
														<input type="hidden" id="gym" value="<?= $gid ?>"/>
														<span id="resultG"></span>
													</label>
								          </div>
													<div class="form-group">
								            <label class="col-sm-4 control-label">Edző</label>
														<label class="col-sm-4 control-label font-weight-bold">
														<input type="hidden" id="coach" value="<?= $cid ?>"/>
														<span id="resultC"></span>
													</label>
								          </div>
								        </div>
								      </div>

								      <div class="panel panel-default">
								        <div class="panel-heading">
								        <h4 class="panel-title">Egyéb adatok</h4>
								        </div>
								        <div class="panel-body">

													<div class="form-group">
								            <label class="col-sm-4 control-label">Aktivált felhasználó</label>
														<label class="col-sm-4 control-label font-weight-bold">
															<?php
															if ($accode == "activated") {
																echo "Aktivált";
															} else {
																echo "Nincs aktiválva";
															}
															?>
													</label>
								          </div>
													<div class="form-group">
								            <label class="col-sm-4 control-label">Telefonszám</label>
														<label class="col-sm-4 control-label font-weight-bold">
															<?php
															if (!is_null($telephone)) {
																echo $telephone;
															} else {
																echo "Nincs megadva";
															}
															?>
													</label>
								          </div>
													<div class="form-group">
								            <label class="col-sm-4 control-label">Google szinkronizálás</label>
														<label class="col-sm-4 control-label">
															<?php
															if (!is_null($gVal)) {
																echo '<i class="fas fa-check-circle"></i>';
															} else {
																echo '<i class="fas fa-times-circle"></i>';
															}
															?>
													</label>
								          </div>
													<div class="form-group">
								            <label class="col-sm-4 control-label">Facebook szinkronizálás</label>
														<label class="col-sm-4 control-label">
															<?php
															if (!is_null($fVal)) {
																echo '<i class="fas fa-check-circle"></i>';
															} else {
																echo '<i class="fas fa-times-circle"></i>';
															}
															?>
													</label>
								          </div>
													<div class="form-group">
								            <label class="col-sm-4 control-label">Twitter szinkronizálás</label>
														<label class="col-sm-4 control-label">
															<?php
															if (!is_null($tVal)) {
																echo '<i class="fas fa-check-circle"></i>';
															} else {
																echo '<i class="fas fa-times-circle"></i>';
															}
															?>
													</label>
								          </div>
								        </div>
								      </div>
								    </form>
										<button type="button" class="col-sm-7 btn btn-warning" onclick="window.location.href='settings.php'">Adataim módosítása</button>
								  </div>
								</div>
								</div>
                <?php require 'parts/footer.php'; ?>
            </div>
        </div>
				<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>
				<script src="js/profileScripts.js"></script>
    </body>
</html>
