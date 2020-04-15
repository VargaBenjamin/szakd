<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'framedb';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
};

if(isset($_POST["id"]))
{
  $comb = mysqli_real_escape_string($con, $_POST["comb"]);
  $derek = mysqli_real_escape_string($con, $_POST["derek"]);
  $csipo = mysqli_real_escape_string($con, $_POST["csipo"]);
  $mell = mysqli_real_escape_string($con, $_POST["mell"]);
  $vall = mysqli_real_escape_string($con, $_POST["vall"]);
  $kar = mysqli_real_escape_string($con, $_POST["kar"]);
  $futido = mysqli_real_escape_string($con, $_POST["futido"]);
  $futkm = mysqli_real_escape_string($con, $_POST["futkm"]);
  $huzmax = mysqli_real_escape_string($con, $_POST["huzmax"]);
  $nyommax = mysqli_real_escape_string($con, $_POST["nyommax"]);
  $gugmax = mysqli_real_escape_string($con, $_POST["gugmax"]);
  $huzsajat = mysqli_real_escape_string($con, $_POST["huzsajat"]);
  $nyomsajat = mysqli_real_escape_string($con, $_POST["nyomsajat"]);
  $gugsajat = mysqli_real_escape_string($con, $_POST["gugsajat"]);
  $id = mysqli_real_escape_string($con, $_POST["id"]);
 $query = "UPDATE workoutdata SET combboseg = '".$comb."', derekboseg = '".$derek."', csipoboseg = '".$csipo."', mellboseg = '".$mell."', vallszelesseg = '".$vall."'
 , karboseg = '".$kar."', adottido = '".$futido."', adottkm = '".$futkm."', felhuzasmax = '".$huzmax."', fekvenyomasmax = '".$nyommax."'
 , gugolasmax = '".$gugmax."', felhuzassajat = '".$huzsajat."', fekvenyomassajat = '".$nyomsajat."', gugolassajat = '".$gugsajat."' WHERE id = '".$id."'";
 if(mysqli_query($con, $query))
 {
  echo 'Data Updated';
 }
}else throw new \Exception("Error Processing Request", 1);

?>
