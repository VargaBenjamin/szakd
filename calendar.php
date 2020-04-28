<?php
//calendar.php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php?error=out");
    exit();
}
require 'parts/db.php';
if (isset($_SESSION["coachid"])) {
  if ($stmt = $con->prepare('SELECT * FROM customevents WHERE coachid = "' . $_SESSION["coachid"] . '"'))
  {
    $customeventoutput = "";
  	$stmt->execute();
  	$result = $stmt->get_result();
  	while ($row = $result->fetch_assoc()) {
  		$customeventoutput .='<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
  	}
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
        <title>Naptáram</title>
        <link href="css/homeStyle.css" type="text/css" rel="stylesheet" />
			  <link href='fullcalendar/core/main.css' rel='stylesheet' />

			  <link href='fullcalendar/bootstrap/main.css' rel='stylesheet' />
			  <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
			  <link href='fullcalendar/timegrid/main.css' rel='stylesheet' />
			  <link href='fullcalendar/list/main.css' rel='stylesheet' />

			  <script src='fullcalendar/core/main.js'></script>

			  <script src='fullcalendar/core/locales/hu.js'></script>
			  <script src='fullcalendar/core/locales-all.js'></script>
			  <script src='fullcalendar/bootstrap/main.js'></script>
			  <script src='fullcalendar/daygrid/main.js'></script>
			  <script src='fullcalendar/timegrid/main.js'></script>
			  <script src='fullcalendar/interaction/main.js'></script>
			  <script src='fullcalendar/list/main.js'></script>
        <script src="vendor/fontAwesome/js/all.min.js" charset="utf-8"></script>


				<!--bootstrap kotelezo elemek-->
				<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
        <script src="vendor/jquery/jquery.min.js"></script> <!--ennek előbb kell lenie mint az alatta levo 2 boostrapnak a modalfelugrasnal-->
				<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
				<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
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
                        <h1 class="mt-4">Naptáram</h1>
                        <div id="alert"></div>
                        <div class="row" id="calLoad" >
                          <div class="col-md-3 col-md-push-3">
                            <div class="card">
                              <div class="card-header">Választható események</div>
                              <div class="card-body" id='external-events' style="overflow: auto;">
                                <div class="card-text" >
                                  <?php include 'parts/calendarCustomInit.php';?>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-9">
                            <div class="card">
                              <div class="card-header">Élő naptár</div>
                              <div class="card-body" id='calendar-container'>
                                <p class="card-text" id='calendar'></p>
                              </div>
                              <div class="col text-center">
                                <button id="customEventAdd" type="button" class="btn btn-dark float-left">Esemény hozzáadása</button>
                                <button id="customEventDelete" type="button" class="btn btn-danger float-right">Esemény törlése</button>
                              </div>
                            </div>
                          </div>

                          <div id='bottom'>
                            Locales:<select id='locale-selector'></select>
                          </div>
                        </div>
                  	  </div>
                    <?php require 'parts/footer.php'; ?>
                  </main>

									<!-- Modal -->
									<div id="createCustomModal" class="modal fade">
										<div class="modal-dialog">
												<div class="modal-content">
													<form class="form" action="" method="post">
															<div class="modal-header">
																	<h4 class="modal-title">Esemény létrehozása</h4>
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
															</div>
															<div class="modal-body">
																<div class="form-group">
																	<label for="">Esemény neve</label>
																	<input id="titleC" type="text" name="title" placeholder="Két órás edzés">
																</div>
																<div class="form-group">
																	<label for="">Esemény időtartama</label>
																	<input id="durationC" type="text" name="duration" placeholder="02:00">
																</div>
																<div class="form-group">
																	<label for="">Esemény színének kiválasztása</label>
																	<input id="colorC" type="color" name="color" value="#3788D8">
																</div>
															</div>
															<div class="modal-footer">
                                <input id="coachidC" type="hidden" name="id" value='<?php echo $_SESSION["id"] ?>'> <!-- Ha véletlenül egy kliens létretudna hozni, akkor se lássa senki -->
																<button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
                                <button type="submit" name="createSumbit" class="btn btn-primary">Létrehozás</button>
															</div>
														</form>
												</div>
										</div>
									</div>

                  <div id="deleteCustomModal" class="modal fade">
										<div class="modal-dialog">
												<div class="modal-content">
													<form class="form" action="" method="post">
															<div class="modal-header">
																	<h4 class="modal-title">Esemény törlése</h4>
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
															</div>
                              <div class="modal-body">
                                <div class="form-group">
      								            <label for="">Esemény törlése</label>
      															<select class="form-control" id="titleD">
      																<?php echo $customeventoutput; ?>
      															</select>
      								          </div>
                              </div>
															<div class="modal-footer">
                                <input id="coachidD" type="hidden" name="id" value='<?php echo $_SESSION["id"] ?>'> <!-- Ha véletlenül egy kliens létretudna hozni, akkor se lássa senki -->
																<button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
                                <button type="submit" name="createSumbit" class="btn btn-danger">TÖRLÉS</button>
															</div>
														</form>
												</div>
										</div>
									</div>

                  <div id="updateEventModal" class="modal fade">
										<div class="modal-dialog">
												<div class="modal-content">
													<form class="form" action="" method="post">
															<div class="modal-header">
																	<h4 class="modal-title">Esemény részletek</h4>
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
															</div>
															<div class="modal-body">
																<div class="form-group">
																	<label for="">Esemény neve:</label>
																	<input id="titleE" class="font-weight-bold" type="text" name="title" value="">
                                  <label id="titleCli" class="font-weight-bold" for=""></label>
																</div>
                                <div id="colorCoaE" class="form-group" style="">
                                  <label for="">Esemény színének kiválasztása:</label>
                                  <input id="colorE" type="color" name="color" value="">
                                </div>
                                <div class="form-group">
																	<label for="">Résztvevő neve:</label>
                                  <label id="nameE" class="font-weight-bold" for=""></label>
																</div>
                                <div class="form-group">
																	<label for="">Résztvevő elérhetősége:</label>
                                  <label id="emailE" class="font-weight-bold" for=""></label>
																</div>
                                <div class="form-group">
																	<label for="">Esemény kezdete:</label>
                                  <label id="startE" class="font-weight-bold" for=""></label>
																</div>
                                <div class="form-group">
																	<label for="">Esemény vége:</label>
                                  <label id="endE" class="font-weight-bold" for=""></label>
																</div>
                                <div class="form-group">
																	<label for="">Esemény hossza:</label>
                                  <label id="durE" class="font-weight-bold" for=""><strong></strong></label>
																</div>
															</div>
															<div class="modal-footer">
                                <input id="eventidE" type="hidden" name="id" value=''>
                                <button id="eventDeleteE" type="button" class="btn  btn-danger">TÖRLÉS</button>
																<button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
                                <button id="eventUpdateE" type="submit" class="btn btn-primary">Mentés</button>
															</div>
														</form>
												</div>
										</div>
									</div>
            </div>
        </div>
        <input id="coach" type="hidden" name="id" value='<?php echo $_SESSION["coach"] ?>'>
        <input id="coachidOpt" type="hidden" name="id" value='<?php echo $_SESSION['coachid'] ?>'>
        <script src="js/homeScripts.js"></script>
        <script src="js/calendar.js"></script>
    </body>
</html>
