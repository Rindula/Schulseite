<?php $needVerify = false; include "../_hidden/verify.php"; include "../_hidden/vars.php"; $darkMode = ($_COOKIE["darkmode"] == "true") ? true : false; 
list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);

$news = $_post['news'];
$showdate = $_post['showdate'];
$expdate = $_post['expdate'];
$needLogin = $_post['needLogin'];

$stmt = $dbh->prepare("INSERT INTO news (text, showdate, expdate, needLogin) VALUES (:news , :showdate , :expdate , :needLogin)");
$stmt->bindParam(':news', $news);
$showdate = $showdate->format('YYYY-mm-dd HH:i:s');
$stmt->bindParam(':showdate', $showdate);
$expdate = $expdate->format('YYYY-mm-dd HH:i:s');
$stmt->bindParam(':expdate', $expdate);
$stmt->bindParam(':needLogin', $needLogin);

$stmt->execute(); 

header("Location: ../hausaufgaben");

?>
