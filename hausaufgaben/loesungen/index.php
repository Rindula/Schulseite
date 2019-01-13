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

        <a href="upload.php?id=<?= $id ?>" class="md-4 btn btn-primary btn-block">Lösung hochladen</a>

        <div class="m-4 justify-content-center d-inline-block">
        <?php
        list($year, $month, $day) = explode("-", $datum);
        $sql = "SELECT loesungen.data, loesungen.extension as ext FROM loesungen INNER JOIN list ON loesungen.hid = list.ID WHERE loesungen.hid = :id";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":id", $id);
        $sth->execute();
        $res = $sth->fetchAll();
        foreach ($res as $row) {
            echo "<a data-title='$fach Hausaufgabe bis zum ".strftime("%A", strtotime($datum)).", $day.$month.$year<br><small>Keine Haftung für Fehler!</small>' data-lightbox='loesungen-$id' href='data:image/".$row["ext"].";base64," . $row["data"] . "'><img class='img-thumbnail w-25 m-4' src='data:image/".$row["ext"].";base64," . $row["data"] . "'></a>";
        }
        ?>
        </div>
        <?php include "../../_hidden/bottomScripts.php" ?>
        
    </body>
</html>