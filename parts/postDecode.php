<?php
require 'db.php';

$title = rawurldecode($_GET['title']);

if ($stmt = $con->prepare('SELECT author, title, preview, maintext, publishtime FROM articles WHERE title="' . $title . '"'))
{
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
echo '<h1 class="mt-4">' . $title . '</h1>';
echo	'<p class="lead">';
echo		'by ';
echo		'<a href="#">' . $article['author'] . '</a>';
echo	'</p>';
echo	'<hr>';
echo	'<p>Posted on ' . $article['publishtime'] . '</p>';
echo	'<hr>';
echo	'<img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">';
echo	'<hr>';
echo	'<p class="lead">' . $article['preview'] . '</p>';
echo	'<p>' . $article['maintext'] . '</p>';
echo	'<hr>';
}
if ($stmt) {
	$stmt->close();
}
$con->close();

?>
