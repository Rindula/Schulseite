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
    ul li a {
        text-decoration: none;
        color: black;
        display: inline-block;
        background-color: #ff6666;
        padding: 10px;
        margin: 10px;
        transition: 0.2s all linear;
    }
    ul li a:hover {
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
    // $userConn->query("UPDATE users SET navbarBack = '" . $_POST["colorNavBarBack"] . "', navbarText = '" . $_POST["colorNavBarText"] . "', backgroundPage = '" . $_POST["backgroundColor"] . "' WHERE id = '" . $_SESSION["userid"] . "'");
    echo "<code>Stunden werden übernommen...</code>";
}

if (isset($_GET["change"])) {
    echo '<meta http-equiv="refresh" content="3; URL=?section=' . $_GET["section"] . '">';
}

$sec = $_GET["section"];


if ($sec == "main") {
    ?>
    <div class="content">
        <h1>Einstellungen<br><small>Willkommen, <?= $_SESSION["name"] ?></small></h1>
        <ul style="list-style-type: none;">
            <li><a style="" href="?section=passwort">Passwort ändern</a></li>
            <li><a style="" href="?section=colors">Farben ändern</a></li>
            <!-- <li><a style="" href="?section=lessons">Fächer einstellen</a></li> -->
        </ul>
    </div>
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
                        <select name="lesson_bk" id="" disabled="disabled">
                            <option value="0">Nicht gewählt</option>
                            <option value="1">Gewählt</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Computertechnik</td>
                    <td>
                        <select name="lesson_ct" id="" disabled="disabled">
                            <option value="0">Nicht gewählt</option>
                            <option value="1">Videoschnitt</option>
                            <option value="1">Websiten aufbau</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Seminarkurs</td>
                    <td>
                        <select name="lesson_sk" id="" disabled="disabled">
                            <option value="0">Nicht gewählt</option>
                            <option value="1">Gewählt</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Physik/Chemie</td>
                    <td>
                        <select name="lesson_pc" id="" disabled="disabled">
                            <option value="0">Physik</option>
                            <option value="1">Chemie</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Zweite Fremdsprache</td>
                    <td>
                        <select name="lesson_fr" id="" disabled="disabled">
                            <option value="0">Nicht gewählt</option>
                            <option value="1">Spanisch</option>
                            <option value="2">Französisch</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Religionsunterricht</td>
                    <td>
                        <select name="lesson_re" id="" disabled="disabled">
                            <option value="0">Ethik</option>
                            <option value="1">Katholisch</option>
                            <option value="2">Evangelisch</option>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
    </div>

<?php 

} 
?>

