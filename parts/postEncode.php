<?php
require 'db.php';

if ($stmt = $con->prepare('SELECT author, title, preview, maintext, publishtime FROM articles ORDER BY publishtime DESC'))
{
  $stmt->execute();
  $result = $stmt->get_result();
	$output = '';
  while ($row = $result->fetch_assoc()) {
		$url = rawurlencode($row['title']);
	  $output.=
		'<div class="card mb-4">
	   <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
	   <div class="card-body">
	     <h2 class="card-title">' . $row['title'] . '</h2>
	     <p class="card-text">' . $row['preview'] . '</p>
	     <a href="post.php?title=' . $url . '" class="btn btn-primary">Read More &rarr;</a>
	   </div>
	   <div class="card-footer text-muted">
	     Posted on ' . $row['publishtime'] . ' by
	     <a href="#">' . $row['author'] . '</a>
	   </div>
	  </div>';
  }
	echo $output;
}
if ($stmt) {
	$stmt->close();
}
$con->close();
?>
