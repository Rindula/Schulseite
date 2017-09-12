<?php
session_start();
session_destroy();
$pageId = 3;
include "../navbar.php";
 
echo 'Logout erfolgreich<meta http-equiv="refresh" content="0; URL='.$_SESSION["url"].'">';
?>