<?php
    $zeiten = array("07:30 - 08:15", "08:15 - 09:00", "09:15 - 10:00", "10:00 - 10:45", "11:00 - 11:45", "11:45 - 12:30", "12:30 - 13:15", "13:15 - 14:00", "14:00 - 14:45", "15:00 - 15:45", "15:45 - 16:30");
    $userConn->query("CREATE TABLE IF NOT EXISTS `timetable_".$_SESSION["userid"]."_g` ( `id` INT NOT NULL AUTO_INCREMENT , `montag` INT , `dienstag` INT , `mittwoch` INT , `donnerstag` INT , `freitag` INT , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    $userConn->query("CREATE TABLE IF NOT EXISTS `timetable_".$_SESSION["userid"]."_u` ( `id` INT NOT NULL AUTO_INCREMENT , `montag` INT , `dienstag` INT , `mittwoch` INT , `donnerstag` INT , `freitag` INT , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    if ($userConn->query("SELECT * FROM timetable_" . $_SESSION["userid"] . "_g") === false) {
        $userConn->query("ALTER TABLE timetable_" . $_SESSION["userid"] . "_g AUTO_INCREMENT = 1");
        $userConn->query("ALTER TABLE timetable_" . $_SESSION["userid"] . "_u AUTO_INCREMENT = 1");
        foreach ($zeiten as $key) {
            $userConn->query("INSERT INTO timetable_" . $_SESSION["userid"] . "_g DEFAULT VALUES");
            $userConn->query("INSERT INTO timetable_" . $_SESSION["userid"] . "_u DEFAULT VALUES");
        }
    }
?>

<style>
    td, th {
        border: 1px solid black;
    }
</style>

<div class="content">
    <form action="setup.php" method="post">
        <table>
            <tr>
                <th>Uhrzeit</th>
                <th>Montag</th>
                <th>Dienstag</th>
                <th>Mittwoch</th>
                <th>Donnerstag</th>
                <th>Freitag</th>
            </tr>
            <?php

            $n = 0;
            foreach ($zeiten as $z) {
                $n++;
                $afafaf = $userConn->query("SELECT * FROM timetable_" . $_SESSION["userid"] . " WHERE id=$n");
                $w = $afafaf->fetch_array();
                for ($i=0; $i < 5; $i++) {
                    $opt = "";
                    
                    switch ($i) {
                        case 0:
                            $mo = "<select class='stunde' name='mo_$n' id='mo_$n'></select>";
                            break;
                        
                        case 1:
                            $di = "<select class='stunde' name='di_$n' id='di_$n'></select>";
                            break;
                        
                        case 2:
                            $mi = "<select class='stunde' name='mi_$n' id='mi_$n'></select>";
                            break;
                        
                        case 3:
                            $do = "<select class='stunde' name='do_$n' id='do_$n'></select>";
                            break;
                        
                        case 4:
                            $fr = "<select class='stunde' name='fr_$n' id='fr_$n'></select>";
                            break;
                        
                        default:
                            echo "ERROR?!";
                            break;
                    }
                }

                ?>
                <tr>
                    <td><?= $z ?></td>
                    <td><?= $mo ?></td>
                    <td><?= $di ?></td>
                    <td><?= $mi ?></td>
                    <td><?= $do ?></td>
                    <td><?= $fr ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </form>
</div>
<script>
    function fachLader(id) {
        while (selector.length > 0) {
            selector.remove(selector.length - 1);
        }
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                selector = document.getElementById(id)
                selector.innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', '/fetchItems.php?id='+<?= $_SESSION["userid"] ?>, true);
        xhr.send(null);
    }

</script>