<?php
//tableCreat.php
session_start();
require 'db.php';

if (isset($_POST['creat'])) {
  if(isset($_POST["suly"], $_POST["zsir"], $_POST["comb"], $_POST["derek"], $_POST["csipo"], $_POST["mell"], $_POST["vall"], $_POST["kar"], $_POST["futido"], $_POST["futkm"], $_POST["huzmax"],
    $_POST["nyommax"], $_POST["gugmax"], $_POST["huzsajat"], $_POST["nyomsajat"], $_POST["gugsajat"], $_POST["clientid"]))
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
    $clientid = mysqli_real_escape_string($con, $_POST["clientid"]);
    if ($stmt = $con->prepare('INSERT INTO workoutdata(suly, testzsirszazalek, combboseg, derekboseg, csipoboseg, mellboseg, vallszelesseg,
      karboseg, adottido, adottkm, felhuzasmax, fekvenyomasmax, gugolasmax, felhuzassajat, fekvenyomassajat, gugolassajat, clientID)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'))
    {
      $stmt->bind_param('iiiiiiiiiiiiiiiii', $suly, $zsir, $comb, $derek, $csipo, $mell, $vall, $kar, $futido, $futkm,
      $huzmax, $nyommax, $gugmax, $huzsajat, $nyomsajat, $gugsajat, $clientid);
      $stmt->execute();
    }
  }
}

if (isset($_POST['delete'])) {
  if(isset($_POST["id"]))
  {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    if ($stmt = $con->prepare('DELETE FROM workoutdata WHERE id = ?'))
    {
      $stmt->bind_param('i', $id);
      $stmt->execute();
    }
  }
}

if (isset($_POST['update'])) {
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
}
?>
