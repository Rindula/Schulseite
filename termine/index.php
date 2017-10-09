<?php
    //$exitLink = "/hausaufgaben/show";
    $needVerify = false;

    // Verifikation des Clients
	include "../_hidden/verify.php";
	
    // Navigationsleiste
    $pageId = 4;
	include "../navbar.php";

    // Global Header
	include "../header.php";

    // Benötigte Variablen
	include "../_hidden/vars.php";

    // CSS Controller
    $styles[] = "termine";
    include "../css/controller.php";


    $dbname = "homeworks";
    include "../_hidden/mysqlconn.php";

?>
        <h1>Termine</h1>
        <table>
            <thead>
                <th>Raum</th>
                <th>Termin</th>
                <th>Datum</th>
                <th>Uhrzeit</th>
            </thead>
            <tbody>
<?php
        $sql = "SELECT * FROM termine ORDER BY datum Asc";
        $result = $mysqli->query($sql);
                $cnt = 0;
    while ($ar = $result->fetch_assoc()) 
    {        
        list($date, $time) = explode(" ", $ar["datum"]);
        list($hour,$minute,$second) = explode(":", $time);
        $today = strtotime(date("Y-m-d"));
        $expiration_date = strtotime($date);
        list($year, $month, $day) = explode("-", $date);
        if ($expiration_date < $today) {
            continue;
        }
        
        if ($expiration_date < $today + (2*60*60*24)) {
            $classes = "dringend";
        }
        $title = $ar["raum"];
        echo "<tr title='$title' id='".$ar['id']."' class='$classes'>";


        $datetime1 = date_create(date("Y-m-d"));
        $datetime2 = date_create($date);
        $interval = date_diff($datetime1, $datetime2);
        if ($interval->format('%a') == "1") {
            $days = $interval->format('%a Tag');
        } else {
            $days = $interval->format('%a Tage');
        }

        echo "<td>".$ar["raum"]."</td>";
        echo "<td>".$ar["typ"]."</td>";
        echo "<td>$day.$month.$year ($days)</td>";
        echo "<td>$hour:$minute Uhr</td>";
        echo "</tr>";
        $cnt++;
    }
?>

            </tbody>
        </table>