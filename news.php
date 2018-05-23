<?php

list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);

$sql = "SET NAMES 'utf8'";
$dbh->query($sql);

foreach ($dbh->query('SELECT * FROM news WHERE expdate >= now() AND showdate <= now() AND needLogin = 0') as $row) {
    echo "<div class='alert alert-info fade show' id='message_".$news["id"]."'>" . $news["text"] . "</div>";
}
if ($loggedIn) {
    foreach ($dbh->query('SELECT * FROM news WHERE expdate >= now() AND showdate <= now() AND needLogin = 1') as $row) {
        echo "<div class='alert alert-info fade show' id='message_".$news["id"]."'>" . $news["text"] . "</div>";
    }
}