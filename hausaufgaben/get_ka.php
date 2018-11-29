<?php

$darkMode = ($_COOKIE["darkmode"] == "true") ? true : false;

$query = $_REQUEST["q"];
$o = "<table class='table table-striped".(($darkMode) ? " table-dark" : "")."'><thead><tr><th scope='col'>Fach</th><th scope='col'>Aufgaben</th><th scope='col'>Zieldatum</th></tr></thead>";
$out = $o;
$dbname = "homeworks";
include "../_hidden/mysqlconn.php";
include "../_hidden/vars.php";


if($query === "all") {
    $sql = "SELECT a.id, a.themen, a.datum, f.fach FROM arbeiten as a inner join flist as f on a.fach = f.id WHERE a.datum >= adddate(now(), interval -16 hour) ORDER BY a.datum Asc";
} else {
    $query = $mysqli->real_escape_string($query);
    $sql = "SELECT a.id, a.themen, a.datum, f.fach FROM arbeiten as a inner join flist as f on a.fach = f.id WHERE a.fach = '$query' AND a.datum >= adddate(now(), interval -16 hour) ORDER BY a.datum Asc";
}

$result = $mysqli->query($sql);
while ($ar = $result->fetch_assoc()) {

    $today = strtotime(date("Y-m-d"));
    $expiration_date = strtotime($ar["datum"]);
    list($year, $month, $day) = explode("-", $ar["datum"]);
    if ($expiration_date <= $today + (1 * 60 * 60 * 24)) {
        $classes = "table-danger text-dark";
        $list = "list-group-item-danger";
    } else {
        $classes = "";
        $list = "";
    }
    $list .= ($darkMode) ? " list-group-item-dark" : "";
    $out .= "<tr id='" . $ar['id'] . "' class='$classes'>";


    $datetime1 = date_create(date("Y-m-d"));
    $datetime2 = date_create($ar["datum"]);
    $interval = date_diff($datetime1, $datetime2);
    if ($interval->format('%a') == "1") {
        $days = $interval->format('%a Tag');
    } else {
        $days = $interval->format('%a Tage');
    }

    $aufgaben = "";
    $tasks = "";
    if ($ar["themen"] != "") {
        foreach (explode(";", $ar["themen"]) as $a) {
            $aufgaben .= "<li class='list-group-item $list'>".replaceLink($a)."</li>";
            $tasks .= "\n```=> $a```";
        }
    }


    if (($expiration_date == $today)) {
        $out .= "<td class='fach fertig'>" . $ar["fach"] . "</td>";
        $out .= "<td class='aufgaben fertig'><ul class='list-group'>" . $aufgaben . "</ul></td>";
        $out .= "<td class='datum fertig'>".strftime("%A", strtotime($ar["datum"])).", $day.$month.$year ($days)</td>";
    } else {
        $out .= "<td class='fach'>" . $ar["fach"] . "</td>";
        $out .= "<td class='aufgaben'><ul class='list-group'>" . $aufgaben . "</ul></td>";
        $out .= "<td class='datum'>".strftime("%A", strtotime($ar["datum"])).", $day.$month.$year ($days)</td>";
    }
    $text = "whatsapp://send?text=".whatsNewLine("*Klassenarbeit*\nFach: _".$ar["fach"]."_\nTermin am: *".strftime("%A", strtotime($ar["datum"])).", $day.$month.$year*" . ((!empty($tasks)) ? "\n\nThemen:$tasks" : ""));
    $out .= "<td class='d-lg-none'><a class='btn btn-success' href=\"$text\" data-action=\"share/whatsapp/share\">Auf Whatsapp teilen</a></td>";
    $out .= "</tr>";
}

echo $out === $o ? "<h2>Keine Arbeiten in diesem Fach</h2>" : $out;
?>