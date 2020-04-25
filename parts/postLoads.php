<?php
//postLoads.php
require 'db.php';

if ($stmt = $con->prepare('SELECT * FROM articles, accounts WHERE articles.authorid = accounts.id ORDER BY publishtime DESC'))
{
  $stmt->execute();
  $result = $stmt->get_result();
	$output = '';
  while ($row = $result->fetch_assoc()) {
		$url = rawurlencode($row['title']);
	  $output.=
		'<div class="card mb-6">
    <img class="card-img-top" src="' . $row['picture'] . '" alt="Card image cap">
	   <div class="card-body">
	     <h2 class="card-title">' . $row['title'] . '</h2>
	     <p class="card-text">' . $row['preview'] . '</p>
	     <a href="post.php?title=' . $url . '" class="btn btn-primary">Olvass róla többet &rarr;</a>
	   </div>
	   <div class="card-footer text-muted">
	     Megosztva ' . $row['publishtime'] . ', szerző
	     <a href="#">' . $row['username'] . '</a>
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
