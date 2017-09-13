<?php

if (isset($dbname)) {
$mysqli = new mysqli("localhost", "root", "WQeYt4S8G3", $dbname);
if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SET NAMES 'utf8'";
$statement = $mysqli->prepare($sql);
$statement->execute();
} else {
    $mysqli = false;
}

$userConn = new mysqli("localhost", "root", "WQeYt4S8G3", "stats");
if ($userConn->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $userConn->connect_error);
}
$sql = "SET NAMES 'utf8'";
$userConn->query($sql);
?>