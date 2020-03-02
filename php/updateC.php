<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=ownfccustom', 'root', '');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE events
 SET title=:title, duration=:duration, color=:color
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':duration' => $_POST['duration'],
   ':id'   => $_POST['id'],
   ':color'   => $_POST['color']
  )
 );
}

?>
