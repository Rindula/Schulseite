<?php

$query = $_REQUEST["q"];
$out = "<table><tr><th>Fach</th><th>Thema</th><th>Datum</th></tr>\n";
$dbname = "homeworks";
include_once "../_hidden/mysqlconn.php";

$tmp = explode(",", $query);
$qr = "";
foreach ($tmp as $value) {
    $qr .= "'" . $value . "', ";
}

function removeDir($dir) {
    foreach (glob($dir . '*') as $filename) {
        unlink($filename);
    }
    rmdir($dir);
}

$qr = substr($qr, 0, -2);

$sql = "SELECT * FROM arbeiten WHERE fach IN($qr) ORDER BY datum Asc";
$result = $mysqli->query($sql);
while ($ar = $result->fetch_assoc()) {
    $today = strtotime(date("Y-m-d"));
    $expiration_date = strtotime($ar["datum"]);
    list($year, $month, $day) = explode("-", $ar["datum"]);
    if ($expiration_date < $today) {
        continue;
    }

    $sql2 = "SELECT * FROM flist WHERE ID = ?";
    $query = $mysqli->prepare($sql2);
    $query->bind_param('s', $ar['fach']);
    $query->execute();
    $result2 = $query->get_result();
    $fach = $result2->fetch_assoc();


        if ($expiration_date <= ($today + (1 * 60 * 60 * 24))) {
            $out .= "<tr id='" . $ar['ID'] . "' class='dringend'>";
        } else {
            $out .= "<tr id='" . $ar['ID'] . "' class='zuErledigen'>";
        }

        $datetime1 = date_create(date("Y-m-d"));
        $datetime2 = date_create($ar["datum"]);
        $interval = date_diff($datetime1, $datetime2);
        if ($interval->format('%a') == "1") {
            $days = $interval->format('%a Tag');
        } else {
            $days = $interval->format('%a Tage');
        }
        $sql3 = "SELECT * FROM lehrer ORDER BY name Asc";
        $statement2 = $mysqli->prepare($sql3);
        $statement2->execute();
        $result3 = $statement2->get_result();
        while ($l = $result3->fetch_assoc()) {
            if ($fach["lehrer"] == $l["id"]) {
                if ($l["geschlecht"] == "m") {
                    $gesch = "Hr. ";
                } elseif ($l["geschlecht"] == "w") {
                    $gesch = "Fr. ";
                } else {
                    $gesch = "? ";
                }

                $themen = "";
                if ($ar["themen"] != "") {
                    foreach (explode(";", $ar["themen"]) as $t) {
                        $themen .= "<li>$t</li>";
                    }
                }
                if (($expiration_date == $today)) {
                    $out .= "<td class='fach fertig'>" . $fach["fach"] . "<br>(" . $gesch . $l['name'] . ")</td>";
                    $out .= "<td class='aufgaben fertig'>" . $themen . "</td>";
                    $out .= "<td class='datum fertig'>$day.$month.$year ($days)</td>";
                } else {
                    $out .= "<td class='fach'>" . $fach["fach"] . "<br>(" . $gesch . $l['name'] . ")</td>";
                    $out .= "<td class='aufgaben'>" . $themen . "</td>";
                    $out .= "<td class='datum'>$day.$month.$year ($days)</td>";
                }
                if ($loggedIn) {
                    $out .= "<td>" . $ar["id"] . "</td>";
                }
            }
        }
        $out .= "</tr>";
}

echo $out === "<table><tr><th>Fach</th><th>Thema</th><th>Datum</th></tr>\n" ? "<h2>Keine Arbeiten in diesem Fach</h2>" : $out;
?>