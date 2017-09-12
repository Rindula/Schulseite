<?php
    //$exitLink = "/hausaufgaben/show";
    $needVerify = false;

    // Verifikation des Clients
	include "../_hidden/verify.php";
	
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

$dbname = "homeworks";
include_once "../_hidden/mysqlconn.php";


// Tabelle erstellen
echo "<div class='ungerade'><table><tr><th>Uhrzeit</th><th>Montag</th><th>Dienstag</th><th>Mittwoch</th><th>Donnerstag</th><th>Freitag</th></tr>";

//Zeilen zusammenfügen
$sqlM = "SELECT * FROM stundenplan1 ORDER BY id Asc";
$statementM = $mysqli->prepare($sqlM);
$statementM->execute();
$resultM = $statementM->get_result();
while ($ar = $resultM->fetch_assoc()) 
{
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", $ar["montag"]);
    $statement->execute();
    list($mo, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", $ar["dienstag"]);
    $statement->execute();
    list($di, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", $ar["mittwoch"]);
    $statement->execute();
    list($mi, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", $ar["donnerstag"]);
    $statement->execute();
    list($do, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", $ar["freitag"]);
    $statement->execute();
    list($fr, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    
    list($sh, $sm) = explode(":", $ar["zeitA"]);
    list($eh, $em) = explode(":", $ar["zeitE"]);
    $zeit = "$sh:$sm - $eh:$em";
    
    echo "<tr><td>$zeit</td><td>$mo</td><td>$di</td><td>$mi</td><td>$do</td><td>$fr</td></tr>";
}
echo "</table></div>";


// Tabelle erstellen
echo "<div class='gerade'><table><tr><th>Uhrzeit</th><th>Montag</th><th>Dienstag</th><th>Mittwoch</th><th>Donnerstag</th><th>Freitag</th></tr>";


//Zeilen zusammenfügen
$sqlM = "SELECT * FROM stundenplan2 ORDER BY id Asc";
$statementM = $mysqli->prepare($sqlM);
$statementM->execute();
$resultM = $statementM->get_result();
while ($ar = $resultM->fetch_assoc()) 
{
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", str_replace (",", " AND ", $ar["montag"]));
    $statement->execute();
    list($mo, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", str_replace (",", " AND ", $ar["dienstag"]));
    $statement->execute();
    list($di, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", str_replace (",", " AND ", $ar["mittwoch"]));
    $statement->execute();
    list($mi, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", str_replace (",", " AND ", $ar["donnerstag"]));
    $statement->execute();
    list($do, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    $sql = "SELECT fach FROM flist WHERE id IN (?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("s", str_replace (",", " AND ", $ar["freitag"]));
    $statement->execute();
    list($fr, $tmp) = $statement->get_result()->fetch_array();
    if(isset($tmp)) {$mo = $mo."/".$tmp;}
    
    list($sh, $sm) = explode(":", $ar["zeitA"]);
    list($eh, $em) = explode(":", $ar["zeitE"]);
    $zeit = "$sh:$sm - $eh:$em";
    
    echo "<tr><td>$zeit</td><td>$mo</td><td>$di</td><td>$mi</td><td>$do</td><td>$fr</td></tr>";
}
echo "</table></div>";
?>

<script type="text/javascript" src="/scripts/weekController.js"></script>