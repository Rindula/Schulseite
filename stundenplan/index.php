<?php
    //$exitLink = "/hausaufgaben/show";
    $needVerify = false;

    // Verifikation des Clients
	require $_SERVER['DOCUMENT_ROOT'] . "/_hidden/verify.php";
	
    // Navigationsleiste
    $pageId = 2;
	include "../navbar.php";

    // Global Header
	include "../header.php";

    // Benötigte Variablen
	include "../_hidden/vars.php";

    // CSS Controller
    $styles[] = "stundenplan";
    include "../css/controller.php";
    $zeiten = array("07:30 - 08:15", "08:15 - 09:00", "09:15 - 10:00", "10:00 - 10:45", "11:00 - 11:45", "11:45 - 12:30", "12:30 - 13:15", "13:15 - 14:00", "14:00 - 14:45", "15:00 - 15:45", "15:45 - 16:30");
$dbname = "homeworks";
include_once "../_hidden/mysqlconn.php";

function sonderfach($fach) {
    if ($fach == "bk") {
        return $bks;
    }
    if ($fach == "ct") {
        return $cts;
    }
    if ($fach == "fr") {
        return $frs;
    }
    if ($fach == "pc") {
        return $pcs;
    }
    if ($fach == "re") {
        return $res;
    }
    if ($fach == "sk") {
        return $sks;
    }

    return "FEHLER!";
}


// Tabelle erstellen
echo "<div class='ungerade'><table><tr><th>Uhrzeit</th><th>Montag</th><th>Dienstag</th><th>Mittwoch</th><th>Donnerstag</th><th>Freitag</th></tr>";

//Zeilen zusammenfügen
$sqlM = "SELECT * FROM timetable_u ORDER BY id Asc;";
$statementM = $userConn->prepare($sqlM);
$statementM->execute();
$resultM = $statementM->get_result();
$n = 0;
while ($ar = $resultM->fetch_assoc()) 
{
    $arr = $ar["montag"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $mo = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($mo, $tmp) = $statement->get_result()->fetch_array();
    }
    
    $arr = $ar["dienstag"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $di = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($di, $tmp) = $statement->get_result()->fetch_array();
    }
    
    $arr = $ar["mittwoch"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $mi = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($mi, $tmp) = $statement->get_result()->fetch_array();
    }
    

    $arr = $ar["donnerstag"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $do = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($do, $tmp) = $statement->get_result()->fetch_array();
    }
    

    $arr = $ar["freitag"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $fr = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($fr, $tmp) = $statement->get_result()->fetch_array();
    }
    
    $zeit = $zeiten[$n];
    $n++;
    
    echo "<tr><td>$zeit</td><td>$mo</td><td>$di</td><td>$mi</td><td>$do</td><td>$fr</td></tr>";
}
echo "</table></div>";

$n = 0;

// Tabelle erstellen
echo "<div class='gerade'><table><tr><th>Uhrzeit</th><th>Montag</th><th>Dienstag</th><th>Mittwoch</th><th>Donnerstag</th><th>Freitag</th></tr>";


//Zeilen zusammenfügen
$sqlM = "SELECT * FROM timetable_g ORDER BY id Asc";
$statementM = $userConn->prepare($sqlM);
$statementM->execute();
$resultM = $statementM->get_result();
while ($ar = $resultM->fetch_assoc()) 
{
    $arr = $ar["montag"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $mo = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($mo, $tmp) = $statement->get_result()->fetch_array();
    }
    
    $arr = $ar["dienstag"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $di = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($di, $tmp) = $statement->get_result()->fetch_array();
    }
    
    $arr = $ar["mittwoch"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $mi = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($mi, $tmp) = $statement->get_result()->fetch_array();
    }
    

    $arr = $ar["donnerstag"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $do = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($do, $tmp) = $statement->get_result()->fetch_array();
    }
    

    $arr = $ar["freitag"];
    if (in_array($arr, array("pc", "re", "fr", "bk", "sk", "ct"))) {
        $fr = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($fr, $tmp) = $statement->get_result()->fetch_array();
    }
    
    $zeit = $zeiten[$n];
    $n++;
    
    echo "<tr><td>$zeit</td><td>$mo</td><td>$di</td><td>$mi</td><td>$do</td><td>$fr</td></tr>";
}
echo "</table></div>";
?>

<script type="text/javascript" src="/scripts/weekController.js"></script>