<?php
    $id = $_GET["id"];

    include "vars.php";
    include "verify.php";


	// Datenbankverbindung herstellen
    mysql_connect("localhost", "rindula", $mySqlPassword);
	// Datenbank und Tabelle erstellen, falls noch nicht vorhanden
	mysql_query("CREATE DATABASE IF NOT EXISTS homeworks");
	// Datenbank auswählen
	mysql_select_db("homeworks");

    $query = "UPDATE list SET Erledigt='2' WHERE ID='$id' AND Erledigt='1'";
    mysql_query($query);
    $query = "UPDATE list SET Erledigt='1' WHERE ID='$id' AND Erledigt='0'";
    mysql_query($query);
    $query = "UPDATE list SET Erledigt='0' WHERE ID='$id' AND Erledigt='2'";
    mysql_query($query);

    echo "<script>window.location.replace('/hausaufgaben/')</script>";
?>
