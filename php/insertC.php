<?php

//insert.php
if(isset($_POST['SubmitExEvent'])){
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
  header("Location: index.php");//megelőzi, hogy minden frissítésnél újraküldje a form-ot így duplikálva folyamatosan a létrehozott eseményt
}

?>
