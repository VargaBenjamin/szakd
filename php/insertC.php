<?php

//insert.php
if(isset($_POST['SubmitExEvent'])){
  $connect = new PDO('mysql:host=localhost;dbname=ownfccustom', 'root', '');

  if(isset($_POST["title"]))
  {
   $query = "
   INSERT INTO events
   (title, duration, color)
   VALUES (:title, :duration, :color)
   ";
   $statement = $connect->prepare($query);
   $statement->execute(
    array(
     ':title'  => $_POST['title'],
     ':duration' => $_POST['duration'],
     ':color' => $_POST['color']
    )
   );
  }
  header("Location: index.php");//megelőzi, hogy minden frissítésnél újraküldje a form-ot így duplikálva folyamatosan a létrehozott eseményt
}

?>
