<?php

if (isset($_GET["close"])) {
    $id = $_GET["close"];
    $arr = (empty($_SESSION["news_messages"])) ? array('0') : json_decode($_SESSION["news_messages"]); 
    $arr = array_push($arr, $id);
    $_SESSION["news_messages"] = json_encode($arr);
} else {
    $newsConn = new mysqli("localhost", "root", "74cb0A0kER", "stats");
    if ($newsConn->connect_errno) {
        die("<span>Verbindung fehlgeschlagen: " . $newsConn->connect_error . "</span>");
    }
    $sql = "SET NAMES 'utf8'";
    $statement = $newsConn->prepare($sql);
    $statement->execute();

    if($ret = $newsConn->query("SELECT * FROM news") !== FALSE) {

    while ($news = $ret->fetch_assoc()) {
        if (!in_array($news["id"], json_decode($_SESSION["news_messages"]))) {
            echo "<span class='aktiv' id='message_".$news["id"]."'>" . $news["text"] . "<span onclick='closeNews(\"".$news["id"]."\")'>&#10008;</span></span>";
        }
    }
}
}
