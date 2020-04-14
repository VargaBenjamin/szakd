<?php
require 'parts/db.php';

$header = "<thead>\n<tr>\n";
echo $header;
if ($stmt = $con->prepare('SELECT * FROM comments LIMIT 1'))
{
  $stmt->execute();
  $result = $stmt->get_result();
  $result->fetch_assoc();
  while ($columnName = $result->fetch_field()) {
    echo "<th>" . $columnName->name . "</th>\n";
  }
}
$middle = "</tr>
</thead>
<tbody>";
echo $middle;
if ($stmt = $con->prepare('SELECT * FROM comments'))
{
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    echo "\n<tr>\n<td>";
    echo implode("</td>\n<td>",$row);
    echo "</td>\n</tr>";
  }
}
$footer = "\n</tbody>\n";
echo $footer;
if ($stmt) {
	$stmt->close();
}
$con->close();
?>
