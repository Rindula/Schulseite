<?php
    $myfile = fopen("suchen/suche_".date("Y-m-d").".txt", "a") or die("Fehler: Code 1");
    $txt = $_GET["q"]."\n";
    fwrite($myfile, $txt);
    fclose($myfile);
    echo "<meta <meta http-equiv=\"refresh\" content=\"0; URL=http://www.google.de/search?q=".$_GET["q"]."&hl=".$_GET["hl"]."\">"
?>