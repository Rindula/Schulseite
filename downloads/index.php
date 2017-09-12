<?php

//$exitLink = "/hausaufgaben/show";
$needVerify = false;

// Verifikation des Clients
include "../_hidden/verify.php";

// Navigationsleiste
$pageId = 9;
include "../navbar.php";

// Global Header
include "../header.php";

// Benötigte Variablen
include "../_hidden/vars.php";

$styles[] = "downloads";
include "../css/controller.php";
?>

<?php

$cnt = 0;

if ($handle = opendir('./content/')) {
    echo "<div class='list'>";
    while (false !== ($e = readdir($handle))) {

        if ($e != "." && $e != ".." && $e != "_hiddenContent") {
            $cnt++;
            echo "<h2>$e</h2><ul>";
            if ($handle2 = opendir('./content/' . $e)) {
                while (false !== ($entry = readdir($handle2))) {
                    if ($entry != "." && $entry != "..") {
                        $filesize = formatSizeUnits(filesize("./content/$e/$entry"));
                        echo "<li><a class='$classes' href='download.php?file=" . urlencode($entry) . "&sub=$e'>" . basename($entry) . " (" . $filesize . ") | {Letzte &Auml;nderung: " . date('d.m.Y H:i:s.', filemtime("./content/$e/$entry"))."}</a></li>\n";
                    }
                }
                closedir($handle2);
            }
            echo "</ul>";
        }
    }
    closedir($handle);
    echo "</div>";
}
