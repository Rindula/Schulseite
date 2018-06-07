<?php 
list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);

$news = $_POST['news'];
$showdate = $_POST['showdate'];
$expdate = $_POST['expdate'];
$needLogin = $_POST['needLogin'];
echo $news.PHP_EOL;
echo $showdate.PHP_EOL;
echo $expdate.PHP_EOL;
echo $needLogin.PHP_EOL;
$stmt = $dbh->prepare("INSERT INTO news (`text`, `showdate`, `expdate`, `needLogin`) VALUES (? , ? , ? , ?)");
$stmt->bindParam('ssss', $news, $showdate, $expdate, $needLogin);

$stmt->execute(); 

header("Location: createNews.php");

?>
