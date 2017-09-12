<?php

list($fach, $aufgabe, $datum, $zeit) = array($_POST["fach"], $_POST["aufgaben"], $_POST["datum"], $_POST["time"]);

include "vars.php";
include "verify.php";
$sql = "";
$dbname = "";

if (isset($_POST["type"])) {
    if ($_POST["type"] == "0") {
        $dbname = "homeworks";
        include "mysqlconn.php";
        $sql = "INSERT INTO `list` (`ID`, `Fach`, `Aufgaben`, `Datum`) VALUES (NULL, '$fach', '$aufgabe', '$datum')";
        $mysqli->query($sql);
    }
    if ($_POST["type"] == "1") {
        $dbname = "homeworks";
        include "mysqlconn.php";
        $sql = "INSERT INTO `arbeiten` (`id`, `fach`, `themen`, `datum`) VALUES (NULL, '$fach', '$aufgabe', '$datum')";
        $mysqli->query($sql);
    }
    if ($_POST["type"] == "2") {
        $dbname = "homeworks";
        include "mysqlconn.php";
        $sql = "UPDATE `arbeiten` SET themen='$aufgabe', datum='$datum' WHERE id='$fach'";
        $mysqli->query($sql);
    }
    if ($_POST["type"] == "3") {
        $dbname = "homeworks";
        include "mysqlconn.php";
        $sql = "UPDATE `list` SET Aufgaben='$aufgabe', Datum='$datum' WHERE ID='$fach'";
        $mysqli->query($sql);
    }
    if ($_POST["type"] == "4") {
        $dbname = "stats";
        include "mysqlconn.php";
        $sql = "INSERT INTO `termine` (`id`, `raum`, `typ`, `datum`) VALUES (NULL, '$fach', '$aufgabe', '$datum $zeit')";
        $mysqli->query($sql);
    }
}


echo '<script>window.close()</script>';
?>