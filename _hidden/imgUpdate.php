<?php
	include "../header.php";
	include "../_hidden/vars.php";

	// Lese Input...
	$id = $_GET["id"];
	$value = $_GET["link"];
	
	// Datenbankverbindung herstellen
    mysql_connect("localhost", "root", $mySqlPassword);
	// Datenbank auswählen
	mysql_select_db("myPasswords");
	
	
	if (isSet($_GET["delete"])) {
		unlink("..".htmlspecialchars_decode($value));
		mysql_query("UPDATE list SET account='/img/placeholder.png' WHERE ID='$id'");
	} else {
		mysql_query("UPDATE list SET account='$value' WHERE ID='$id'");
	}
	
	echo '<script>window.location.replace("/passwords/")</script>';
?>
