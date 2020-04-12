<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	 header("Location: http://localhost/ownfcv/index.php?error=out");
	exit();
}
$status = $_SESSION['status'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Test Home</title>
		<link href="css/loginStyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin" onload="getStatus();">
		<nav class="navtop">
			<div>
				<h1>Szakd</h1>
				<a href="http://localhost/ownfcv/profile.php"><i class="fas fa-user-circle"></i>Profil</a>
				<a href="http://localhost/ownfcv/logout.php"><i class="fas fa-sign-out-alt"></i>Kilép</a>
			</div>
		</nav>
		<div class="content">
			<p id="status"></p>
			<h2>Menü</h2>
			<p id="name"></p>
			<p>Üdv újra, <?=$_SESSION['name']?>!</p>
		</div>

<script>
	function getStatus() {
		var sessionStat = <?php echo json_encode($status);?>;
		console.log(sessionStat);
		if (sessionStat == "activated")
		{
			document.getElementById("status").innerHTML = "A te státuszod aktivált";
		}
		else
		{
			document.getElementById("status").innerHTML = "A te státuszod nincs aktiválva";
		}
	}
</script>

	</body>
</html>
