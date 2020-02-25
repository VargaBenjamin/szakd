<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=ownfccustom', 'root', '');

$data = array();

$query = "SELECT * FROM events ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
  echo "<div class='fc-event' data-event='{".$row["id"]."#".$row["duration"]."}'>".$row["title"]."</div>";
}

?>
