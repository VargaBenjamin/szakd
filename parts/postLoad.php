<?php
//postLoad.php
require 'db.php';

$tit = rawurldecode($_GET['title']);
$title = mysqli_real_escape_string($con, $tit);
if ($stmt = $con->prepare('SELECT * FROM articles, accounts WHERE articles.authorid = accounts.id AND title= ? '))
{
	$stmt->bind_param('s', $title);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
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
		<img class="img-fluid rounded" src="' . $article['picture'] . '" alt="">
		<hr>
		<p class="lead">' . $article['preview'] . '</p>
		<p>' . $article['maintext'] . '</p>
		<hr>';
		echo $output;
	}
	else {
	header('Location: ../home.php'); //valamiért nem jó
	}
}
$con->close();

?>
