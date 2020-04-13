<?php
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
        <link href="homeStyle.css" type="text/css" rel="stylesheet" />
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

				<script>
					document.addEventListener('DOMContentLoaded', function() {
						var initialLocaleCode = 'hu';
						var localeSelectorEl = document.getElementById('locale-selector');

						var Calendar = FullCalendar.Calendar;
						var Draggable = FullCalendarInteraction.Draggable;

						var containerEl = document.getElementById('external-events');
						var calendarEl = document.getElementById('calendar');
						var checkbox = document.getElementById('drop-remove');

						// initialize the external events
						// -----------------------------------------------------------------

						new Draggable(containerEl, {
							itemSelector: '.fc-event',
							eventData: function(eventEl) {
								var dur = eventEl.dataset.event.replace(/[{}""]/g, "").toString();
								var paraArray = dur.split('ß');
								console.log(eventEl);
								return {
									title: eventEl.innerText,
									id: paraArray[0],
									duration: paraArray[1],
									color: paraArray[2]
								};
							}
						});

						var calendar = new Calendar(calendarEl, {
							plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'bootstrap'],
							themeSystem: 'bootstrap4',
							defaultView: 'timeGridWeek',
							timeZone: 'GMT+1', //'Europe/Budapest',
							nowIndicator: true,
							locale: initialLocaleCode,

							//custom button for add event
							customButtons: {
								addEvent: {
									text: 'Esemény hozzáadása',
									click: function() {
									$('#fullCalModal').modal();//ezért ugrik fel az ablak ahogy kell bootstrapben
									}
								}
							},

							header: {
								left: 'prev,next today',
								center: 'title',
								right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
							},
							footer: {
								left: 'addEvent',
								center: '',
								right: ''
							},

							businessHours: [ // specify an array instead
								{
									daysOfWeek: [1, 2, 3, 4, 5], // Monday, Tuesday, Wednesday
									startTime: '07:00', // 8am
									endTime: '21:00' // 6pm
								},
								{
									daysOfWeek: [6], // Saturday
									startTime: '10:00', // 10am
									endTime: '16:00' // 4pm
								}
							],
							hiddenDays: [0], //0 vasarnap, 1 hetfo...

							navLinks: true,
							selectable: true, //atlatszoan mutatja a kijelolt intervallumot
							selectMirror: true, //a kijelolt intervallumra elhelyez egy esemenyt
							editable: true,
							droppable: true,
							events: 'parts/calendarLoad.php',

							eventResize: function(info) {
								console.log(info);
								var start = info.event.start.toISOString();
								var end = info.event.end.toISOString();
								var title = info.event.title;
								var id = info.event.id;
								var color = info.event.backgroundColor;
								if (!confirm("Átméretezed az eseményt?")) {
									info.revert();
								} else {
									$.ajax({
										url: "parts/calendarUpdate.php",
										type: "POST",
										data: {
											title: title,
											start: start,
											end: end,
											id: id,
											color: color
										},
										success: function() {
											calendar.refetchEvents();
											alert("Esemény átméretezve!");
										}
									})
								}
							},

							eventDrop: function(info) {
								console.log(info);
								var start = info.event.start.toISOString();
								var end = info.event.end.toISOString();
								var title = info.event.title;
								var id = info.event.id;
								var color = info.event.backgroundColor;
								if (!confirm("Elhelyezed itt?")) {
									info.revert();
								} else {
									$.ajax({
										url: "parts/calendarUpdate.php",
										type: "POST",
										data: {
											title: title,
											start: start,
											end: end,
											id: id,
											color: color
										},
										success: function() {
											calendar.refetchEvents();
											alert("Esemény frissítve!");
										}
									});
								}
							},

							//trigger when drop an external event into the calendar
							eventReceive: function(info) {
								console.log(info);
								if (confirm("Biztosan elhelyezed?")) {
									var start = info.event.start.toISOString();
									var end = info.event.end.toISOString();
									var title = info.event.title;
									var color = info.event.backgroundColor;
									$.ajax({
										url: "parts/calendarInsert.php",
										type: "POST",
										data: {
											title: title,
											start: start,
											end: end,
											color: color
										},
										success: function() {
											alert("Sikeresen elhelyezve!");
										}
									});
								}
								location.reload(); //bug elkerülése végett, frissít az oldalon külsős esemény elhelyezése/nem elhelyezése után
																	 //mert utána lévő interakciónál dupláz
							},

							//in this case an event erase
							eventClick: function(info) {
								console.log(info);
								if (confirm("Biztosan törölni akarod az eseményt?")) {
									var id = info.event.id;
									$.ajax({
										url: "parts/calendarDelete.php",
										type: "POST",
										data: {
											id: id
										},
										success: function() {
											calendar.refetchEvents();
											alert("Esemény törölve!");
										}
									});
								}
							}
						});
						calendar.render();

						// build the locale selector's options
						calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
							var optionEl = document.createElement('option');
							optionEl.value = localeCode;
							optionEl.selected = localeCode == initialLocaleCode;
							optionEl.innerText = localeCode;
							localeSelectorEl.appendChild(optionEl);
						});
						// when the selected option changes, dynamically change the calendar option
						localeSelectorEl.addEventListener('change', function() {
							if (this.value) {
								calendar.setOption('locale', this.value);
							}
						});

					});
				</script>
				<!--külsős esemény hozzáadás-->
				<script>
					function AddExEvent(title, duration, color) {
						$.ajax({
							url: "parts/calendarInsertCustom.php",
							type: "POST",
							data: {
								title: title,
								duration: duration,
								color: color
							}
						})
					};
				</script>
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
                    </div>
                </main>
								<div class="row">
									<div class="card col-sm-2">
										<div id='external-events'>
											 <div class="card-header">
												 <p><strong>Választható események</strong></p>
											</div>
											<div class="card-body" style="overflow: auto;">
												<?php include 'parts/calendarLoadExternal.php';?>
											</div>
										</div>
									</div>

									<div class="col-sm-10">
										<div id='calendar-container' >
											<div id='calendar'></div>
										</div>
									</div>

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
								<div id='bottom'>
									Locales:<select id='locale-selector'></select>
								</div>
								<?php require 'parts/footer.php'; ?>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/homeScripts.js"></script>

    </body>
</html>
