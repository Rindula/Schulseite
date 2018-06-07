<?php 
list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
$dbh->query("SET NAMES utf8");

$news = $_POST['news'];
$showdate = $_POST['showdate'];
$expdate = $_POST['expdate'];
$needLogin = $_POST['needLogin'];

$stmt = $dbh->prepare("INSERT INTO news (`text`, `showdate`, `expdate`, `needLogin`) VALUES (:newsIN, :showdateIN, :expdateIN, :needLoginIN)");
$stmt->bindParam(':newsIN', $news);
$stmt->bindParam(':showdateIN', $showdate);
$stmt->bindParam(':expdateIN', $expdate);
$stmt->bindParam(':needLoginIN', $needLogin);

$stmt->execute(); 

header("Location: createNews.php");

?>
