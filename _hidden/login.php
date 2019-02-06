<?php
include_once "/var/www/vhosts/rindula.de/secrets.php";
include_once "vars.php";
session_start();
list($user, $pass) = array(DB_USER, DB_PASSWORD);
$pdo = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);

if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['group'] = $user['gruppe'];
        $_SESSION['name'] = $name = $user['vorname'] . " " . $user["name"];
        $_SESSION['vorname'] = $user['vorname'];
        $_SESSION['nachname'] = $user["name"];
        $success = '1';
        header("Location: /settings?section=main");
    } else {
        $success = '0';
        $errorMessage = "Name oder Passwort war ungültig<br>";
        header("Location: /hausaufgaben");
    }
    $log = "Details: " . $_SERVER['REMOTE_ADDR'] . ' - ' . date("F j, Y, g:i a") . PHP_EOL .
            "Versuch: " . ($success == '1' ? 'Erfolgreich' : '<<Fehlgeschlagen>>') . PHP_EOL .
            "E-Mail: " . $email . PHP_EOL .
            "Name: " . $name . PHP_EOL .
            ($success == '1' ? 'Pass: # Korrekt #' : 'Pass: ' . $passwort);
    log_rin("login",$log);
} else {
    die("<h1>Fehler bei der Datenverarbeitung</h1>");
}
?>
