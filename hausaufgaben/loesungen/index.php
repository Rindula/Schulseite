<!doctype html>
<html lang="de">
<?php

function is_image($path) {
    $a = getimagesize($path);
    $image_type = $a[2];

    if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
        return true;
    }
    return false;
}

//$exitLink = "/hausaufgaben/show";
$needVerify = false;

// Verifikation des Clients
include "../../_hidden/verify.php";

// Secrets
include "../../../secrets.php";

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

// Hausaufgaben Infos
// select `h`.`ID` AS `ID`,`h`.`Aufgaben` AS `Aufgaben`,`h`.`Datum` AS `Datum`,`f`.`fach` AS `Fach` from (`homeworks`.`list` `h` join `homeworks`.`flist` `f` on((`h`.`Fach` = `f`.`id`))) where (`h`.`Datum` >= (now() + interval -(16) hour)) order by `h`.`Datum`

$dbh = new PDO('mysql:host=localhost;dbname=homeworks', DB_USER, DB_PASSWORD);
$dbh->query('SET NAMES utf8');

$sql = "select `h`.`ID` AS `id`,`h`.`Aufgaben` AS `aufgaben`,`h`.`Datum` AS `datum`,`f`.`fach` AS `fach` from (`homeworks`.`list` `h` join `homeworks`.`flist` `f` on((`h`.`Fach` = `f`.`id`))) WHERE h.ID = :id order by `h`.`Datum`";

$sth = $dbh->prepare($sql);
$sth->bindParam(":id", $id);
$sth->execute();
$res = $sth->fetchAll();
foreach ($res as $row) {
    $fach = $row["fach"];
    $datum = $row["datum"];
}

?>
    <body class="container">
        <a class="md-4 btn btn-primary btn-block disabled">Lösung hochladen</a>
        <div class="m-4 justify-content-center d-inline-block">
        <?php
        list($year, $month, $day) = explode("-", $datum);
        foreach (glob($path . '*') as $filename) {
            if (is_image($filename)) {
                echo "<a class='p-4' data-title='$fach Hausaufgabe bis zum ".strftime("%A", strtotime($datum)).", $day.$month.$year<br><small>Keine Haftung für Fehler!</small>' data-lightbox='loesungen-$id' href='$id/" . basename($filename) . "'><img class='img-thumbnail w-25' src='$id/" . basename($filename) . "'></a>";
            }
        }
        ?>
        </div>
        <?php include "../../_hidden/bottomScripts.php" ?>
        
    </body>
</html>