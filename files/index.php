<?php

$dbname = "homeworks";
include "../_hidden/mysqlconn.php";

$files = scandir("content");

foreach ($files as $key => $value) {
    if($value != ".." && $value != ".") {
        $s = explode("_", explode(".", $value)[0]);
        $i = $s[0];
        $n = $s[1];
        $sql = "SELECT fach FROM flist WHERE id = '$i'";
        $ret = $mysqli->query($sql);
        $r = $ret->fetch_assoc();
        $i = $r["fach"];
        echo "<h1>$i - $n</h1><img style='max-width: 50%' src='content/$value'>";
    }
}
