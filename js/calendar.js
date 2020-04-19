//calendar.js
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


  var draggable = new Draggable(containerEl, {
    itemSelector: '.fc-event',
    eventData: function(eventEl) {
      var dur = eventEl.dataset.event.replace(/[{}""]/g, "").toString();
      var paraArray = dur.split('ß');
      return {
        title: eventEl.innerText,
        customeventid: paraArray[0],
        duration: paraArray[1],
        color: paraArray[2],
        coachid: paraArray[3],
        clientid: paraArray[4]
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
    // customButtons: {
    //   addEvent: {
    //     text: 'Esemény hozzáadása',
    //     click: function() {
    //       $('#creatCustomModal').modal(); //ezért ugrik fel az ablak ahogy kell bootstrapben
    //     }
    //   },
    //   deleteEvent: {
    //     text: 'Esemény törlése',
    //     click: function() {
    //       $('#deleteCustomModal').modal();
    //     }
    //   }
    // },

    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
    },
    // footer: {
    //   left: 'addEvent',
    //   center: '',
    //   right: 'deleteEvent'
    // },

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
    minTime: "07:00",
    maxTime: "22:00",
    navLinks: false,
    selectable: false, //atlatszoan mutatja a kijelolt intervallumot
    selectMirror: false, //a kijelolt intervallumra elhelyez egy esemenyt
    editable: true,
    droppable: true,
    events: 'parts/calendarRead.php', //FONTOS RÉSZ. Itt tölti be az eseményeket egy array segítségével. Itt lehet mahinálni, https://fullcalendar.io/docs/event-parsing alapján vannak tulajdonságok.

    //trigger when drop an external event into the calendar
    eventReceive: function(info) {
      console.log(info);
      if (confirm("Biztosan elhelyezed?")) {
        var start = info.event.start.toISOString();
        var end = info.event.end.toISOString();
        var title = info.event.title;
        var color = info.event.backgroundColor;
        var coachid = info.event.extendedProps.coachid;
        var clientid = info.event.extendedProps.clientid;
        var customeventid = info.event.extendedProps.customeventid;
        $.ajax({
          url: "parts/calendarCreat.php",
          type: "POST",
          data: {
            title: title,
            start: start,
            end: end,
            color: color,
            coachid: coachid,
            clientid: clientid,
            customeventid: customeventid
          },
          success: function(data) {
            $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeresen elhelyezve!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
            //alert("Sikeresen elhelyezve!");
          }
        });
      }
      location.reload(); //bug elkerülése végett, frissít az oldalon külsős esemény elhelyezése/nem elhelyezése után
      //mert utána lévő interakciónál dupláz
    },


    eventResize: function(info) {
      console.log(info);
      var start = info.event.start.toISOString();
      var end = info.event.end.toISOString();
      var id = info.event.id;
      if (!confirm("Átméretezed az eseményt?")) {
        info.revert();
      } else {
        $.ajax({
          url: "parts/calendarUpdateTime.php",
          type: "POST",
          data: {
            id: id,
            start: start,
            end: end
          },
          success: function(data) {
            calendar.refetchEvents();
            $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Esemény átméretezve!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
            //alert("Esemény átméretezve!");
          }
        })
      }
    },


    eventDrop: function(info) {
      console.log(info);
      var start = info.event.start.toISOString();
      var end = info.event.end.toISOString();
      var id = info.event.id;
      if (!confirm("Elhelyezed itt?")) {
        info.revert();
      } else {
        $.ajax({
          url: "parts/calendarUpdateTime.php",
          type: "POST",
          data: {
            start: start,
            end: end,
            id: id
          },
          success: function() {
            calendar.refetchEvents();
            $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Esemény frissítve!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
            //alert("Esemény frissítve!");
          }
        });
      }
    },


    //in this case an event erase
    eventClick: function(info) {
      $.ajax({
        url: "parts/getEventInfo.php",
        type: "POST",
        data: {
          id: info.event.id
        },
        success: function(data) {
          var array = JSON.parse(data);
          $('#titleE').val(array[0].eventname);
          $('#colorE').val(array[0].color);
          $('#nameE').html(array[0].clientname);
          $('#emailE').html(array[0].clientemail);
          $('#startE').html(array[0].starttime);
          $('#endE').html(array[0].endtime);
          $('#durE').html(array[0].duration);
          $('#eventidE').val(array[0].eventid);
          $('#updateEventModal').modal();
        },
      });

      $("#updateEventModal").submit(function(e) {
        e.preventDefault();
        var title = $('#titleE').val();
        var color = $('#colorE').val();
        var eventid = $('#eventidE').val();
        $.ajax({
          url: "parts/calendarUpdateModal.php",
          type: "POST",
          data: {
            title: title,
            color: color,
            eventid: eventid
          },
          success: function(data) {
            //location.reload();  //különben annyiszor kérdez rá a törlésre ahány változtatás volt egy refetch alatt
            calendar.refetchEvents();
            $('#updateEventModal').modal('hide');
            $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeres frissítés!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
          }
        })
      });

      $(document).on('click', '#eventDeleteE', function(){
        if (confirm("Biztosan törölni akarod az eseményt?")) {
          var eventid = $('#eventidE').val();
          $.ajax({
            url: "parts/calendarDelete.php",
            type: "POST",
            data: {
              eventid: eventid
            },
            success: function(data) {
              calendar.refetchEvents();
              $('#updateEventModal').modal('hide');
              $('#alert').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeres törlés!</strong></div>');
              setTimeout(function() {
                $('.alert').fadeOut('slow');
              }, 1500);
            }
          })
        }
      });
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

  var coach = $('#coach').val();
  if (coach == 0)
  {
    $('#customEventAdd').css({"display": "none"});
    $('#creatCustomModal').css({"display": "none"});
    $('#customEventDelete').css({"display": "none"});
    $('#deleteCustomModal').css({"display": "none"});
  }

  $('#customEventAdd').click(function() {
    $('#creatCustomModal').modal();
  });

  $("#creatCustomModal").submit(function(e) {
    e.preventDefault();
    var title = $('#titleC').val();
    var duration = $('#durationC').val();
    var color = $('#colorC').val();
    var coachid = $('#coachidC').val();
    $.ajax({
      url: "parts/calendarCreatCustom.php",
      type: "POST",
      data: {
        title: title,
        duration: duration,
        color: color,
        coachid: coachid
      },
      success: function(data) {
        location.reload();
      }
    })
  });

  $('#customEventDelete').click(function() {
    $('#deleteCustomModal').modal();
  });

  $("#deleteCustomModal").submit(function(e) {
    e.preventDefault();
    var customeventid = $('#titleD').val();
    var coachid = $('#coachidD').val();
    $.ajax({
      url: "parts/calendarDeleteCustom.php",
      type: "POST",
      data: {
        customeventid: customeventid,
        coachid: coachid
      },
      success: function(data) {
        location.reload();
      }
    })
  });

});
