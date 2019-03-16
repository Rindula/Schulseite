<?php
ob_start();
include "verify.php";
include "vars.php";
$sql = "";
$dbname = "homeworks";
include "mysqlconn.php";
ob_end_clean();

list($fach, $aufgabe, $datum, $zeit) = array($mysqli->real_escape_string($_POST["fach"]), $mysqli->real_escape_string($_POST["aufgaben"]), $mysqli->real_escape_string($_POST["datum"]), $mysqli->real_escape_string($_POST["time"]));

$aufgabe = str_replace("; ", ";", $aufgabe);

if (isset($_POST["type"])) {
    if ($_POST["type"] == "0") {
        $sql = "INSERT INTO `list` (`Fach`, `Aufgaben`, `Datum`) VALUES ('$fach', '$aufgabe', '$datum')";
        $mysqli->query($sql);
        $last_id = $mysqli->insert_id."";
        log_rin("ha_enter","Hausaufgaben (ID: ". $last_id .") eingetragen von " . $_SESSION["name"]);
        $tasks = "";
        foreach (explode(";", $aufgabe) as $a) {
            $tasks .= "\n=> $a";
        }
        $fach = $mysqli->query("SELECT fach FROM flist WHERE id = $fach");
        $fach = $fach->fetch_assoc();
        $ret = postNewHomework(0, $fach["fach"], $tasks, strftime("%A, %d.%m.%G", strtotime($datum)), "1654195");
        $type = "Hausaufgabe";
        $mod = "eingetragen";
    }
    if ($_POST["type"] == "1") {
        $sql = "INSERT INTO `arbeiten` (`fach`, `themen`, `datum`) VALUES ('$fach', '$aufgabe', '$datum')";
        $mysqli->query($sql);
        $last_id = $mysqli->insert_id."";
        log_rin("ka_enter","Klassenarbeit (ID: ". $last_id .") eingetragen von " . $_SESSION["name"]);
        $tasks = "";
        foreach (explode(";", $aufgabe) as $a) {
            $tasks .= "\n=> $a";
        }
        $fach = $mysqli->query("SELECT fach FROM flist WHERE id = $fach");
        $fach = $fach->fetch_assoc();
        $ret = postNewHomework(1, $fach["fach"], $tasks, strftime("%A, %d.%m.%G", strtotime($datum)), "15241746");
        $type = "Klassenarbeit";
        $mod = "eingetragen";
    }
    if ($_POST["type"] == "2") {
        $sql = "UPDATE `arbeiten` SET themen='$aufgabe', datum='$datum' WHERE id='$fach'";
        $mysqli->query($sql);
        log_rin("ka_change","Klassenarbeit (ID: ". $fach .") geändert von " . $_SESSION["name"]);
        $type = "Klassenarbeit";
        $mod = "geändert";
    }
    if ($_POST["type"] == "3") {
        $sql = "UPDATE `list` SET Aufgaben='$aufgabe', Datum='$datum' WHERE ID='$fach'";
        $mysqli->query($sql);
        log_rin("ha_change","Hausaufgabe (ID: ". $fach .") geändert von " . $_SESSION["name"]);
        $type = "Hausaufgabe";
        $mod = "geändert";
    }
    if ($_POST["type"] == "4") {
        $sql = "INSERT INTO `termine` (`raum`, `typ`, `datum`) VALUES ('$fach', '$aufgabe', '$datum $zeit')";
        $mysqli->query($sql);
        $last_id = $mysqli->insert_id."";
        log_rin("t_enter","Termin (ID: ". $last_id .") eingetragen von " . $_SESSION["name"]);
        $type = "Termin";
        $mod = "eingetragen";
    }
}


echo json_encode(array("datum" => strftime("%A, %d.%m.%G", strtotime($datum)), "type" => $type, "modification" => $mod));
?>