<?php
//calendar.php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php?error=out");
    exit();
}
include 'parts/calendarInsertCustom.php';
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

				<!--bootstrap kotelezo elemek-->
				<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
				<!--<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />-->
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
                        <span id="alert"></span>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-header">Választható események</div>
                              <div class="card-body" id='external-events' style="overflow: auto;">
                                <div class="card-text" ><?php include 'parts/calendarLoadExternal.php';?></div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-9">
                            <div class="card">
                              <div class="card-header">Élő naptár</div>
                              <div class="card-body" id='calendar-container'>
                                <p class="card-text" id='calendar'></p>
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
									<div id="fullCalModal" class="modal fade">
										<div class="modal-dialog">
												<div class="modal-content">
													<form class="form-addExEv" action="" method="post">
															<div class="modal-header">
																	<h4 id="modalTitle" class="modal-title">Esemény létrehozása</h4>
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
															</div>
															<div id="modalBody" class="modal-body">
																<div class="form-group">
																	<label for="">Esemény neve</label>
																	<input type="text" name="title" placeholder="Két órás edzés">
																</div>
																<div class="form-group">
																	<label for="">Esemény időtartama</label>
																	<input type="text" name="duration" placeholder="02:00">
																</div>
																<div class="form-group">
																	<label for="">Esemény színének kiválasztása</label>
																	<input type="color" name="color" value="#3788D8">
																</div>
															</div>
															<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
																	<button type="submit" name="SubmitExEvent" class="btn btn-primary">Létrehozás</button>
															</div>
														</form>
												</div>
										</div>
									</div>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="js/homeScripts.js"></script>
        <script src="js/calendar.js"></script>
    </body>
</html>
