<?php $needVerify = false; include "../_hidden/verify.php"; $title = "Materialien"; include "../header.php"; include "../navbar.php" ?>
<div class="list-group">
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
        echo "<a class='list-group-item list-group-item-action' href='content/$value' data-lightbox='image_$i' data-title='Fach: $i<br>Material: $n'><h1>$i - $n</h1></a>";
    }
}
?>
</div>
<?php include "../_hidden/bottomScripts.php" ?>