//calendar.js
$(document).ready(function() {
  var coachidOpt = $('#coachidOpt').val();
  var basicView="";
  var views="";
  var hiddendays="";
  var minTime="";
  var maxTime="";
  var overlap="";

  $.ajax({
    url: "parts/calendarCRUD.php",
    type: "POST",
    data: {
      getCalOpt: "true",
      coachid: coachidOpt
    },
    success: function(getData) {
      var array = JSON.parse(getData);
      basicView = array.basicview;
      views = array.views;
      hiddendays = array.hiddendays;
      minTime = array.mintime;
      maxTime = array.maxtime;
      if (array.overlap == 1) {
        overlap = 1;
      }else {
        overlap = 0;
      }
      getCalendar();
    }
  })




function getCalendar()
{
  var initialLocaleCode = 'hu';
  var localeSelectorEl = document.getElementById('locale-selector');

  var Calendar = FullCalendar.Calendar;
  var Draggable = FullCalendarInteraction.Draggable;

  var containerEl = document.getElementById('external-events');
  var calendarEl = document.getElementById('calendar');

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
    defaultView: basicView,
    timeZone: 'GMT+1', //'Europe/Budapest',
    nowIndicator: true,
    locale: initialLocaleCode,
    header: {
      left: 'prev,next today',
      center: 'title',
      right: views
    },
    hiddenDays: '[' + hiddendays + ']', //0 vasarnap, 1 hetfo...
    minTime: minTime,
    maxTime: maxTime,
    eventOverlap: overlap,
    navLinks: false,
    selectable: true, //atlatszoan mutatja a kijelolt intervallumot
    selectMirror: false, //a kijelolt intervallumra elhelyez egy esemenyt
    editable: true,
    droppable: true,

    events: 'parts/calendarInit.php', //FONTOS RÉSZ. Itt tölti be az eseményeket egy array segítségével. Itt lehet mahinálni, https://fullcalendar.io/docs/event-parsing alapján vannak tulajdonságok.

    //trigger when drop an external event into the calendar
    eventReceive: function(info) {
      if (confirm("Biztosan elhelyezed?")) {
        var start = info.event.start.toISOString();
        var end = info.event.end.toISOString();
        var title = info.event.title;
        var color = info.event.backgroundColor;
        var coachid = info.event.extendedProps.coachid;
        var clientid = info.event.extendedProps.clientid;
        var customeventid = info.event.extendedProps.customeventid;
        $.ajax({
          url: "parts/calendarCRUD.php",
          type: "POST",
          data: {
            creat: "true",
            title: title,
            start: start,
            end: end,
            color: color,
            coachid: coachid,
            clientid: clientid,
            customeventid: customeventid
          },
          success: function(data) {
            $('#alert').html('<div class="alert alert-success alert-dismissible col-md-12 col-md-pull-12" style="position: fixed;z-index:+101;" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeresen elhelyezve!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
          }
        });
      }
      location.reload(); //bug elkerülése végett, frissít az oldalon külsős esemény elhelyezése/nem elhelyezése után
      //mert utána lévő interakciónál dupláz
    },


    eventResize: function(info) {
      var start = info.event.start.toISOString();
      var end = info.event.end.toISOString();
      var id = info.event.id;
      if (!confirm("Átméretezed az eseményt?")) {
        info.revert();
      } else {
        $.ajax({
          url: "parts/calendarCRUD.php",
          type: "POST",
          data: {
            update: "true",
            id: id,
            start: start,
            end: end
          },
          success: function(data) {
            calendar.refetchEvents();
            $('#alert').html('<div class="alert alert-success alert-dismissible col-md-12 col-md-pull-12" style="position: fixed;z-index:+101;" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Esemény átméretezve!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
          }
        })
      }
    },


    eventDrop: function(info) {
      var start = info.event.start.toISOString();
      var end = info.event.end.toISOString();
      var id = info.event.id;
      if (!confirm("Elhelyezed itt?")) {
        info.revert();
      } else {
        $.ajax({
          url: "parts/calendarCRUD.php",
          type: "POST",
          data: {
            update: "true",
            start: start,
            end: end,
            id: id
          },
          success: function() {
            calendar.refetchEvents();
            $('#alert').html('<div class="alert alert-success alert-dismissible col-md-12 col-md-pull-12" style="position: fixed;z-index:+101;" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Esemény frissítve!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
          }
        });
      }
    },
    //in this case an event erase
    eventClick: function(info) {
      $.ajax({
        url: "parts/calendarCRUD.php",
        type: "POST",
        data: {
          getEventInfo: "true",
          id: info.event.id
        },
        success: function(eventdata) {
          var array = JSON.parse(eventdata);
          $('#titleE').val(array.eventname);
          $('#colorE').val(array.color);
          $('#nameE').html(array.clientname);
          $('#emailE').html(array.clientemail);
          $('#startE').html(array.starttime);
          $('#endE').html(array.endtime);
          $('#durE').html(array.duration);
          $('#eventidE').val(array.eventid);
          $('#updateEventModal').modal();
        }
      });

      $("#updateEventModal").submit(function(e) {
        e.preventDefault();
        var title = $('#titleE').val();
        var color = $('#colorE').val();
        var eventid = $('#eventidE').val();
        $.ajax({
          url: "parts/calendarCRUD.php",
          type: "POST",
          data: {
            setEventInfo: "true",
            title: title,
            color: color,
            eventid: eventid
          },
          success: function(data) {
            //location.reload();  //különben annyiszor kérdez rá a törlésre ahány változtatás volt egy refetch alatt
            calendar.refetchEvents();
            $('#updateEventModal').modal('hide');
            $('#alert').html('<div class="alert alert-success alert-dismissible col-md-12 col-md-pull-12" style="position: fixed;z-index:+101;" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeres frissítés!</strong></div>');
            setTimeout(function() {
              $('.alert').fadeOut('slow');
            }, 1500);
          }
        })
      });

      $(document).on('click', '#eventDeleteE', function() {
        if (confirm("Biztosan törölni akarod az eseményt?")) {
          var eventid = $('#eventidE').val();
          $.ajax({
            url: "parts/calendarCRUD.php",
            type: "POST",
            data: {
              delete: "true",
              eventid: eventid
            },
            success: function(data) {
              calendar.refetchEvents();
              $('#updateEventModal').modal('hide');
              $('#alert').html('<div class="alert alert-success alert-dismissible col-md-12 col-md-pull-12" style="position: fixed;z-index:+101;" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sikeres törlés!</strong></div>');
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
  if (coach == 0) {
    $('#customEventAdd').css({
      "display": "none"
    });
    $('#creatCustomModal').css({
      "display": "none"
    });
    $('#customEventDelete').css({
      "display": "none"
    });
    $('#deleteCustomModal').css({
      "display": "none"
    });
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
      url: "parts/calendarCRUD.php",
      type: "POST",
      data: {
        creatCustom: "true",
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
      url: "parts/calendarCRUD.php",
      type: "POST",
      data: {
        deleteCustom: "true",
        customeventid: customeventid,
        coachid: coachid
      },
      success: function(data) {
        location.reload();
      }
    })
  });
}

});
