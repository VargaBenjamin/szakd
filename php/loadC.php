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
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'duration'   => $row["duration"]
 );
}

echo json_encode($data);

?>
