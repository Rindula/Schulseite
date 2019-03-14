<?php
if (isset($_GET["mobil"])) {
    $mobil = true;
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <?php
} else {
    $mobil = false;
}

$darkMode = ($_COOKIE["darkmode"] == "true") ? true : false;

$query = $_REQUEST["q"];
$o = "<table class='table table-striped".(($darkMode) ? " table-dark" : "")."'><thead><tr><th scope='col'>Fach</th><th scope='col'>Aufgaben</th><th scope='col'>Zieldatum</th></tr></thead>";
$out = $o;
$om = "";
$dbname = "homeworks";
include "../_hidden/mysqlconn.php";
include "../_hidden/vars.php";
include "../../secrets.php";

if($query === "all") {
    $sql = "SELECT h.ID, h.Aufgaben, h.Datum, f.fach FROM list as h inner join flist as f on h.Fach = f.id WHERE h.Datum >= adddate(now(), interval -16 hour) ORDER BY h.Datum, f.fach Asc";
} else {
    $query = $mysqli->real_escape_string($query);
    $sql = "SELECT h.ID, h.Aufgaben, h.Datum, f.fach FROM list as h inner join flist as f on h.Fach = f.id WHERE h.Fach = '$query' AND h.Datum >= adddate(now(), interval -16 hour) ORDER BY h.Datum, f.fach Asc";
}

$result = $mysqli->query($sql);
$dbh = new PDO('mysql:host=localhost;dbname=homeworks', DB_USER, DB_PASSWORD);
$dbh->query('SET NAMES utf8');
while ($ar = $result->fetch_assoc()) {
    foreach ($dbh->query('SELECT COUNT(id) as cnt FROM loesungen WHERE hid = "'.$ar["ID"].'"') as $row) {
        $cnt = $row["cnt"];
    }
    
    $today = strtotime(date("Y-m-d"));
    $expiration_date = strtotime($ar["Datum"]);
    list($year, $month, $day) = explode("-", $ar["Datum"]);


    if ($expiration_date > $today + (1 * 60 * 60 * 24)) {
        $classes = "";
        $list = "";
    } elseif ($expiration_date == $today + (1 * 60 * 60 * 24)) {
        $classes = "table-warning text-dark";
        $list = "list-group-item-warning";
    } else {
        $classes = "table-danger text-dark";
        $list = "list-group-item-danger";
    }
    $list .= ($darkMode) ? " list-group-item-dark" : "";
    $title = "";
    $onclick = "";
    if ($cnt > 0) {
        $classes = $classes . " imageAcc text-info";
        $title = "Anklicken, um die Lösungen Ein-/Auszublenden";
    }
    $out .= "<tr title='$title' data-toggle='collapse' href='#".$ar["ID"]."' aria-expanded='false' aria-controls='".$ar["ID"]."' class='$classes'>";
    $om .= "<div title='$title' data-toggle='collapse' href='#".$ar["ID"]."' aria-expanded='false' aria-controls='".$ar["ID"]."' class='$classes'><ul class='list-group'>";

    $datetime1 = date_create(date("Y-m-d"));
    $datetime2 = date_create($ar["Datum"]);
    $interval = date_diff($datetime1, $datetime2);
    if ($interval->format('%a') == "1") {
        $days = $interval->format('%a Tag');
    } else {
        $days = $interval->format('%a Tage');
    }

    $aufgaben = "";
    $tasks = "";
    if ($ar["Aufgaben"] != "") {
        foreach (explode(";", $ar["Aufgaben"]) as $a) {
            $aufgaben .= "<li class='list-group-item $list'>".replaceLink($a)."</li>";
            $tasks .= "\n```=> $a```";
        }
    }


    $om .= "<li class='fach' title='".$ar["ID"]."'><h3>" . $ar["fach"] . "</h3></li>";
    $om .= "<li class='aufgaben'><ul class='list-group'>" . $aufgaben . "</ul></li>";
    $om .= "<li class='datum'>".strftime("%A", strtotime($ar["Datum"])).", $day.$month.$year ($days)</li>";

    $out .= "<td class='fach' title='".$ar["ID"]."'>" . $ar["fach"] . "</td>";
    $out .= "<td class='aufgaben'><ul class='list-group'>" . $aufgaben . "</ul></td>";
    $out .= "<td class='datum'>".strftime("%A", strtotime($ar["Datum"])).", $day.$month.$year ($days)</td>";
    $text = "whatsapp://send?text=".whatsNewLine("*Hausaufgabe*\nFach: _".$ar["fach"]."_\nZu erledigen bis: *".strftime("%A", strtotime($ar["Datum"])).", $day.$month.$year*" . ((!empty($tasks)) ? "\n\nAufgabe(n):$tasks" : ""));
    $out .= "<td class='d-lg-none'><div class='btn-group-vertical' role='group'><a class='btn btn-success' href=\"$text\" data-action=\"share/whatsapp/share\">Auf Whatsapp teilen</a>";
    if ($cnt > 0) {
        $out .= "<a class='btn btn-primary' href='/hausaufgaben/loesungen/?id=".$ar["ID"]."'>Lösungen ansehen</a>";
    } else {
        $out .= "<a class='btn btn-secondary' href='/hausaufgaben/loesungen/upload.php?id=".$ar["ID"]."'>Lösungen hochladen</a>";
    }

    $out .= "</div></td>";
    $om .= "</ul></div>";
    $out .= "</tr>";
}
if ($mobil) {
    echo $om;
} else {
    echo $out === $o ? "<h2>Keine Aufgaben in diesem Fach</h2>" : $out;
}
?>