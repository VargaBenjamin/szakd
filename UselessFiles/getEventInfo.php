<?php
//getEventInfo.php
require 'db.php';

if (isset($_POST['id']))
{
  $data = array();
  $id = mysqli_real_escape_string($con, $_POST['id']);
  if ($stmt = $con->prepare('SELECT events.id AS eventid, events.customeventid, events.clientid, customevents.id, accounts.id,
    customevents.duration AS duration, accounts.username AS clientname, accounts.email AS clientemail, events.title AS eventname, events.start_event AS starttime, events.end_event AS endtime, events.color AS color
    FROM events, customevents, accounts WHERE events.customeventid = customevents.id AND events.clientid = accounts.id AND events.id = ?'))
    {
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      //echo $row['duration'];
      $data[] = array(
        'eventname' => $row['eventname'],
        'clientname' => $row['clientname'],
        'clientemail' => $row['clientemail'],
        'starttime' => $row['starttime'],
        'endtime' => $row['endtime'],
        'duration' => $row['duration'],
        'color' => $row['color'],
        'eventid' => $row['eventid']
      );
      $stmt->close();
    }
    echo json_encode($data);
}
$con->close();
?>
