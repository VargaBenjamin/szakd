<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=ownfccustom', 'root', '');

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO events
 (title, duration)
 VALUES (:title, :duration)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':duration' => $_POST['duration']
  )
 );
}


?>
