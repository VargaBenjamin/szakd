$(document).ready(function() {
  var coachidOpt = $('#coachidOpt').val();
  var coach = $('#coach').val();
  var calendarEl = document.getElementById('calendar');
  var Calendar = FullCalendar.Calendar;
  if (coach == 1) { //edző
    var calendar = new Calendar(calendarEl, {
      plugins: ['list'],
      defaultView: 'list',
      timeZone: 'GMT+1', //'Europe/Budapest',
      locale: 'hu',
      events: 'parts/calendarInit.php'
    });
  }
  else {  //vendég
    var calendar = new Calendar(calendarEl, {
      plugins: ['list'],
      defaultView: 'list',
      timeZone: 'GMT+1', //'Europe/Budapest',
      locale: 'hu',
      events: 'parts/calendarInitClient.php'
    });
  }

  calendar.render();
})
