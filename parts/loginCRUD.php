<?php
require 'db.php';

if (isset($_POST['registration']))
{
	
	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?'))
	{
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows > 0)
		{
			echo 'Felhasználónév már használatban van! Kérjük válasz egy másikat!';
		}
		else
		{

	    if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activation_code, coach) VALUES (?, ?, ?, ?, ?)'))
			{
	    	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	      $uniqid = uniqid();
	      $stmt->bind_param('ssssi', $_POST['username'], $password, $_POST['email'], $uniqid, $_POST['role']);
	    	$stmt->execute();

				$stmt = $con->prepare('SELECT id, password, activation_code FROM accounts WHERE username = ?');
				$stmt->bind_param('s', $_POST['username']);
				$stmt->execute();
				$stmt->bind_result($id, $password, $status);
				$stmt->fetch();
				$coachid = "";

				if ($_POST['role'] == 1) //ha edző vagy
				{
					$coachid = $id; //akkor az edző id-ja a saját id-d lesz (te vagy a saját edződ)
					$stmt->close(); //mindenképpen le kell zárni, mielőtt újra használnánk

					if ($stmt = $con->prepare('INSERT INTO calendaroption (coachid) VALUES (?)'))
					{
						$stmt->bind_param('i', $coachid);
						$stmt->execute();
						$stmt->close();
					}

					if ($stmt = $con->prepare('UPDATE accounts SET coachid = ? WHERE username = ?'))
					{
						$stmt->bind_param('is', $coachid, $_POST['username']);
						$stmt->execute();
						$stmt->close();
					}

				}
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $_POST['username'];
				$_SESSION['id'] = $id;
				$_SESSION['status'] = $status;
				$_SESSION['coachid'] = $coachid;
				$_SESSION['coach'] = $_POST['role'];
				echo "valid";
			}
			else
			{
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
		echo 'Could not prepare statement!';
	}
}




if (isset($_POST['login'])) {
	if (!isset($_POST['username'], $_POST['password']))
	{
	    die('Please fill both the username and password field!');
	}
	if ($stmt = $con->prepare('SELECT id, password, activation_code, coach, coachid FROM accounts WHERE username = ?')) {
	    $stmt->bind_param('s', $_POST['username']);
	    $stmt->execute();
	    $stmt->store_result();
	    if ($stmt->num_rows > 0) {
	        $stmt->bind_result($id, $password, $status, $coach, $coachid);
	        $stmt->fetch();
	        if (password_verify($_POST['password'], $password))
					{
						session_start();
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['status'] = $status;
            $_SESSION['coach'] = $coach;
            $_SESSION['coachid'] = $coachid;
            //echo 'Welcome ' . $_SESSION['name'] . '!';
            echo "valid";
	        }
					else
					{
	            echo 'Incorrect password!';
	        }
	    }
			else
			{
	        echo 'Incorrect username!';
	    }
	}
}

$con->close();
?>
