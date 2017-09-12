<?php

header("HTTP/1.0 404 Not Found");

//$exitLink = "/hausaufgaben/show";
$needVerify = false;

// Verifikation des Clients
include "../_hidden/verify.php";

// Navigationsleiste
$pageId = 5;
include "../navbar.php";

// Global Header
include "../header.php";

// Benötigte Variablen
include "../_hidden/vars.php";

$styles[] = "app";
include "../css/controller.php";


if ($handle = opendir('./download/')) {
    echo "<h1>Android</h1><div id='list1'><ul>";
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && strtolower(substr($entry, strrpos($entry, '.') + 1)) == 'apk') {
            $filesize = formatSizeUnits(filesize("./download/".$entry));
            echo "<li><a href='download.php?file=".$entry."'>".basename($entry, ".apk")." (".$filesize.")</a></li>\n";
        }
    }
    closedir($handle);
    echo "</ul></div>";
}
?>