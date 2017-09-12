<?php

$mysqli = new mysqli("localhost", "rindula", "SiSal2002", $dbname);
if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SET NAMES 'utf8'";
$statement = $mysqli->prepare($sql);
$statement->execute();

$userConn = new mysqli("localhost", "rindula", "SiSal2002", "stats");
if ($userConn->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $userConn->connect_error);
}
$sql = "SET NAMES 'utf8'";
$userConn->query($sql);
?>