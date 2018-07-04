<?php

if (isset($dbname)) {
$mysqli = new mysqli("localhost", "query", "Gen11!1y", $dbname);
if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SET NAMES 'utf8'";
$statement = $mysqli->prepare($sql);
$statement->execute();
} else {
    $mysqli = false;
}

$userConn = new mysqli("localhost", "query", "Gen11!1y", "stats");
if ($userConn->connect_errno) {
    die("Userverbindung fehlgeschlagen: " . $userConn->connect_error);
}
$sql = "SET NAMES 'utf8'";
$userConn->query($sql);


list($user, $pass) = array('query', 'Gen11!1y');
$dbs = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);


?>