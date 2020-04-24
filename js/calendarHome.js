$(document).ready(function() {
  var coachidOpt = $('#coachidOpt').val();
  var calendarEl = document.getElementById('calendar');
  var Calendar = FullCalendar.Calendar;
  var calendar = new Calendar(calendarEl, {
    plugins: ['list'],
    defaultView: 'list',
    timeZone: 'GMT+1', //'Europe/Budapest',
    locale: 'hu',
    events: 'parts/calendarInit.php'
  });
  calendar.render();
})
