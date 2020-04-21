<?php
//calendarDeleteCustom.php
require 'db.php';

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

?>
