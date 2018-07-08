<?php

if (!isset($_GET["id"]) || !isset($_GET["user"])) {
    http_response_code(400);
    die();
}


$needVerify = false;
include "../../_hidden/verify.php";

$userVar = $_GET["user"];

list($user, $pass) = array(DB_USER, DB_PASSWORD);
$dbh1 = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);

$sth1 = $dbh1->prepare("SELECT g.canRemove from groups as g inner join users as u on u.gruppe = g.id WHERE u.id = :username");
$sth1->bindParam(":username", $userVar);
$sth1->execute();

foreach ($sth1->fetchAll() as $row) {
    $allowed = ($row["canRemove"] == 1) ? true : false;
}


if(!isset($_SESSION['userid']) || !$allowed) {
    http_response_code(403);
    die();
}
$sth1 = null;
$dbh1 = null;

$dbh2 = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);


$sth2 = $dbh2->prepare("DELETE FROM list WHERE id = :id");
$sth2->bindParam(":id", $_GET["id"]);
$sth2->execute();

$sth2 = null;
$dbh2 = null;
http_response_code(200);