<?php
$needVerify = true;
$exitlink = "/login";
$title = "Einstellungen";

// Verifikation des Clients
include "../../_hidden/verify.php";

$page = "settings";
include "../../navbar.php";

// Global Header
include "../../header.php";

// Benötigte Variablen
include "../../_hidden/vars.php";
$dbname = "homeworks";
include "../../_hidden/mysqlconn.php";

// CSS Controller
// $styles[] = "settings";
include "../../css/controller.php";


if (!isset($_GET["section"])) {
    header("Location: ?section=main");
}
?>
<body class="container">
    <div class="content text-center">
        <h1 class="display-4">Einstellungen<br><small>Willkommen, <?= $_SESSION["name"] ?></small></h1>
        <div class="list-group">
            <a class="list-group-item list-group-item-action" href="/settings">Einstellungen</a>
            <a class="list-group-item list-group-item-action" href="/news/createNews.php">Nachrichten erstellen</a>
        </div>
    </div>
<?php
include "../../_hidden/bottomScripts.php";
?>

