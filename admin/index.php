<?php
$needVerify = true;
$exitlink = "/settings?section=main";
$title = "Einstellungen";

// Verifikation des Clients
include "../_hidden/verify.php";

include "../navbar.php";

// Global Header
include "../header.php";

// Benötigte Variablen
include "../_hidden/vars.php";

// CSS Controller
include "../css/controller.php";

?>
<body class="content">
    <h1 class="display-4">Einstellungen<br><small>Administrator Menü für <?= $_SESSION["name"] ?></small></h1>
    <div class="list-group">
        <a class="list-group-item list-group-item-action" href="/settings?section=main">Einstellungen</a>
        <a class="list-group-item list-group-item-action" href="/news/createNews.php">Nachrichten erstellen</a>
    </div>
<?php
include "../_hidden/bottomScripts.php";
?>

