<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=stats', 'root', "74cb0A0kER");

if (isset($_GET['login'])) {
    $name = $_POST['name'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE login = :name");
    $result = $statement->execute(array('name' => $name));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['group'] = $user['gruppe'];
        $_SESSION['name'] = $user['vorname'] . " " . $user["name"];
        $success = '1';
        header("Location: /hausaufgaben");
    } else {
        $success = '0';
        $errorMessage = "Name oder Passwort war ungültig<br>";
    }
    $log = "Details: " . $_SERVER['REMOTE_ADDR'] . ' - ' . date("F j, Y, g:i a") . PHP_EOL .
            "Attempt: " . ($success == '1' ? 'Erfolgreich' : '<<Fehlgeschlagen>>') . PHP_EOL .
            "User: " . $name . PHP_EOL .
            ($success != '1' ? 'Pass: # correct #' : 'Pass: ' . $passwort) . PHP_EOL .
            "-------------------------" . PHP_EOL;
    file_put_contents('../log/loginlog_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
} else {
    die("<h1>Fehler bei der Datenverarbeitung</h1>");
}
?>