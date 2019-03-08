<?php
    //$exitLink = "/hausaufgaben/show";
    $needVerify = true;

    // Verifikation des Clients
	include $_SERVER['DOCUMENT_ROOT'] . "/_hidden/verify.php";
	
    // Navigationsleiste
    $page = "stundenplan";
	include "../navbar.php";

    // Global Header
    $title="Stundenplan";
	include "../header.php";

    // Benötigte Variablen
	include "../_hidden/vars.php";

    // CSS Controller
    // $styles[] = "stundenplan";
    include "../css/controller.php";
    $zeiten = array("07:30 - 08:15", "08:15 - 09:00", "09:15 - 10:00", "10:00 - 10:45", "11:00 - 11:45", "11:45 - 12:30", "12:30 - 13:15", "13:15 - 14:00", "14:00 - 14:45", "15:00 - 15:45", "15:45 - 16:30");
$dbname = "homeworks";
include_once "../_hidden/mysqlconn.php";

function sonderfach($fach) {
    global $bks, $cts, $frs, $pcs, $res, $sks, $lps;
    switch ($fach) {
        case 'bk':
            return $bks;
            break;
        
        case 'ct':
            return $cts;
            break;
        
        case 'fr':
            return $frs;
            break;
        
        case 'pc':
            return $pcs;
            break;
        
        case 're':
            return $res;
            break;
        
        case 'sk':
            return $sks;
            break;
        
        case 'lp':
            return $lps;
            break;
        
        default:
            return "";
            break;
    }
}

// Container
echo "<body class='container'>";

// Tabelle erstellen
echo "<div class='ungerade'><table class='table table-striped table-bordered'><tr><th>Uhrzeit</th><th>Montag</th><th>Dienstag</th><th>Mittwoch</th><th>Donnerstag</th><th>Freitag</th></tr>";

//Zeilen zusammenfügen
$sqlM = "SELECT * FROM timetable_u ORDER BY id Asc;";
$statementM = $userConn->prepare($sqlM);
$statementM->execute();
$resultM = $statementM->get_result();
$n = 0;
while ($ar = $resultM->fetch_assoc()) 
{
    $arr = $ar["montag"];
    if (!is_numeric($arr)) {
        $mo = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($mo) = $statement->get_result()->fetch_array();
    }
    
    $arr = $ar["dienstag"];
    if (!is_numeric($arr)) {
        $di = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($di) = $statement->get_result()->fetch_array();
    }
    
    $arr = $ar["mittwoch"];
    if (!is_numeric($arr)) {
        $mi = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($mi) = $statement->get_result()->fetch_array();
    }
    

    $arr = $ar["donnerstag"];
    if (!is_numeric($arr)) {
        $do = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($do) = $statement->get_result()->fetch_array();
    }
    

    $arr = $ar["freitag"];
    if (!is_numeric($arr)) {
        $fr = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($fr) = $statement->get_result()->fetch_array();
    }
    
    $zeit = $zeiten[$n];
    $n++;
    
    echo "<tr><td>$zeit</td><td>$mo</td><td>$di</td><td>$mi</td><td>$do</td><td>$fr</td></tr>";
}
echo "</table></div>";

$n = 0;

// Tabelle erstellen
echo "<div class='gerade'><table class='table table-striped table-bordered'><tr><th>Uhrzeit</th><th>Montag</th><th>Dienstag</th><th>Mittwoch</th><th>Donnerstag</th><th>Freitag</th></tr>";


//Zeilen zusammenfügen
$sqlM = "SELECT * FROM timetable_g ORDER BY id Asc";
$statementM = $userConn->prepare($sqlM);
$statementM->execute();
$resultM = $statementM->get_result();
while ($ar = $resultM->fetch_assoc()) 
{
    $arr = $ar["montag"];
    if (!is_numeric($arr)) {
        $mo = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($mo) = $statement->get_result()->fetch_array();
    }
    
    $arr = $ar["dienstag"];
    if (!is_numeric($arr)) {
        $di = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($di) = $statement->get_result()->fetch_array();
    }
    
    $arr = $ar["mittwoch"];
    if (!is_numeric($arr)) {
        $mi = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($mi) = $statement->get_result()->fetch_array();
    }
    

    $arr = $ar["donnerstag"];
    if (!is_numeric($arr)) {
        $do = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($do) = $statement->get_result()->fetch_array();
    }
    

    $arr = $ar["freitag"];
    if (!is_numeric($arr)) {
        $fr = sonderfach($arr);
    } else {
        $sql = "SELECT fach FROM flist WHERE id IN (?)";
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("s", $arr);
        $statement->execute();
        list($fr) = $statement->get_result()->fetch_array();
    }
    
    $zeit = $zeiten[$n];
    $n++;
    
    echo "<tr><td>$zeit</td><td>$mo</td><td>$di</td><td>$mi</td><td>$do</td><td>$fr</td></tr>";
}
echo "</table></div>";

// //Container
echo "</body>";
?>

<script type="text/javascript" src="/scripts/weekController.js"></script>
<?php include "../_hidden/bottomScripts.php" ?>