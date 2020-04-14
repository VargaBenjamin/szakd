<?php
require 'parts/db.php';

$header = "<thead>\n<tr>\n";
$sql = "SHOW COLUMNS FROM comments";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
  $gh[] = $row['Field'];
    //echo $row['Field']."<br>";
}
print_r($gh);
echo $gh[3];
?>
