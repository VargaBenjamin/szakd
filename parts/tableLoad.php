<?php
require 'db.php';

$header = '<thead><tr>';
echo $header;
if ($stmt = $con->prepare('SELECT * FROM comments LIMIT 1'))
{
  $stmt->execute();
  $result = $stmt->get_result();
  $result->fetch_assoc();
  while ($columnName = $result->fetch_field()) {
    echo '<th>' . $columnName->name . '</th>';
  }
}
$middle = '</tr>
</thead>
<tbody>';
echo $middle;
if ($stmt = $con->prepare('SELECT * FROM comments'))
{
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    echo '<tr><td>';
    echo implode("</td><td>",$row);
    echo '</td></tr>';
  }
}
$footer = '</tbody>';
echo $footer;
if ($stmt) {
	$stmt->close();
}
$con->close();
?>
