<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=framedb', 'root', '');

$data = array();

$query = "SELECT * FROM customevents ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
  echo "<div class='card-body fc-event' style='border-color: ".$row["color"]."; background-color: ".$row["color"].";' data-event='{".$row["id"]."ß".$row["duration"]."ß".$row["color"]."}'>".$row["title"]."</div>";
}

?>
