<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../scripts/lightbox.js"></script>
</head>
<?php

$styles[] = "lightbox";
include "../css/controller.php";

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
        echo "<a href='content/$value' data-lightbox='image_$i' data-title='$n ($i)'><h1>$i - $n</h1></a>";
    }
}
