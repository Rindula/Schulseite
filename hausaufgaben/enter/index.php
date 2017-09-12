<?php
$needVerify = true;
$exitLink = "/hausaufgaben";
$title = "Verwaltung";

// Verifikation des Clients
include "../../_hidden/verify.php";

// Navigationsleiste
$pageId = 6;
include "../../navbar.php";

// Global Header
include "../../header.php";

// Benötigte Variablen
include "../../_hidden/vars.php";

// CSS Controller
include "../../css/controller.php";
?>

<style>
    html {
        background-color: #5a5a5a;
        color: white;
    }

    form, h1 {
        text-align: center;
    }

    h1 {
        color: #f47316;
    }

    #uhr { position:fixed; bottom:10px; right:10px; font-family:monospace; font-size:34px; color:#00ffff; text-shadow: 0 0 5px #a6ffff; background-color: #5914dc; padding: 10px; border-radius: 10px}

    #content {
        margin-bottom: 100px;
    }


</style>
<script language="JavaScript">

    var interval = window.setInterval("uhr_anzeigen()", 10);

    function uhr_anzeigen() {
        var Datum = new Date();
        var stunde = Datum.getHours();
        var minute = Datum.getMinutes();
        var sekunde = Datum.getSeconds();

        Zeit = ((stunde < 10) ? " 0" : " ") + stunde;
        Zeit += ((minute < 10) ? ":0" : ":") + minute;
        Zeit += ((sekunde < 10) ? ":0" : ":") + sekunde;
        Zeit += " Uhr";

        document.getElementById('uhr').innerHTML = Zeit;
    }

    function update() {
        var textBox = document.getElementById("aufgaben2");
        var dropDown = document.getElementById("fach2");
        var dateField = document.getElementById("datum2");

        textBox.value = dropDown.options[dropDown.selectedIndex].getAttribute("topic");
                dateField.value = dropDown.options[dropDown.selectedIndex].getAttribute("zielDatum");

    }

    function update2() {
        var textBox = document.getElementById("aufgaben3");
        var dropDown = document.getElementById("fach3");
        var dateField = document.getElementById("datum3");

        textBox.value = dropDown.options[dropDown.selectedIndex].getAttribute("topic");
                dateField.value = dropDown.options[dropDown.selectedIndex].getAttribute("zielDatum");

    }

    window.onload = function () {
        update();
        update2();
    }

</script>

