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
          $('#fullCalModal').modal(); //ezért ugrik fel az ablak ahogy kell bootstrapben
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
