<?php
//postLoad.php
require 'db.php';

$title = rawurldecode($_GET['title']);

if ($stmt = $con->prepare('SELECT * FROM articles, accounts WHERE articles.authorid = accounts.id AND title="' . $title . '"'))
{
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
$output =
'<h1 class="mt-4">' . $title . '</h1>
<p class="lead">
	szerző
	<a href="#">' . $article['username'] . '</a>
</p>
<hr>
<p>Megosztva ' . $article['publishtime'] . '</p>
<hr>
<!--<img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
<hr>-->
<p class="lead">' . $article['preview'] . '</p>
<p>' . $article['maintext'] . '</p>
<hr>';
echo $output;
}
if ($stmt) {
	$stmt->close();
}
$con->close();

?>
