<?php

include "verify.php";
include "vars.php";
$sql = "";
$dbname = "homeworks";
include "mysqlconn.php";

list($fach, $aufgabe, $datum, $zeit) = array($mysqli->real_escape_string($_POST["fach"]), $mysqli->real_escape_string($_POST["aufgaben"]), $mysqli->real_escape_string($_POST["datum"]), $mysqli->real_escape_string($_POST["time"]));

$aufgabe = str_replace("; ", ";", $aufgabe);

if (isset($_POST["type"])) {
    if ($_POST["type"] == "0") {
        $sql = "INSERT INTO `list` (`Fach`, `Aufgaben`, `Datum`) VALUES ('$fach', '$aufgabe', '$datum')";
        $mysqli->query($sql);
        $last_id = $mysqli->insert_id."";
        log_rin("ha_enter","Hausaufgaben (ID: ". $last_id .") eingetragen von " . $_SESSION["name"]);
    }
    if ($_POST["type"] == "1") {
        $sql = "INSERT INTO `arbeiten` (`fach`, `themen`, `datum`) VALUES ('$fach', '$aufgabe', '$datum')";
        $mysqli->query($sql);
        $last_id = $mysqli->insert_id."";
        log_rin("ha_enter","Klassenarbeit (ID: ". $last_id .") eingetragen von " . $_SESSION["name"]);
    }
    if ($_POST["type"] == "2") {
        $sql = "UPDATE `arbeiten` SET themen='$aufgabe', datum='$datum' WHERE id='$fach'";
        $mysqli->query($sql);
    }
    if ($_POST["type"] == "3") {
        $sql = "UPDATE `list` SET Aufgaben='$aufgabe', Datum='$datum' WHERE ID='$fach'";
        $mysqli->query($sql);
    }
    if ($_POST["type"] == "4") {
        $sql = "INSERT INTO `termine` (`raum`, `typ`, `datum`) VALUES ('$fach', '$aufgabe', '$datum $zeit')";
        $mysqli->query($sql);
        $last_id = $mysqli->insert_id."";
        log_rin("ha_enter","Termin (ID: ". $last_id .") eingetragen von " . $_SESSION["name"]);
    }
}


echo '<script>window.close()</script>';
?>