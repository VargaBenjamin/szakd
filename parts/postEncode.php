<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'framedb';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno())
{
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ($stmt = $con->prepare('SELECT author, title, preview, maintext, publishtime FROM articles ORDER BY publishtime DESC'))
{
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $url = rawurlencode($row['title']);
  echo  '<div class="card mb-4">';
  echo    '<img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">';
  echo    '<div class="card-body">';
  echo      '<h2 class="card-title">' . $row['title'] . '</h2>';
  echo      '<p class="card-text">' . $row['preview'] . '</p>';
  echo      '<a href="post.php?title=' . $url . '" class="btn btn-primary">Read More &rarr;</a>';
  echo    '</div>';
  echo    '<div class="card-footer text-muted">';
  echo      'Posted on ' . $row['publishtime'] . ' by ';
  echo      '<a href="#">' . $row['author'] . '</a>';
  echo    '</div>';
  echo  '</div>';
  }
}
$stmt->close();
$con->close();

?>