<div id="uhr">&nbsp;</div>
<?php
$dbname = "homeworks";
include "../../_hidden/mysqlconn.php";
?>
<div id="content">
    <table class="center">
        <?php
        $result = $userConn->query("SELECT * from groups WHERE id = " . $_SESSION["group"]);
        $perms = $result->fetch_assoc();

        if ($perms["canEnter"] == 1) {
            $canEnter = true;
        } else {
            $canEnter = false;
        }

        if ($perms["canChange"] == 1) {
            $canChange = true;
        } else {
            $canChange = false;
        }

        if ($perms["typ"] == "it") {
            $allowed = array("1", "2");
        }
        if ($perms["typ"] == "tum") {
            $allowed = array("1", "3");
        }
        if ($perms["typ"] == "all") {
            $allowed = array("1", "2", "3");
        }
        ?>
        <tr>
            <?php
            if ($canEnter) {
                ?>
                <td>
                    <h1>Hausaufgaben eintragen</h1>
                    <form action="../../_hidden/enterHW.php" method="post">
                        <input type="hidden" value="0" name="type"/>
                        <label for="fach">Fach:</label>
                        <select required id="fach" name="fach">
                            <?php
                            $sql = "SELECT * FROM flist ORDER BY fach Asc";
                            $statement = $mysqli->prepare($sql);
                            $statement->execute();
                            $result = $statement->get_result();
                            while ($ar = $result->fetch_assoc()) {
                                if (in_array($ar["profil"], $allowed)) {
                                    echo '<option value="' . $ar["fach"] . '">' . $ar["fach"] . '</option>';
                                }
                            }
                            ?>
                        </select><br><br>
                        <label for="aufgaben">Aufgaben:</label>
                        <textarea required id="aufgaben" name="aufgaben"></textarea><br><br>
                        <label for="datum">Zieldatum:</label>
                        <input required type="date" id="datum" name="datum" min="<?php echo date('Y-m-d'); ?>" /><br><br><br>
                        <button type="submit" formtarget="_blank">Eintragen</button>
                    </form>
                </td>
                <?php
            }
            if ($canChange) {
                ?>
                <td>
                    <h1>Hausaufgaben ändern</h1>
                    <form action="../../_hidden/enterHW.php" method="post">
                        <input type="hidden" value="3" name="type"/>
                        <label for="fach3">Arbeit:</label>
                        <select onchange="update2()" required id="fach3" name="fach">
                            <?php
                            $sql = "SELECT * FROM list ORDER BY Datum Asc";
                            $statement = $mysqli->prepare($sql);
                            $statement->execute();
                            $result = $statement->get_result();
                            while ($ar = $result->fetch_assoc()) {

                                $today = strtotime(date("Y-m-d"));
                                $expiration_date = strtotime($ar["Datum"]);
                                if ($expiration_date < $today) {
                                    continue;
                                }

                                echo '<option zielDatum="' . $ar["Datum"] . '" topic="' . $ar["Aufgaben"] . '" value="' . $ar["ID"] . '">' . $ar["Fach"] . ' | ' . $ar["Datum"] . '</option>';
                            }
                            ?>
                        </select><br><br>
                        <label for="aufgaben3">Themen:</label>
                        <textarea id="aufgaben3" name="aufgaben"></textarea><br><br>
                        <label for="datum3">Datum:</label>
                        <input required type="date" id="datum3" name="datum" /><br><br><br>
                        <button type="submit" formtarget="_blank">Eintragen</button>
                    </form>
                </td></tr>
            <?php
        }
        if ($canEnter) {
            ?>
            <tr><td>
                    <h1>Arbeiten eintragen</h1>
                    <form action="../../_hidden/enterHW.php" method="post">
                        <input type="hidden" value="1" name="type"/>
                        <label for="fach">Fach:</label>
                        <select required id="fach" name="fach">
                            <?php
                            $sql = "SELECT * FROM flist ORDER BY fach Asc";
                            $statement = $mysqli->prepare($sql);
                            $statement->execute();
                            $result = $statement->get_result();
                            while ($ar = $result->fetch_assoc()) {
                                if (in_array($ar["profil"], $allowed)) {
                                    echo '<option value="' . $ar["id"] . '">' . $ar["fach"] . '</option>';
                                }
                            }
                            ?>
                        </select><br><br>
                        <label for="aufgaben">Themen:</label>
                        <textarea id="aufgaben" name="aufgaben"></textarea><br><br>
                        <label for="datum">Datum:</label>
                        <input required type="date" id="datum" name="datum" min="<?= date('Y-m-d') ?>" /><br><br><br>
                        <button type="submit" formtarget="_blank">Eintragen</button>
                    </form>
                </td>
                <?php
            }
            if ($canChange) {
                ?>
                <td>
                    <h1>Arbeitthema ändern</h1>
                    <form action="../../_hidden/enterHW.php" method="post">
                        <input type="hidden" value="2" name="type"/>
                        <label for="fach2">Arbeit:</label>
                        <select onchange="update()" required id="fach2" name="fach">
                            <?php
                            $sql = "SELECT * FROM arbeiten ORDER BY datum Asc";
                            $statement = $mysqli->prepare($sql);
                            $statement->execute();
                            $result = $statement->get_result();
                            while ($ar = $result->fetch_assoc()) {
                                $today = strtotime(date("Y-m-d"));
                                $expiration_date = strtotime($ar["datum"]);
                                if ($expiration_date < $today) {
                                    continue;
                                }
                                $sql2 = "SELECT * FROM flist ORDER BY fach Asc";
                                $statement2 = $mysqli->prepare($sql2);
                                $statement2->execute();
                                $result2 = $statement2->get_result();
                                while ($ar2 = $result2->fetch_assoc()) {
                                    if ($ar["fach"] == $ar2["id"]) {
                                        echo '<option zielDatum="' . $ar["datum"] . '" topic="' . $ar["themen"] . '" value="' . $ar["id"] . '">' . $ar2["fach"] . ' | ' . $ar["datum"] . '</option>';
                                        break;
                                    }
                                }
                            }
                            ?>
                        </select><br><br>
                        <label for="aufgaben2">Themen:</label>
                        <textarea id="aufgaben2" name="aufgaben"></textarea><br><br>
                        <label for="datum2">Datum:</label>
                        <input required type="date" id="datum2" name="datum" /><br><br><br>
                        <button type="submit" formtarget="_blank">Eintragen</button>
                    </form>
                </td></tr>
            <?php
        }
        ?>
    </table>
</div>