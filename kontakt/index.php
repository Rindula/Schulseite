<?php
    //$exitLink = "/hausaufgaben/show";
    $needVerify = false;

    // Verifikation des Clients
	include "../_hidden/verify.php";
	
    // Navigationsleiste
    $pageId = 3;
	include "../navbar.php";

    // Global Header
	include "../header.php";

    // Benötigte Variablen
	include "../_hidden/vars.php";

    // CSS Controller
    $styles[] = "kontakt";
    include "../css/controller.php";

    // Datenbankverbindung herstellen
    mysql_connect("localhost", "rindula", $mySqlPassword);
	// Datenbank und Tabelle erstellen, falls noch nicht vorhanden
	mysql_query("CREATE DATABASE IF NOT EXISTS homeworks");
	// Datenbank auswählen
	mysql_select_db("homeworks");
        mysql_query("SET NAMES 'utf8'");

    echo "<table><tr><th>Name</th><th>Vorname</th><th>E-Mail</th></tr>";
    $result = mysql_query("SELECT * FROM lehrer ORDER BY name Asc");
    while ($ar = mysql_fetch_array($result)) 
    {
        $vorname = sonderzeichen($ar["vorname"]);
        $name = sonderzeichen($ar["name"]);
        $email = strtolower($vorname).".".strtolower($name)."@friedrich-hecker-schule.de";
        echo "<tr><td>".$ar["name"]."</td><td>".$ar["vorname"]."</td><td><a href='mailto:".$email."'>".$email."</a></td></tr>";
    }
    echo "</table>";
?>