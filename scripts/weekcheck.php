<?php

require_once "../../secrets.php";

$dbh = new PDO('mysql:host=localhost;dbname=stats', DB_USER, DB_PASSWORD);
$dbh->query('SET NAMES utf8');

foreach ($dbh->query('SELECT value FROM configuration WHERE ckey = "weekConfig"') as $row) {
    echo $row["value"];
}