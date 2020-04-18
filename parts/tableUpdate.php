<?php
//tableUpdate.php
require 'db.php';

if(isset($_POST["id"]))
{
  $suly = mysqli_real_escape_string($con, $_POST["suly"]);
  $zsir = mysqli_real_escape_string($con, $_POST["zsir"]);
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
   if ($stmt = $con->prepare('UPDATE workoutdata SET suly = ?, testzsirszazalek = ?, combboseg = ?, derekboseg = ?, csipoboseg = ?,
     mellboseg = ?, vallszelesseg = ?, karboseg = ?, adottido = ?, adottkm = ?, felhuzasmax = ?, fekvenyomasmax = ?,
    gugolasmax = ?, felhuzassajat = ?, fekvenyomassajat = ?, gugolassajat = ? WHERE id = ?'))
    {
      $stmt->bind_param('iiiiiiiiiiiiiiiii', $suly, $zsir, $comb, $derek, $csipo, $mell, $vall, $kar, $futido, $futkm,
      $huzmax, $nyommax, $gugmax, $huzsajat, $nyomsajat, $gugsajat, $id);
      $stmt->execute();
    }
}
else
 throw new \Exception("Error Processing Request", 1);
?>
