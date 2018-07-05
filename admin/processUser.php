<?php

if (isset($_POST["user"])) {

  $g = $_POST["gruppe"];
  $u = $_POST["user"];

  list($user, $pass) = array('query', 'Gen11!1y');
  $dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
  $dbh->query('SET NAMES utf8');

  $sth = $dbh->prepare("UPDATE users SET gruppe = :gruppe WHERE id = :userid");

  $sth->bindParam(":gruppe", $g);
  $sth->bindParam(":userid", $u);

  $sth->execute();
  
}

if (isset($_POST["resetPass"])) {
  $u = $_POST["resetPass"];

  list($user, $pass) = array('query', 'Gen11!1y');
  $dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
  $dbh->query('SET NAMES utf8');

  $sth = $dbh->prepare("UPDATE users SET password = :pass WHERE id = :userid");

  $sth->bindParam(":pass", password_hash("default", PASSWORD_DEFAULT));
  $sth->bindParam(":userid", $u);

  $sth->execute();
}

header("Location: usercontroll.php");
