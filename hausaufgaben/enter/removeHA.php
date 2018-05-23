<?php
$needVerify = false;
include "../../verify.php";

list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);

foreach ($dbh->query('SELECT * from groups WHERE id = ' . $gruppe) as $row) {
    $allowed = ($row["canRemove"] == 1) ? true : false;
}


if(!$loggedIn || !$allowed) {
    http_response_code(403);
    die();
}

list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);


$sth = $dbh->prepare("DELETE FROM list WHERE id = :id");
$sth->execute(array(":id" => $_GET["id"]));

echo $sth->fetchAll();

http_response_code(200);