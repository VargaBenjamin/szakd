<?php
require 'db.php';
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['passwordRe'], $_POST['email']))
{
	// Could not get the data that should have been sent.
	die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['passwordRe']) || empty($_POST['email']))
{
	// One or more values are empty.
	die ('Please complete the registration form');
}
// Chech the email validation
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
	die ('Email is not valid!');
}
// Check the invalid characters
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0)
{
    die ('Username is not valid!');
}
//Check the character length
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5)
{
	die ('Password must be between 5 and 20 characters long!');
}
//Check the passwords match
if (strlen($_POST['password']) != strlen($_POST['passwordRe']))
{
	die ('Passwords must be match!');
}
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?'))
{
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0)
	{
		// Username already exists
		echo 'Username exists, please choose another!';
	}
	// Username doesnt exists, insert new account
	else
	{
    if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activation_code, coach) VALUES (?, ?, ?, ?, ?)'))
		{
    	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
    	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $uniqid = uniqid();
			if (isset($_POST['role'])) {
				$role = 0;
			} else {
				$role = 1;
			};
      $stmt->bind_param('ssssi', $_POST['username'], $password, $_POST['email'], $uniqid, $role);
    	$stmt->execute();
			//bejelentkezés a létrehozott felhasználóba
			$stmt = $con->prepare('SELECT id, password, activation_code, coach  FROM accounts WHERE username = ?');
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->bind_result($id, $password, $status, $coach);
			$stmt->fetch();
			$coachid = "";
			if ($coach == 1) {  //ha edző vagy
				$coachid = $id; //akkor az edző id-ja a saját id-d lesz (te vagy a saját edződ)
				$stmt->close(); //mindenképpen le kell zárni, mielőtt újra használnánk
				if ($stmt = $con->prepare('UPDATE accounts SET coachid = ? WHERE username = ?'))
				{
					$stmt->bind_param('is', $coachid, $_POST['username']);
					$stmt->execute();
				}
			}
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $id;
			$_SESSION['status'] = $status;
			$_SESSION['coachid'] = $coachid;
			$_SESSION['coach'] = $coach;
			header("Location: ../home.php");
		}
		else
		{
    	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
    	echo 'Could not prepare statement!';
    }
    	//echo 'You have successfully registered, you can now login!';
      /*$from    = 'noreply@yourdomain.com';
      $subject = 'Account Activation Required';
      $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
      $activate_link = 'http://yourdomain.com/phplogin/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
      $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
      mail($_POST['email'], $subject, $message, $headers);
      echo 'Please check your email to activate your account!';*/
	}
}
else
{
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
// if ($stmt) {
// 	$stmt->close();
// }
$con->close();
?>
