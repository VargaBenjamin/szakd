<?php
require 'db.php';

if (isset($_POST['registration']))
{
	$usernameR = mysqli_real_escape_string($con, $_POST["username"]);
	$emailR = mysqli_real_escape_string($con, $_POST["email"]);
	$passwordR = mysqli_real_escape_string($con, $_POST["password"]);
	$roleR = mysqli_real_escape_string($con, $_POST["role"]);

	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?'))
	{
		$stmt->bind_param('s', $usernameR);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows > 0)
		{
			die('Felhasználónév már használatban van! Kérjük válasz egy másikat!');
		}
		else
		{

	    if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activationcode, coach) VALUES (?, ?, ?, ?, ?)'))
			{
	    	$passwordHash = password_hash($passwordR, PASSWORD_DEFAULT);
	      $uniqid = uniqid();
	      $stmt->bind_param('ssssi', $usernameR, $passwordHash, $emailR, $uniqid, $roleR);
	    	$stmt->execute();
				$stmt->close();

				//szerver felvitel után automatikus első bejelentkezés az újonnan felvitt felhasználóba
				$stmt = $con->prepare('SELECT id, password, activationcode FROM accounts WHERE username = ?');
				$stmt->bind_param('s', $usernameR);
				$stmt->execute();
				$stmt->bind_result($id, $password, $status);
				$stmt->fetch();
				$coachid = "";
				$stmt->close();	//mindenképpen le kell zárni, mielőtt újra használnánk

				if ($roleR == 1) //ha edző vagy (0 vendég, 1 edző)
				{
					$coachid = $id; //akkor az edző id-ja a saját id-d lesz (te vagy a saját edződ)
					if ($stmt = $con->prepare('INSERT INTO calendaroption (coachid) VALUES (?)'))	//naptár felületet létrehozza az edzőknek az alap beállításokkal
					{
						$stmt->bind_param('i', $coachid);
						$stmt->execute();
						$stmt->close();
					}
					else
					{
			    	die('Szerver elérés sikertelen!');
			    }

					if ($stmt = $con->prepare('UPDATE accounts SET coachid = ? WHERE username = ?')) //saját felhasználói részét frissíti a coachid-val
					{
						$stmt->bind_param('is', $coachid, $usernameR);
						$stmt->execute();
						$stmt->close();
					}
					else
					{
			    	die('Szerver elérés sikertelen!');
			    }

				}

				if ($stmt = $con->prepare('INSERT INTO charts (userid) VALUES (?)'))	//kimutatásokat létrehozza az alap beállításokkal
				{
					$stmt->bind_param('i', $id);
					$stmt->execute();
					$stmt->close();
				}
				else
				{
					die('Szerver elérés sikertelen!');
				}

				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $usernameR;
				$_SESSION['id'] = $id;
				$_SESSION['status'] = $status;
				$_SESSION['coachid'] = $coachid;
				$_SESSION['coach'] = $_POST['role'];
				echo "valid";
			}
			else
			{
	    	die('Szerver elérés sikertelen!');
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
		die('Szerver elérés sikertelen!');
	}
}




if (isset($_POST['login'])) {
	if (!isset($_POST['username'], $_POST['password']))
	{
	    die('Töltse ki a mezőket');
	}
	if ($stmt = $con->prepare('SELECT id, password, activationcode, coach, coachid FROM accounts WHERE username = ?')) {
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
            echo "valid";
	        }
					else
					{
	            die('Helytelen jelszó!');
	        }
	    }
			else
			{
	        die('Nem található ilyen nevű felhasználó!');
	    }
	}
	else
	{
	die('Szerver elérés sikertelen!');
	}
}

$con->close();
?>
