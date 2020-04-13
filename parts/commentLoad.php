<?php
require 'db.php';

if ($stmt = $con->prepare('SELECT * FROM comments WHERE reply = "0" AND article = "' . $_GET['title'] . '" ORDER BY id DESC')) {
  $stmt->execute();
  $result = $stmt->get_result();
  $output = '';
  while ($row = $result->fetch_assoc()) {
    $output.=
    '<div class="media mb-4">
      <!--<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">-->
      <div class="media-body">
        <h5 class="mt-0">' . $row['author'] . '</h5>
        ' . $row['maintext'] . '
        <div class="media-footer" align="right"><button type="button" class="btn btn-default reply" name="' . $row['id'] . '" id="' . $row['id'] . '">Válasz</button></div>';
    $output .= getReply($con, $row["id"]);
    $output .=
      '</div>
    </div>';
  }
}
echo $output;
function getReply($con, $reply = 0, $marginleft = 0)
{
  if ($stmt = $con->prepare('SELECT * FROM comments WHERE reply = "' . $reply . '" AND article = "' . $_GET['title'] . '" ORDER BY id DESC')) {
     $stmt->execute();
     $result = $stmt->get_result();
     $output = '';
     if($reply == 0)
     {
      $marginleft = 0;
     }
     else
     {
      $marginleft = $marginleft + 36;
     }
       while ($row = $result->fetch_assoc()) {
         $output .=
         '<div class="media mt-4" style="margin-left:' . $marginleft . 'px">
              <!--<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">-->
              <div class="media-body">
                <h5 class="mt-0">' . $row['author'] . '</h5>
                ' . $row['maintext'] . '
                <div class="media-footer" align="right"><button type="button" class="btn btn-default reply" name="' . $row['id'] . '" id="' . $row['id'] . '">Válasz</button></div>';
         $output .= getReply($con, $row["id"], $marginleft);
         $output .=
           '</div>
         </div>';
       }
   }
   return $output;
 }
 if ($stmt) {
 	$stmt->close();
 }
 $con->close();
?>
