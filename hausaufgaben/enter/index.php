<?php
$needVerify = true;
$exitLink = "/hausaufgaben";
$title = "Verwaltung";

// Verifikation des Clients
include "../../_hidden/verify.php";

// Navigationsleiste
$page = "enter";
include "../../navbar.php";

// Global Header
$title = "Eintragen - Hausaufgaben";
include "../../header.php";

// Benötigte Variablen
include "../../_hidden/vars.php";

// CSS Controller
include "../../css/controller.php";
?>

<script language="JavaScript">
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

    $(":submit").click(function() {
        $(this).parent("form").submit();
        $(this).parent("form").reset();

        if ($(this).parent("form").attr("enter-type") == "ha") {
            $("#ha_alert").alert();
        }

        if ($(this).parent("form").attr("enter-type") == "ka") {
            $("#ha_alert").alert();            
        }
    });

</script>
<?php
$dbname = "homeworks";
include "../../_hidden/mysqlconn.php";
?>
<div id="content">

    <table class="table">
        <?php
        $result = $userConn->query("SELECT * from groups WHERE id = $gruppe");
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

        ?>
        <tr>
            <?php
            if ($canEnter) {
                ?>
                <td>
                    <h1 class="display-4">Hausaufgaben eintragen</h1>
                    <form enter-type="ha" class="form" target="_blank" action="../../_hidden/enterHW.php" method="post">
                        <input type="hidden" value="0" name="type"/>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-book"></span>
                        <select class="form-control" required id="fach" name="fach">
                            <option selected disabled>--- Fach Auswählen ---</option>
                            <?php
                            $sql = "SELECT * FROM flist ORDER BY fach Asc";
                            $statement = $mysqli->prepare($sql);
                            $statement->execute();
                            $result = $statement->get_result();
                            while ($ar = $result->fetch_assoc()) {
                                if ($ar["profil"] > 0) {
                                    echo '<option value="' . $ar["id"] . '">' . $ar["fach"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        </div>
                        <br>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-edit"></span>
                        <textarea class="form-control" required id="aufgaben" name="aufgaben"></textarea>
                        </div>
                        <br>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-calendar"></span>
                        <input class="form-control" required type="date" id="datum" name="datum" min="<?php echo date('Y-m-d'); ?>" />
                        </div><br>
                        <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">Eintragen</button>
                        <button class="btn btn-outline-secondary" type="reset">Felder leeren</button>
                        </div>
                    </form>
                </td>
                <?php
            }
            if ($canChange) {
                ?>
                <td>
                    <h1 class="display-4">Hausaufgaben ändern</h1>
                    <form class="form" target="_blank" action="../../_hidden/enterHW.php" method="post">
                        <input type="hidden" value="3" name="type"/>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-book"></span>
                        <select class="form-control" onchange="update2()" required id="fach3" name="fach">
                            <option selected disabled>--- Aufgabe Auswählen ---</option>
                            <?php
                            $sql = "SELECT h.Datum, h.Aufgaben, h.ID, f.fach FROM list as h inner join flist as f on h.Fach = f.id ORDER BY Datum Asc";
                            $statement = $mysqli->prepare($sql);
                            $statement->execute();
                            $result = $statement->get_result();
                            while ($ar = $result->fetch_assoc()) {

                                $today = strtotime(date("Y-m-d"));
                                $expiration_date = strtotime($ar["Datum"]);
                                if ($expiration_date < $today) {
                                    continue;
                                }

                                echo '<option zielDatum="' . $ar["Datum"] . '" topic="' . htmlspecialchars($ar["Aufgaben"]) . '" value="' . $ar["ID"] . '">' . $ar["fach"] . ' | ' . $ar["Datum"] . '</option>';
                            }
                            ?>
                        </select></div><br>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-edit"></span>
                        <textarea class="form-control" required id="aufgaben3" name="aufgaben"></textarea>
                        </div><br>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-calendar"></span>
                        <input class="form-control" required type="date" id="datum3" name="datum" min="<?php echo date('Y-m-d'); ?>" />
                        </div><br>
                        <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">Ändern</button>
                        </div>
                    </form>
                </td></tr>
            <?php
        }
        if ($canEnter) {
            ?>
            <tr><td>
                    <h1 class="display-4">Arbeiten eintragen</h1>
                    <form enter-type="ka" class="form" target="_blank" action="../../_hidden/enterHW.php" method="post">
                        <input type="hidden" value="1" name="type"/>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-book"></span>
                        <select class="form-control" required id="fach" name="fach">
                            <option selected disabled>--- Fach Auswählen ---</option>
                            <?php
                            $sql = "SELECT * FROM flist ORDER BY fach Asc";
                            $statement = $mysqli->prepare($sql);
                            $statement->execute();
                            $result = $statement->get_result();
                            while ($ar = $result->fetch_assoc()) {
                                if ($ar["profil"] > 0) {
                                    echo '<option value="' . $ar["id"] . '">' . $ar["fach"] . '</option>';
                                }
                            }
                            ?>
                        </select></div><br>
                        
                        <div class="input-group">
                        <span class="input-group-addon fa fa-edit"></span>
                        <textarea class="form-control" id="aufgaben" name="aufgaben"></textarea>
                        </div><br>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-calendar"></span>
                        <input class="form-control" required type="date" id="datum" name="datum" min="<?php echo date('Y-m-d'); ?>" />
                        </div><br>
                        <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">Eintragen</button>
                        <button class="btn btn-outline-secondary" type="reset">Felder leeren</button>
                        </div>
                    </form>
                </td>
                <?php
            }
            if ($canChange) {
                ?>
                <td>
                    <h1 class="display-4">Arbeitthema ändern</h1>
                    <form class="form" target="_blank" action="../../_hidden/enterHW.php" method="post">
                        <input type="hidden" value="2" name="type"/>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-book"></span>
                        <select class="form-control" onchange="update()" required id="fach2" name="fach">
                            <option selected disabled>--- Arbeit Auswählen ---</option>
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
                                        echo '<option zielDatum="' . $ar["datum"] . '" topic="' . htmlspecialchars($ar["themen"]) . '" value="' . $ar["id"] . '">' . $ar2["fach"] . ' | ' . $ar["datum"] . '</option>';
                                        break;
                                    }
                                }
                            }
                            ?>
                        </select></div><br>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-edit"></span>
                        <textarea class="form-control" id="aufgaben2" name="aufgaben"></textarea>
                        </div><br>
                        <div class="input-group">
                        <span class="input-group-addon fa fa-calendar"></span>
                        <input class="form-control" required type="date" id="datum2" name="datum" min="<?php echo date('Y-m-d'); ?>" />
                        </div><br>
                        <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">Ändern</button>
                        </div>
                    </form>
                </td></tr>
            <?php
        }
        ?>
    </table>
</div>
<?php include "../../_hidden/bottomScripts.php" ?>