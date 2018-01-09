<?php


$newsConn = @new mysqli("localhost", "root", "74cb0A0kER", "stats");
if ($newsConn->connect_errno) {
    die("<span>Verbindung fehlgeschlagen: " . $newsConn->connect_error . "</span>");
}
$sql = "SET NAMES 'utf8'";
$newsConn->query($sql);

if($ret = $newsConn->query("SELECT * FROM news WHERE DATE(expdate) >= DATE(now())") !== FALSE) {

    while ($news = $ret->fetch_assoc()) {
        echo "<span class='aktiv' id='message_".$news["id"]."'>" . $news["text"] . "</span>";
    }

}
