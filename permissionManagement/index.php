<?php

if (isset($_GET["change"])) {
    if (isset($_POST["change"])) {
        echo "<center><h1>Berechtigungen werden ge&auml;ndert...</h1></center>";
        
        $dbname = "stats";
        include_once "../_hidden/mysqlconn.php";
        
    } else {
        die("<center><h1>Fehler: Es fehlen Variablen!</h1></center>");
    }
}
?>