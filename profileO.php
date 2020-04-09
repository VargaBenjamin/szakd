<?php
include 'src/autoload.php';
include 'config.php';

use Hybridauth\Hybridauth;

$hybridauth = new Hybridauth($config);
$adapters = $hybridauth->getConnectedAdapters();

// We need to use sessions, so you should always start sessions using the below code.
//session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin']))
{
	 header("Location: http://localhost/ownfcv/index.php?error=out");
	 exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'framedb';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno())
{
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Beállítások</title>
		<link href="css/loginStyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="home.php"><i class="fas fa-user-circle"></i>Vissza</a>
				<a href="parts/logout.php"><i class="fas fa-sign-out-alt"></i>Kilép</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profil oldalad</h2>
			<div>
				<p>Felhasználód adatai:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td>ID:</td>
						<td><?=$_SESSION['id']?></td>
					</tr>
					<tr>
						<td>Soc Email:</td>
						<td><?=$_SESSION['socEmail']?></td>
					</tr>
					<tr>
						<td>Soc ID:</td>
						<td><?=$_SESSION['socID']?></td>
					</tr>
					<tr>
						<td><button class="social google" onclick="window.location.href='http://localhost/ownfcv/syncCallback.php?provider=Google'">Szinkronizálás a Google-lel</button></td>
					</tr>
					<tr>
						<td><button class="social facebook" onclick="window.location.href='http://localhost/ownfcv/syncCallback.php?provider=Facebook'">Szinkronizálás a Facebookkal</button></td>
					</tr>
					<tr>
						<td><button class="social twitter" onclick="window.location.href='http://localhost/ownfcv/syncCallback.php?provider=Twitter'">Szinkronizálás a Twitterrel</button></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
