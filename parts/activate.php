<?php
require 'db.php';
if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = $con->prepare('SELECT * FROM accounts WHERE email = ? AND activationcode = ?')) {
		$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			if ($stmt = $con->prepare('UPDATE accounts SET activationcode = ? WHERE email = ? AND activationcode = ?')) {
				$newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
				$stmt->execute();
				echo 'Your account is now activated, you can now login!<br><a href="index.php">Login</a>';
			}
		} else {
			echo 'The account is already activated or doesn\'t exist!';
		}
	}
}
$con->close();
?>
