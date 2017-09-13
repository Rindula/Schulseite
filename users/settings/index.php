<?php
$needVerify = true;
$exitlink = "/login";
$title = "Einstellungen";

// Verifikation des Clients
include "../../_hidden/verify.php";

include "../../navbar.php";

// Global Header
include "../../header.php";

// Benötigte Variablen
include "../../_hidden/vars.php";
include "../../_hidden/mysqlconn.php";

// CSS Controller
$styles[] = "settings";
include "../../css/controller.php";


if (!isset($_GET["section"])) {
    header("Location: ?section=main");
}
?>
<style>
    ul li button {
        text-decoration: none;
        color: black;
        display: inline-block;
        background-color: #ff6666;
        padding: 10px;
        margin: 10px;
        transition: 0.2s all linear;
    }
    ul li button:hover {
        color: white;
        background-color: #6666ff;
    }

    input[type="color"] {
        -webkit-appearance: none;
        border: none;
        width: 32px;
        height: 32px;
    }
    input[type="color"]::-webkit-color-swatch-wrapper {
        padding: 0;
    }
    input[type="color"]::-webkit-color-swatch {
        border: none;
    }
</style>
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

if ($_GET["section"] == "colors" && isset($_GET["change"]) && isset($_POST["confirm"])) {
    $userConn->query("UPDATE users SET navbarBack = '" . $_POST["colorNavBarBack"] . "', navbarText = '" . $_POST["colorNavBarText"] . "', backgroundPage = '" . $_POST["backgroundColor"] . "' WHERE id = '" . $_SESSION["userid"] . "'");
    $_SESSION["colors"][0] = $_POST["colorNavBarBack"];
    $_SESSION["colors"][1] = $_POST["colorNavBarText"];
    $_SESSION["colors"][2] = $_POST["backgroundColor"];
    echo "<code>Farben werden übernommen...</code>";
}


if ($_GET["section"] == "lessons" && isset($_GET["change"]) && isset($_POST["confirm"])) {
    $bk = $_POST["lesson_bk"];
    $ct = $_POST["lesson_ct"];
    $sk = $_POST["lesson_sk"];
    $pc = $_POST["lesson_pc"];
    $fr = $_POST["lesson_fr"];
    $re = $_POST["lesson_re"];
    $userConn->query("UPDATE users SET bk = $bk, ct = $ct, sk = $sk, pc = $pc, fr = $fr, re = $re");
    echo "<code>Stunden werden übernommen...</code>";
}

$ret = $userConn->query("SELECT bk, ct, sk, pc, fr, re FROM users WHERE id = '" . $_SESSION["userid"] . "'");
list($lesson_bk, $lesson_ct, $lesson_sk, $lesson_pc, $lesson_fr, $lesson_re) = $ret->fetch_array();

if (isset($_GET["change"])) {
    echo '<meta http-equiv="refresh" content="3; URL=?section=' . $_GET["section"] . '">';
}

$sec = $_GET["section"];


if ($sec == "main") {
    ?>
    <div class="content">
    <form action="" method="get">
        <h1>Einstellungen<br><small>Willkommen, <?= $_SESSION["name"] ?></small></h1>
        <ul style="list-style-type: none;">
            <li><button name="section" value="passwort">Passwort ändern</button></li>
            <li><button name="section" value="colors">Farben ändern</button></li>
            <li><button name="section" value="lessons">Fächer einstellen</button></li>
        </ul>
        </form>
    </div>
<?php
} else {
    ?>
    <form class="button_back" action="" method="get">
        <button type="submit" name="section" value="main">Zurück</button>
    </form>
<?php
}

if ($sec == "passwort") {
    ?>
    <div class="content">
        <form action="?section=passwort&change" method="POST" enctype="multipart/form-data">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Altes Passwort:</td>
                        <td><input required="" type="password" name="oldpass" value="" /></td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>Neues Passwort</td>
                        <td><input required="" type="password" name="newpass" value="" /></td>
                    </tr>
                    <tr>
                        <td>Passwort Wiederholen:</td>
                        <td><input required="" type="password" name="newpass2" value="" /></td>
                    </tr>
                </tbody>
            </table>
            <input name="confirm" type="submit" />
        </form>
    </div>
<?php }

if ($sec == "colors") {
    ?>
    <div class="content">
        <form action="?section=colors&change" method="POST" enctype="multipart/form-data">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Navigationsleistenhintergrundfarbe:</td>
                        <td><input required="" type="color" name="colorNavBarBack" value="<?= $_SESSION["colors"][0] ?>" /></td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>Navigationsleistentextfarbe:</td>
                        <td><input required="" type="color" name="colorNavBarText" value="<?= $_SESSION["colors"][1] ?>" /></td>
                    </tr>
                    <tr>
                        <td>Seitenhintergrundfarbe:</td>
                        <td><input required="" type="color" name="backgroundColor" value="<?= $_SESSION["colors"][2] ?>" /></td>
                    </tr>
                </tbody>
            </table>
            <input name="confirm" type="submit" />
        </form>
    </div>
<?php
}
if ($sec == "lessons") {
    ?>
    
    <div class="content">
        <form action="?section=lessons&change" method="post">
            <table>
                <tr>
                    <th>Fach</th>
                    <th>Auswahl</th>
                </tr>
                <tr>
                    <td>Bildene Kunst</td>
                    <td>
                        <select name="lesson_bk" id="">
                            <option <?= ($lesson_bk == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_bk == 1) ? "selected" : ""; ?> value="1">Gewählt</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Computertechnik</td>
                    <td>
                        <select name="lesson_ct" id="">
                            <option <?= ($lesson_ct == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_ct == 1) ? "selected" : ""; ?> value="1">Videoschnitt</option>
                            <option <?= ($lesson_ct == 2) ? "selected" : ""; ?> value="2">Websiten aufbau</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Seminarkurs</td>
                    <td>
                        <select name="lesson_sk" id="">
                            <option <?= ($lesson_sk == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_sk == 1) ? "selected" : ""; ?> value="1">Gewählt</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Physik/Chemie</td>
                    <td>
                        <select name="lesson_pc" id="">
                            <option <?= ($lesson_pc == 0) ? "selected" : ""; ?> value="0">Physik</option>
                            <option <?= ($lesson_pc == 1) ? "selected" : ""; ?> value="1">Chemie</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Zweite Fremdsprache</td>
                    <td>
                        <select name="lesson_fr" id="">
                            <option <?= ($lesson_fr == 0) ? "selected" : ""; ?> value="0">Nicht gewählt</option>
                            <option <?= ($lesson_fr == 1) ? "selected" : ""; ?> value="1">Spanisch</option>
                            <option <?= ($lesson_fr == 2) ? "selected" : ""; ?> value="2">Französisch</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Religionsunterricht</td>
                    <td>
                        <select name="lesson_re" id="">
                            <option <?= ($lesson_re == 0) ? "selected" : ""; ?> value="0">Ethik</option>
                            <option <?= ($lesson_re == 1) ? "selected" : ""; ?> value="1">Katholisch</option>
                            <option <?= ($lesson_re == 2) ? "selected" : ""; ?> value="2">Evangelisch</option>
                        </select>
                    </td>
                </tr>
                <tr><td><input type="submit" name="confirm"></td></tr>
            </table>
        </form>
    </div>

<?php
}

if ($sec == "timetable") {
    include "timetableSetup.php";
}
?>

