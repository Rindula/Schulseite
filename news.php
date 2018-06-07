<?php

include "_hidden/vars.php";

list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);

$sql = "SET NAMES 'utf8'";
$dbh->query($sql);

foreach ($dbh->query('SELECT * FROM news WHERE expdate >= adddate(now(), interval 22 hour) AND showdate <= now() AND needLogin = 0') as $news) {
    echo "<div class='alert alert-info fade show' id='message_".$news["id"]."'><b>[".date("d.m.Y", strtotime($news["showdate"]))."]</b><br>" . replaceLink($news["text"]) . "</div>";
}
if ($loggedIn) {
    foreach ($dbh->query('SELECT * FROM news WHERE expdate >= adddate(now(), interval 22 hour) AND showdate <= now() AND needLogin = 1') as $news) {
        echo "<div class='alert alert-info fade show' id='message_".$news["id"]."'><b>[".date("d.m.Y", strtotime($news["showdate"]))."]</b><br>" . replaceLink($news["text"]) . "</div>";
    }
}