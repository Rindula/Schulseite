<?php

if (isset($dbname)) {
$mysqli = new mysqli("localhost", DB_USER, DB_PASSWORD, $dbname);
if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SET NAMES 'utf8'";
$statement = $mysqli->prepare($sql);
$statement->execute();
} else {
    $mysqli = false;
}

$userConn = new mysqli("localhost", DB_USER, DB_PASSWORD, "stats");
if ($userConn->connect_errno) {
    die("Userverbindung fehlgeschlagen: " . $userConn->connect_error);
}
$sql = "SET NAMES 'utf8'";
$userConn->query($sql);


list($user, $pass) = array(DB_USER, DB_PASSWORD);
$dbs = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);


?>