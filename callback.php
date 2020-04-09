<?php
include 'hybridauth/autoload.php';
include 'parts/config.php';

use Hybridauth\Exception\Exception;
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;

try {
    $hybridauth = new Hybridauth($config);
    $storage = new Session();

    if (isset($_GET['provider']))
    {
        session_start();
        $storage->set('provider', $_GET['provider']);
    }

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'framedb';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno())
    {
    	// If there is an error with the connection, stop the script and display the error.
    	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    /**
     * When provider exists in the storage, try to authenticate user and clear storage.
     *
     * When invoked, `authenticate()` will redirect users to provider login page where they
     * will be asked to grant access to your application. If they do, provider will redirect
     * the users back to Authorization callback URL (i.e., this script).
     */
    if ($provider = $storage->get('provider'))
    {
        $hybridauth->authenticate($provider);
        $adapterKey = $hybridauth->getAdapter($provider);
        $socID = $adapterKey->getUserProfile()->identifier;

        //bejelentkezik abba a felhasználóba, ahol az oda beírt social ID megegyezik a bejelentkezésnél lévő social ID-val
        if ($stmt = $con->prepare('SELECT id, username, activation_code FROM accounts WHERE ' . mysqli_real_escape_string($con, $provider) . ' = ' . mysqli_real_escape_string($con, $socID)))
        {
          $stmt->execute();
          $stmt->store_result();
          if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $status);
            $stmt->fetch();
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $username;
            $_SESSION['id'] = $id;
            $_SESSION['status'] = $status;
            $_SESSION['socID'] = $socID;
            $socialEmail = $adapterKey->getUserProfile()->email;
            $_SESSION['socEmail'] = $socialEmail;
            HttpClient\Util::redirect('home.php');
          }
          else
          {
            //ha nincs a megfelelő social bejelentkezéshez találat
            header("Location: index.php?error=socialError");
          }
        }
        else
        {
            echo 'Hiba az eljárásban!';
        }

        $storage->set('provider', null);
        $adapterKey->disconnect();
        $con->close();
        $adapter->disconnect();
    }
}
catch (Exception $e)
{
    echo $e->getMessage();
}
