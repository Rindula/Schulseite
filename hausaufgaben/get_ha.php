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

if($query === "all") {
    $sql = "SELECT h.ID, h.Aufgaben, h.Datum, f.fach FROM list as h inner join flist as f on h.Fach = f.id WHERE h.Datum >= adddate(now(), interval -16 hour) ORDER BY h.Datum, f.fach Asc";
} else {
    $query = $mysqli->real_escape_string($query);
    $sql = "SELECT h.ID, h.Aufgaben, h.Datum, f.fach FROM list as h inner join flist as f on h.Fach = f.id WHERE h.Fach = '$query' AND h.Datum >= adddate(now(), interval -16 hour) ORDER BY h.Datum, f.fach Asc";
}

function removeDir($dir) {
    foreach (glob($dir . '*') as $filename) {
        unlink($filename);
    }
    if (is_dir($dir))
        rmdir($dir);
}
function is_dir_empty($dir) {
    if (!is_readable($dir))
        return NULL;
    $handle = opendir($dir);
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            return FALSE;
        }
    }
    return TRUE;
}
function is_image($path) {
    $a = getimagesize($path);
    $image_type = $a[2];

    if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
        return true;
    }
    return false;
}

$result = $mysqli->query($sql);
while ($ar = $result->fetch_assoc()) {
    $IMAGEPATH = $_SERVER['DOCUMENT_ROOT'] . "/hausaufgaben/loesungen/" . $ar["ID"] . "/";

    $today = strtotime(date("Y-m-d"));
    $expiration_date = strtotime($ar["Datum"]);
    list($year, $month, $day) = explode("-", $ar["Datum"]);
    if ($expiration_date < ($today - (86400 * 7))) {
        removeDir($IMAGEPATH);
    }
    if (!is_dir($IMAGEPATH))
        mkdir($IMAGEPATH);


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
    if (is_dir($IMAGEPATH) == 1 && !is_dir_empty($IMAGEPATH)) {
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
    $out .= "<td class='d-lg-none'><a class='btn btn-success' href=\"$text\" data-action=\"share/whatsapp/share\">Auf Whatsapp teilen</a></td>";
    $out .= "<td>";
    if (is_dir($IMAGEPATH) == 1 && !is_dir_empty($IMAGEPATH)) {
        $lnk = 0;
        foreach (glob($IMAGEPATH . '*') as $filename) {
            if (is_image($filename)) {
                $lnk++;
                $out .= "<a data-title='".$ar["fach"]." Hausaufgabe bis zum ".strftime("%A", strtotime($ar["Datum"])).", $day.$month.$year<br><small>Keine Haftung für Fehler!</small>' data-lightbox='loesungen-" . $ar["ID"] . "' href='loesungen/" . $ar["ID"] . "/" . basename($filename) . "'>Lösung Seite " . $lnk . "</a><br>";
            }
        }
    }

    $out .= "</td>";
    $om .= "</ul></div>";
    $out .= "</tr>";
}
if ($mobil) {
    echo $om;
} else {
    echo $out === $o ? "<h2>Keine Aufgaben in diesem Fach</h2>" : $out;
}
?>