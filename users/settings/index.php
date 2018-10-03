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
<?php
// Passwort ändern
if ($_GET["section"] == "passwort" && isset($_GET["change"]) && isset($_POST["confirm"])) {
    $error = false;
    $errorMsg = "";
    $result = $userConn->query("SELECT * FROM users WHERE id = '" . $_SESSION["userid"] . "'");
    if (!result) {
        $error = true;
    }
    if (!$error) {
        $res = $result->fetch_assoc();
        if (password_verify($_POST["oldpass"], $res['passwort'])) {
            if ($_POST["newpass"] == $_POST["newpass2"]) {
                $userConn->query("UPDATE users SET passwort = '" . password_hash($_POST["newpass"], PASSWORD_DEFAULT) . "' WHERE id = " . $_SESSION["userid"]);
                echo "<h1>Passwort geändert</h1>";
            } else {
                $error = true;
                $errorMsg .= "Die Passwörter sind nicht identisch!\n";
            }
        } else {
            $error = true;
            $errorMsg .= "Falses Passwort eingegeben!\n";
        }
    }
    if ($error) {
        echo "<code>Error: $errorMsg</code>";
    }
}


if ($_GET["section"] == "lessons" && isset($_GET["change"]) && isset($_POST["confirm"])) {
    $bk = $_POST["lesson_bk"];
    $ct = $_POST["lesson_ct"];
    // $sk = $_POST["lesson_sk"];
    $pc = $_POST["lesson_pc"];
    $fr = $_POST["lesson_fr"];
    $re = $_POST["lesson_re"];
    $lp = $_POST["lesson_lp"];
    $userConn->query("UPDATE users SET bk = $bk, ct = $ct, pc = $pc, fr = $fr, re = $re, lp = $lp WHERE id = " . $_SESSION["userid"]);
    echo "<code>Stunden werden übernommen...</code>";
}

$ret = $userConn->query("SELECT bk, ct, sk, pc, fr, re, lp FROM users WHERE id = '" . $_SESSION["userid"] . "'");
list($lesson_bk, $lesson_ct, $lesson_sk, $lesson_pc, $lesson_fr, $lesson_re, $lesson_lp) = $ret->fetch_array();

if (isset($_GET["change"])) {
    echo '<meta http-equiv="refresh" content="0; URL=?section=' . $_GET["section"] . '">';
}

$sec = $_GET["section"];


if ($sec == "main") {
    ?>
    <div class="content text-center">
    <form class="form" action="" method="get">
        <h1 class="display-4">Einstellungen<br><small>Willkommen, <?= $_SESSION["name"] ?></small></h1>
        <div class="list-group">
            <button class="list-group-item list-group-item-action" name="section" value="passwort">Passwort ändern</button>
            <button class="list-group-item list-group-item-action" name="section" value="lessons">Fächer einstellen</button>
</div>
        </form>
    </div>
<?php
} else {
    ?>
    <form class="button_back" action="" method="get">
        <button class="btn btn-outline-danger btn-block" type="submit" name="section" value="main">Zurück</button>
    </form>
<?php
}

if ($sec == "passwort") {
    ?>
    <div class="content">
        <form class="form p-4" action="?section=passwort&change" method="POST" enctype="multipart/form-data">
                        <label for="oldPass">Altes Passwort:</label>
                        <input autocomplete="off" id="oldPass" class="form-control" required="" type="password" name="oldpass" value="" />
                        <label for="newPass">Neues Passwort:</label>
                        <input autocomplete="off" id="newPass" class="form-control" required="" type="password" name="newpass" value="" />
                        <label for="newPass2">Passwort Wiederholen:</label>
                        <input autocomplete="off" id="newPass2" class="form-control" required="" type="password" name="newpass2" value="" />
            <input class="btn btn-outline-success m-4" name="confirm" type="submit" />
        </form>
    </div>
<?php }
if ($sec == "lessons") {
    ?>
    
    <div class="content">
        <form class="form" action="?section=lessons&change" method="post">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Fach</th>
                    <th>Auswahl</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Bildene Kunst</td>
                    <td>
                        <select class="form-control" name="lesson_bk" id="">
                            <option <?= ($lesson_bk == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_bk == 1) ? "selected" : ""; ?> value="1">Gewählt</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Computertechnik</td>
                    <td>
                        <select class="form-control" name="lesson_ct" id="">
                            <option <?= ($lesson_ct == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_ct == 1) ? "selected" : ""; ?> value="1">Videoschnitt</option>
                            <option <?= ($lesson_ct == 2) ? "selected" : ""; ?> value="2">Websiten aufbau</option>
                        </select>
                    </td>
                </tr>
                <!-- <tr>
                    <td>Seminarkurs</td>
                    <td>
                        <select class="form-control" name="lesson_sk" id="">
                            <option <?= ($lesson_sk == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_sk == 1) ? "selected" : ""; ?> value="1">Gewählt</option>
                        </select>
                    </td>
                </tr> -->
                <tr>
                    <td>Physik/Chemie</td>
                    <td>
                        <select class="form-control" name="lesson_pc" id="">
                            <option <?= ($lesson_pc == 0) ? "selected" : ""; ?> value="0">Physik</option>
                            <option <?= ($lesson_pc == 1) ? "selected" : ""; ?> value="1">Chemie</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Zweite Fremdsprache</td>
                    <td>
                        <select class="form-control" name="lesson_fr" id="">
                            <option <?= ($lesson_fr == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_fr == 1) ? "selected" : ""; ?> value="1">Spanisch</option>
                            <option <?= ($lesson_fr == 2) ? "selected" : ""; ?> value="2">Französisch</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Religionsunterricht</td>
                    <td>
                        <select class="form-control" name="lesson_re" id="">
                            <option <?= ($lesson_re == 0) ? "selected" : ""; ?> value="0">Ethik</option>
                            <option <?= ($lesson_re == 1) ? "selected" : ""; ?> value="1">Katholisch</option>
                            <option <?= ($lesson_re == 2) ? "selected" : ""; ?> value="2">Evangelisch</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Literatur / Philosophie</td>
                    <td>
                        <select class="form-control" name="lesson_lp" id="">
                            <option <?= ($lesson_lp == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_lp == 1) ? "selected" : ""; ?> value="1">Literatur</option>
                            <option <?= ($lesson_lp == 2) ? "selected" : ""; ?> value="2">Philosophie</option>
                        </select>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr><td><input class="btn btn-outline-success" type="submit" name="confirm"></td></tr>
                </tfoot>
            </table>
        </form>
    </div>
</body>
<?php
}
echo "</div>";
include "../../_hidden/bottomScripts.php";
?>

