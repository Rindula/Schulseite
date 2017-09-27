<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dbname = "homeworks";
include "../_hidden/mysqlconn.php";

$files = scandir("content");

foreach ($files as $key => $value) {
    if($value != ".." || $value != ".") {
        $s = explode("_", explode(".", $value)[0]);
        $i = $s[0];
        $n = $s[1];
        $sql = "SELECT name FROM flist WHERE id = '$i'";
        $ret = $conn->query($sql);
        $r = $ret->fetch_assoc();
        $i = $r["name"];
        echo "$i - $n";
    }
}
