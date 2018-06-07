<?php $needVerify = false; include "../_hidden/verify.php"; include "../_hidden/vars.php"; $darkMode = ($_COOKIE["darkmode"] == "true") ? true : false; 
list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);

$news = $_post['news'];
$showdate = $_post['showdate'];
$expdate = $_post['expdate'];
$needLogin = $_post['needLogin'];

$stmt = $dbh->prepare("INSERT INTO news (text, showdate, expdate, needLogin) VALUES (:news , :showdate , :expdate , :needLogin)");
$stmt->bindParam(':news', $news);
$stmt->bindParam(':showdate', $showdate);
$stmt->bindParam(':expdate', $expdate);
$stmt->bindParam(':needLogin', $needLogin);

print($news);
print($showdate);
print($expdate);
print($needLogin);

$stmt->execute(); 

// header("Location: ../hausaufgaben");

?>
