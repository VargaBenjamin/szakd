<?php
include 'hybridauth/autoload.php';
include 'parts/syncConfig.php';

use Hybridauth\Exception\Exception;
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;

try {
    $hybridauth = new Hybridauth($config);
    $storage = new Session();

    if (isset($_GET['provider']))
    {
        $storage->set('provider', $_GET['provider']);
    }

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'framedb';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno())
    {
    	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    if ($provider = $storage->get('provider'))
    {
        $hybridauth->authenticate($provider);
        $adapterKey = $hybridauth->getAdapter($provider);
        $socID = $adapterKey->getUserProfile()->identifier;
        //$stmt = $con->prepare('UPDATE accounts SET ' . mysqli_real_escape_string($con, $provider) . ' = ' . mysqli_real_escape_string($con, $socID) . ' WHERE id = ' . $_SESSION['id'])
        $stmt = $con->prepare('UPDATE accounts SET ' . mysqli_real_escape_string($con, $provider) . ' = ' . mysqli_real_escape_string($con, $socID) . ' WHERE id = ' . $_SESSION['id']);
        $stmt->execute();
        $stmt->store_result();
        header("Location: profile.php");
        $storage->set('provider', null);
        $adapterKey->disconnect();
        $con->close();
    }
}
catch (Exception $e)
{
    echo $e->getMessage();
}
