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
    include "../_hidden/vars.php";
    list($user, $pass) = array('query', 'Gen11!1y');
    $dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
    $dbh->query('SET NAMES utf8');

    $sth = $dbh->prepare("UPDATE users SET passwort = :pass WHERE id = :userid");

    $tmpPass = generate_password(10);

    $sth->bindParam(":pass", password_hash("$tmpPass", PASSWORD_DEFAULT));
    $sth->bindParam(":userid", $u);

    $sth->execute();

    $empfaenger = $_POST["email"];
    $betreff = 'Passwort zurückgesetzt | rindula.de';
    $nachricht = 'Hallo '.$_POST["name"].",\n\ndein Passwort auf rindula.de wurde durch einen Administrator\rzurückgesetzt. Dein neues (temporäres) Passwort ist nun \"$tmpPass\"\r(ohne Anführungszeichen). Bitte ändere es,\rsobald du dich das nächste mal eingeloggt hast!\n\nServiceteam von rindula.de\n\nDiese Nachricht wurde automatisch durch unser System versandt\nund bedarf keiner Antwort.";
    $header = array(
        'From' => 'service@rindula.de',
        'Reply-To' => 'service@rindula.de',
        'X-Mailer' => 'PHP/' . phpversion()
    );

    mail($empfaenger, $betreff, $nachricht, $header);
}

header("Location: usercontroll.php");
