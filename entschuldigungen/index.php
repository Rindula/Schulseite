<!DOCTYPE html>
<html lang="de">
<?php
//$exitLink = "/hausaufgaben/show";
$needVerify = true;

// Verifikation des Clients
include "../_hidden/verify.php";

// Navigationsleiste
$page = "entschuldigungen";
include "../navbar.php";

// Global Header
$title="Entschuldigungen";
include "../header.php";

// Benötigte Variablen
include "../_hidden/vars.php";

// CSS Controller
include "../css/controller.php";


?>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.15.0/slimselect.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.15.0/slimselect.min.css" rel="stylesheet"></link>

    <script>
        const setup = () => {
            let firstDate = $('#von').val();
            let secondDate = $('#bis').val();
            if (firstDate === undefined || secondDate === undefined) {
                return 0;
            }
            const findTheDifferenceBetweenTwoDates = (firstDate, secondDate) => {
            firstDate = new Date(firstDate);
                secondDate = new Date(secondDate);
                
                let timeDifference = Math.abs(secondDate.getTime() - firstDate.getTime());
                
                let millisecondsInADay = (1000 * 3600 * 24);
                
                let differenceOfDays = Math.ceil(timeDifference / millisecondsInADay);
                
                return differenceOfDays + 1;
                
            }
            
            let result = findTheDifferenceBetweenTwoDates(firstDate, secondDate);
            $("#tage").text(result);
            
            
        }

        $(document).ready(function () {
            $('#von, #bis').on("change", function () {
                setup();
            })
            setup();
        });
    </script>
</head>
<body class="container">
    <form action="generate.php" method="get">
        <div class="form-group">
            <label for="name">Name, Vorname</label>
            <input required class="form-control" type="text" value="<?= ($loggedIn) ? $_SESSION["nachname"] . ", " . $_SESSION["vorname"] : "" ?>" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="klasse">Klasse</label>
            <select required class="form-control" name="klasse" id="klasse">
                <option value="" disabled selected>=== Bitte auswählen ===</option>
                <optgroup label="Eingangsklasse">
                    <option value="E1">E1</option>
                    <option value="E2">E2</option>
                </optgroup>
                <optgroup label="J1">
                    <option value="J1/1">J1/1</option>
                    <option value="J1/2">J1/2</option>
                    <option value="J1/3">J1/3</option>
                </optgroup>
                <optgroup label="J2">
                    <option value="J2/1">J2/1</option>
                    <option value="J2/2">J2/2</option>
                    <option value="J2/3">J2/3</option>
                </optgroup>
            </select>
        </div>
        <div class="form-group">
            <label for="lehrer">Lehrer</label>
            <select required multiple class="text-dark" placeholder="Lehrer auswählen" name="lehrer[]" id="lehrer">
                <optgroup label="Männlich">
                    <?php
                    list($user, $pass) = array('root', '74cb0A0kER');
                    $dbh = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);
                    $dbh->query("SET NAMES utf8");
                    
                    foreach ($dbh->query('SELECT name FROM lehrer WHERE geschlecht = "m" ORDER BY name') as $row) {
                        echo "<option value='Hr. ".$row["name"]."'>Hr. ".$row["name"]."</option>";
                    }
                    ?>
                </optgroup>
                <optgroup label="Weiblich">
                    <?php
                    foreach ($dbh->query('SELECT name FROM lehrer WHERE geschlecht = "w" ORDER BY name') as $row) {
                        echo "<option value='Fr. ".$row["name"]."'>Fr. ".$row["name"]."</option>";
                    }
                    $dbh = NULL;
                    ?>
                </optgroup>
            </select>
            <script>
                new SlimSelect({
                    select: '#lehrer'
                })
            </script>
        </div>
        <div class="form-group">
            <label for="von">Von</label>
            <input required class="form-control" type="date" name="von" id="von">
        </div>
        <div class="form-group">
            <label for="bis">Bis</label>
            <input required class="form-control" type="date" name="bis" id="bis">
        </div>
        <div class="form-group">
            <label for="grund">Grund</label>
            <input required class="form-control" type="text" name="grund" id="grund"></input>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-info" type="submit" formaction="print.php">Formular drucken</button><button class="btn btn-secondary" type="submit">Formular anzeigen</button>
        </div>
    </form>
    <?php include "../_hidden/bottomScripts.php" ?>
</body>
</html>