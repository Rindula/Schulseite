<?php
    $zeiten = array("07:30 - 08:15", "08:15 - 09:00", "09:15 - 10:00", "10:00 - 10:45", "11:00 - 11:45", "11:45 - 12:30", "12:30 - 13:15", "13:15 - 14:00", "14:00 - 14:45", "15:00 - 15:45", "15:45 - 16:30");
    $userConn->query("CREATE TABLE IF NOT EXISTS `timetable_".$_SESSION["userid"]."` ( `id` INT NOT NULL AUTO_INCREMENT , `montag` INT , `dienstag` INT , `mittwoch` INT , `donnerstag` INT , `freitag` INT , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    if ($userConn->query("SELECT * FROM timetable_" . $_SESSION["userid"] . " WHERE id=$n") === false) {
        $userConn->query("ALTER TABLE timetable_" . $_SESSION["userid"] . " AUTO_INCREMENT = 1");
        foreach ($zeiten as $key) {
            $userConn->query("INSERT INTO timetable_" . $_SESSION["userid"] . " DEFAULT VALUES");
        }
    }
?>

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
                $we = $afafaf->fetch_array();
                $i = 0;
                foreach ($woche as $w) {
                    switch ($i) {
                        case 0:
                            $mo = $w[$i];
                            break;
                        
                        case 1:
                            $di = $w[$i];
                            break;
                        
                        case 2:
                            $mi = $w[$i];
                            break;
                        
                        case 3:
                            $do = $w[$i];
                            break;
                        
                        case 4:
                            $fr = $w[$i];
                            break;
                        
                        default:
                            echo "ERROR?!";
                            break;
                    }
                    $i++;
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
