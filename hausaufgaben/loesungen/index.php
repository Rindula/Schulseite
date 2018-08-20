<!doctype html>
<html lang="de">
<?php
//$exitLink = "/hausaufgaben/show";
$needVerify = false;

// Verifikation des Clients
include "../../_hidden/verify.php";

// Navigationsleiste
include "../../navbar.php";

// Global Header
$title="Lösungen";
include "../../header.php";

// Benötigte Variablen
include "../../_hidden/vars.php";

// CSS Controller
// $styles[] = "hausaufgaben";
$styles[] = "lightbox";
include "../../css/controller.php";

$id = $_GET["id"];
$path = $_SERVER['DOCUMENT_ROOT'] . "/hausaufgaben/loesungen/$id/";
?>
    <body class="container">
        <?php
        $lnk = 0;
        foreach (glob($path . '*') as $filename) {
            if (is_image($filename)) {
                $lnk++;
                $out .= "<a data-title='".$ar["fach"]." Hausaufgabe bis zum ".strftime("%A", strtotime($ar["Datum"])).", $day.$month.$year<br><small>Keine Haftung für Fehler!</small>' data-lightbox='loesungen-$id' href='$id/" . basename($filename) . "'>Lösung Seite " . $lnk . "</a><br>";
            }
        }

        include "../../_hidden/bottomScripts.php" ?>
    </body>
</html>