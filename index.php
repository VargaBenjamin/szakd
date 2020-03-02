<?php include 'php/insertC.php';?>

<html lang='en'>

<head>
  <meta charset='utf-8' />

  <link href='mainstyle.css' rel='stylesheet' />
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!--bootstrap kotelezo elemek-->
  <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


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
          var paraArray = dur.split('#');
          console.log(eventEl);
          return {
            title: eventEl.innerText,
            id: paraArray[0],
            duration: paraArray[1]
          };
        }
      });

      var calendar = new Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'bootstrap'],
        themeSystem: 'bootstrap',
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

              /*var title = prompt("Esemény neve");
              if (title) {
                var duration = prompt("Esemény hossza (ÓÓ:PP)");
                if (duration) {
                  console.log(title);
                  console.log(duration);
                  //var duration = info.duration;
                  $.ajax({
                    url: "php//insertC.php",
                    type: "POST",
                    data: {
                      title: title,
                      duration: duration
                    },
                    success: function() {
                      location.reload();
                    }
                  })
                }
              }*/
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
        events: 'php//load.php',

        eventResize: function(info) {
          console.log(info);
          var start = info.event.start.toISOString();
          var end = info.event.end.toISOString();
          var title = info.event.title;
          var id = info.event.id;
          if (!confirm("Átméretezed az eseményt?")) {
            info.revert();
          } else {
            $.ajax({
              url: "php//update.php",
              type: "POST",
              data: {
                title: title,
                start: start,
                end: end,
                id: id
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
          if (!confirm("Elhelyezed itt?")) {
            info.revert();
          } else {
            $.ajax({
              url: "php//update.php",
              type: "POST",
              data: {
                title: title,
                start: start,
                end: end,
                id: id
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

            $.ajax({
              url: "php//insert.php",
              type: "POST",
              data: {
                title: title,
                start: start,
                end: end
              },
              success: function() {
                alert("Sikeresen elhelyezve!");
                location.reload(); //bug elkerülése végett, frissít az oldalon külsős esemény elhelyezése után,
                //mert utána lévő interakciónál dupláz stbstb
              }
            });
          }
        },

        //in this case an event erase
        eventClick: function(info) {
          console.log(info);
          if (confirm("Biztosan törölni akarod az eseményt?")) {
            var id = info.event.id;
            $.ajax({
              url: "php//delete.php",
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

        /*drop: function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        },*/

        /*select: function(info) {
          console.log(info);
          var title = prompt("Enter Event Title");
          if (title) {
            var start = info.startStr;
            var end = info.endStr;
            $.ajax({
              url: "php//insert.php",
              type: "POST",
              data: {
                title: title,
                start: start,
                end: end
              },
              success: function() {
                calendar.refetchEvents();
                alert("Added Successfully");
              }
            })
          }
        },*/
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

  <script>
    function AddExEvent(title,duration) {
      $.ajax({
        url: "php//insertC.php",
        type: "POST",
        data: {
          title: title,
          duration: duration
        },
        success: function() {
          location.reload();
        }
      })
    };
  </script>

</head>

<body>
  <div id='external-events'>
    <p>
      <strong>Választható események</strong>
    </p>
    <?php include 'php/loadExt.php';?>
    <!--<p>
      <input type='checkbox' id='drop-remove' />
      <label for='drop-remove'>remove after drop</label>
    </p>-->
  </div>

  <div id='calendar-container'>
    <div id='calendar'></div>
    <!-- Button trigger modal -->
  </div>

  <div id='bottom'>
    Locales:
    <select id='locale-selector'></select>
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
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Bezárás</button>
                  <button type="submit" name="SubmitExEvent" class="btn btn-primary">Létrehozás</button>
              </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
