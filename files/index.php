<?php

$dbname = "homeworks";
include "../_hidden/mysqlconn.php";

$files = scandir("content");

foreach ($c as $key => $value) {
    $s = explode("_", explode(".", $value)[0]);
    $i = $s[0];
    $n = $s[1];
    $sql = "SELECT name FROM flist WHERE id = '$i'";
    $ret = $conn->query($sql);
    $r = $ret->fetch_assoc();
    $i = $r["name"];
    echo "$i - $n";
}
