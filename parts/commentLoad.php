<?php
require 'db.php';

if ($stmt = $con->prepare('SELECT comments.authorid, accounts.id, comments.articleid, articles.id, comments.reply, articles.title, comments.id AS commentid, accounts.username, comments.commenttext
  FROM comments, accounts, articles WHERE comments.authorid = accounts.id AND comments.articleid = articles.id AND comments.reply = "0" AND articles.title = "' . $_GET['title'] . '" ORDER BY comments.id DESC')) {
  $stmt->execute();
  $result = $stmt->get_result();
  $output = '';
  while ($row = $result->fetch_assoc()) {
    $output.=
    '<div class="media mb-4">
      <!--<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">-->
      <div class="media-body">
        <h5 class="mt-0">' . $row['username'] . '</h5>
        ' . $row['commenttext'] . '
        <div class="media-footer" align="right"><button type="button" class="btn btn-default reply" name="' . $row['commentid'] . '" id="' . $row['commentid'] . '">Válasz</button></div>';
    $output .= getReply($con, $row['commentid']);
    $output .=
      '</div>
    </div>';
  }
}
else {
  echo "Üzenet betöltési hiba!";
}
echo $output;
function getReply($con, $reply = 0, $marginleft = 0)
{
  if ($stmt = $con->prepare('SELECT comments.authorid, accounts.id, comments.articleid, articles.id, comments.reply, articles.title, comments.id AS commentid, accounts.username, comments.commenttext
    FROM comments, accounts, articles WHERE comments.authorid = accounts.id AND comments.articleid = articles.id AND comments.reply = "' . $reply . '" AND articles.title = "' . $_GET['title'] . '" ORDER BY comments.id DESC')) {
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
                <h5 class="mt-0">' . $row['username'] . '</h5>
                ' . $row['commenttext'] . '
                <div class="media-footer" align="right"><button type="button" class="btn btn-default reply" name="' . $row['commentid'] . '" id="' . $row['commentid'] . '">Válasz</button></div>';
         $output .= getReply($con, $row['commentid'], $marginleft);
         $output .=
           '</div>
         </div>';
       }
   }
   else {
     echo "Válasz üzenetek betöltési hiba!";
   }
   return $output;
 }
 if ($stmt) {
 	$stmt->close();
 }
 $con->close();
?>
