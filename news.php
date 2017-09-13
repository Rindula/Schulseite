<?php

if (isset($_GET["close"])) {
    $id = $_GET["close"];
    $array = $_COOKIE["news_messages"];
    array_push($array, $id);
    setcookie("news_messages", $array);
} else {
    $newsConn = new mysqli("localhost", "root", "WQeYt4S8G3", "stats");
    if ($newsConn->connect_errno) {
        die("<span>Verbindung fehlgeschlagen: " . $newsConn->connect_error . "</span>");
    }
    $sql = "SET NAMES 'utf8'";
    $statement = $newsConn->prepare($sql);
    $statement->execute();

    $ret = $newsConn->query("SELECT * FROM news");

    while ($news = $ret->fetch_assoc()) {
        if (!in_array($news["id"], $_COOKIE["news_messages"])) {
            echo "<span class='aktiv' id='message_".$news["id"]."'>" . $news["text"] . "<span onclick='closeNews(\"".$news["id"]."\")'>&#10008;</span></span>";
        }
    }
}
