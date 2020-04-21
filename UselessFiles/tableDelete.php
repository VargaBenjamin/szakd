<?php
//tableDelete.php
require 'db.php';

if(isset($_POST["id"]))
{
  $id = mysqli_real_escape_string($con, $_POST["id"]);
  if ($stmt = $con->prepare('DELETE FROM workoutdata WHERE id = ?'))
  {
    $stmt->bind_param('i', $id);
    $stmt->execute();
  }
}
?>
