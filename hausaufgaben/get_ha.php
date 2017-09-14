<?php

$query = $_REQUEST["q"];
$o = "<table><tr><th>Fach</th><th>Aufgaben</th><th>Zieldatum</th></tr>";
$out = $o;
$dbname = "homeworks";
include "../_hidden/mysqlconn.php";
include "../_hidden/vars.php";


if($query === "all") {
    $sql = "SELECT * FROM list ORDER BY Datum Asc";
} else {
    $query = $mysqli->real_escape_string($query);
    $sql = "SELECT * FROM list WHERE Fach = '$query' ORDER BY Datum Asc";
}

function removeDir($dir) {
    foreach (glob($dir . '*') as $filename) {
        unlink($filename);
    }
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
    if ($expiration_date < $today) {
        continue;
    }

    mkdir($IMAGEPATH);

    if ($expiration_date <= $today + (1 * 60 * 60 * 24)) {
        $classes = "dringend";
    } else {
        $classes = "zuErledigen";
    }
    $title = "";
    if (is_dir($IMAGEPATH) == 1 && !is_dir_empty($IMAGEPATH)) {
        $classes = $classes . " imageAcc erledigt";
        $title = "Anklicken, um die Lösungen Ein-/Auszublenden";
    }
    $out .= "<tr title='$title' id='" . $ar['ID'] . "' class='$classes'>";


    $datetime1 = date_create(date("Y-m-d"));
    $datetime2 = date_create($ar["Datum"]);
    $interval = date_diff($datetime1, $datetime2);
    if ($interval->format('%a') == "1") {
        $days = $interval->format('%a Tag');
    } else {
        $days = $interval->format('%a Tage');
    }

    $aufgaben = "";
    if ($ar["Aufgaben"] != "") {
        foreach (explode(";", $ar["Aufgaben"]) as $a) {
            $aufgaben .= "<li>$a</li>";
        }
    }


    if (($expiration_date == $today)) {
        $out .= "<td class='fach fertig'>" . $ar["Fach"] . "</td>";
        $out .= "<td class='aufgaben fertig'>" . $aufgaben . "</td>";
        $out .= "<td class='datum fertig'>$day.$month.$year ($days)</td>";
    } else {
        $out .= "<td class='fach'>" . $ar["Fach"] . "</td>";
        $out .= "<td class='aufgaben'>" . $aufgaben . "</td>";
        $out .= "<td class='datum'>$day.$month.$year ($days)</td>";
    }
    $out .= "</tr>";
    $out .= "<tr class='imageDisplay'>";
    if (is_dir($IMAGEPATH) == 1 && !is_dir_empty($IMAGEPATH)) {
        $out .= "<td colspan='3' style='background-color: rgba(60, 209, 163, 0.5);'>";
        $lnk = 0;
        foreach (glob($IMAGEPATH . '*') as $filename) {
            if (is_image($filename)) {
                $lnk++;
                $out .= "<a data-lightbox='loesungen-" . $ar["ID"] . "' href='loesungen/" . $ar["ID"] . "/" . basename($filename) . "'><img style='padding: 2.5%; width: 95%;' src='loesungen/" . $ar["ID"] . "/" . basename($filename) . "'></img></a>\n";
            }
        }
        $out .= "</td>";
    }
    $out .= "</tr>";
}

echo $out === $o ? "<h2>Keine Aufgaben in diesem Fach</h2>" : $out;
?>