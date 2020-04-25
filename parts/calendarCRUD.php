<?php
//calendarCreate.php
session_start();
require 'db.php';

if (isset($_POST['create'])) {
  if(isset($_POST["title"], $_POST["start"], $_POST["end"], $_POST["color"], $_POST["coachid"], $_POST["clientid"], $_POST["customeventid"]))
  {
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $start = mysqli_real_escape_string($con, $_POST["start"]);
    $end = mysqli_real_escape_string($con, $_POST["end"]);
    $color = mysqli_real_escape_string($con, $_POST["color"]);
    $coachid = mysqli_real_escape_string($con, $_POST["coachid"]);
    $clientid = mysqli_real_escape_string($con, $_POST["clientid"]);
    $customeventid = mysqli_real_escape_string($con, $_POST["customeventid"]);
    if ($stmt = $con->prepare('INSERT INTO events (title, start_event, end_event, color, coachid, clientid, customeventid) VALUES (?, ?, ?, ?, ?, ?, ?)'))
    {
      $stmt->bind_param('ssssiii', $title, $start, $end, $color, $coachid, $clientid, $customeventid);
      $stmt->execute();
    }
  }
}

if (isset($_POST['update'])) {
  if(isset($_POST["id"], $_POST["start"], $_POST["end"]))
  {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $start = mysqli_real_escape_string($con, $_POST["start"]);
    $end = mysqli_real_escape_string($con, $_POST["end"]);
    if ($stmt = $con->prepare('UPDATE events SET start_event = ?, end_event = ? WHERE id = ?'))
    {
      $stmt->bind_param('ssi', $start, $end, $id);
      $stmt->execute();
      $stmt->close();
    }
  }
}

if (isset($_POST['getEventInfo'])) {
  if (isset($_POST['id']))
  {
    $eventData = array();
    $id = mysqli_real_escape_string($con, $_POST['id']);
    if ($stmt = $con->prepare('SELECT events.id AS eventid, events.customeventid, events.clientid, customevents.id, accounts.id, customevents.duration AS duration, accounts.username AS clientname,
                               accounts.email AS clientemail, events.title AS eventname, events.start_event AS starttime, events.end_event AS endtime, events.color AS color
                               FROM events
                               INNER JOIN customevents ON events.customeventid = customevents.id
                               INNER JOIN accounts ON events.clientid = accounts.id
                               WHERE  events.id = ?'))
      {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //echo $row['duration'];
        // $eventData[] = array(
        //   'eventname' => $row['eventname'],
        //   'clientname' => $row['clientname'],
        //   'clientemail' => $row['clientemail'],
        //   'starttime' => $row['starttime'],
        //   'endtime' => $row['endtime'],
        //   'duration' => $row['duration'],
        //   'color' => $row['color'],
        //   'eventid' => $row['eventid']
        // );
        $stmt->close();
        // echo json_encode($eventData);
        echo json_encode($row);

      }
  }
}

if (isset($_POST['setEventInfo'])) {
  if(isset($_POST["eventid"], $_POST["title"], $_POST["color"]))
  {
    $eventid = mysqli_real_escape_string($con, $_POST["eventid"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $color = mysqli_real_escape_string($con, $_POST["color"]);
    if ($stmt = $con->prepare('UPDATE events SET title = ?, color = ? WHERE id = ?'))
    {
      $stmt->bind_param('ssi', $title, $color, $eventid);
      $stmt->execute();
      $stmt->close();
    }
  }
}

if (isset($_POST['delete'])) {
  if(isset($_POST["eventid"]))
  {
    $eventid = mysqli_real_escape_string($con, $_POST["eventid"]);
    if ($stmt = $con->prepare('DELETE FROM events WHERE id = ?'))
    {
      $stmt->bind_param('i', $eventid);
      $stmt->execute();
    }
  }
}

if (isset($_POST['createCustom'])) {
  if(isset($_POST["title"], $_POST["duration"], $_POST["color"], $_POST["coachid"]))
  {
    echo $_POST["title"];
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $duration = mysqli_real_escape_string($con, $_POST["duration"]);
    $color = mysqli_real_escape_string($con, $_POST["color"]);
    $coachid = mysqli_real_escape_string($con, $_POST["coachid"]);
    if ($stmt = $con->prepare('INSERT INTO customevents(title, duration, color, coachid) VALUES (?, ?, ?, ?)'))
    {
      $stmt->bind_param('sssi', $title, $duration, $color, $coachid);
      $stmt->execute();
      $stmt->close();
    }
  }
}

if (isset($_POST['deleteCustom'])) {
  if(isset($_POST["customeventid"], $_POST["coachid"]))
  {
    $customeventid = mysqli_real_escape_string($con, $_POST["customeventid"]);
    $coachid = mysqli_real_escape_string($con, $_POST["coachid"]);
    if ($stmt = $con->prepare('DELETE FROM customevents WHERE id = ? AND coachid = ?'))
    {
      $stmt->bind_param('ii', $customeventid, $coachid);
      $stmt->execute();
    }
  }
}

if (isset($_POST['getCalOpt'])) {
  if (isset($_POST['coachid'])) {
    if ($stmt = $con->prepare('SELECT * FROM calendaroption WHERE coachid = ?'))
    {
      $stmt->bind_param('i', $_POST['coachid']);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        echo json_encode($row);
      }
    }
  }
}

if (isset($_POST['setCalOpt'])) {
  if (isset($_POST['coachid'],$_POST['basicView'],$_POST['dayStart'],$_POST['dayEnd'],$_POST['overlap'],$_POST['views'],$_POST['hiddendays'])) {
    $coachid = mysqli_real_escape_string($con, $_POST["coachid"]);
    $basicView = mysqli_real_escape_string($con, $_POST["basicView"]);
    $dayStart = mysqli_real_escape_string($con, $_POST["dayStart"]);
    $dayEnd = mysqli_real_escape_string($con, $_POST["dayEnd"]);
    $overlap = mysqli_real_escape_string($con, $_POST["overlap"]);
    $views = mysqli_real_escape_string($con, $_POST["views"]);
    $hiddendays = mysqli_real_escape_string($con, $_POST["hiddendays"]);
    if ($stmt = $con->prepare('UPDATE calendaroption SET basicview = ?, views = ?, hiddendays= ?, mintime = ?, maxtime = ?, overlap = ? WHERE coachid = ?')) {
      $stmt->bind_param('sssssii', $basicView, $views, $hiddendays, $dayStart, $dayEnd, $overlap, $coachid);
      $stmt->execute();
      $stmt->close();
    }
  }
}

$con->close();
?>
