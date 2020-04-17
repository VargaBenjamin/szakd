<?php
//coachLoad.php
require 'db.php';

if (isset($_POST['gymid'])) {
  $output = '<option value="">Válassz!</option>';
  if ($stmt = $con->prepare('SELECT * FROM accounts WHERE coach = 1 AND gymid = "' . $_POST['gymid'] . '"'))
  {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $output.= '<option value="' . $row['id'] . '">' . $row['username'] . '</option>';
    }
  }
  echo $output;
}
else {
echo "Nem sikeres az átvitel";
}
?>
