<?php
require 'db.php';
if(isset($_POST["id"]))
{
 $query = "DELETE FROM comments WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($con, $query))
 {
  echo 'Data Deleted';
 }
}
?>
