<!DOCTYPE html>
<html lang="de">
<?php
//$exitLink = "/hausaufgaben/show";
$needVerify = false;

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
    <style>
        
    </style>
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
<body>
    <div class="container">
        <form action="generate.php" method="get">
            <div class="form-group">
                <label for="name">Name, Vorname</label>
                <input class="form-control" type="text" value="<?= ($loggedIn) ? $_SESSION["nachname"] . ", " . $_SESSION["vorname"] : "" ?>" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="klasse">Klasse</label>
                <input class="form-control" type="text" name="klasse" id="klasse">
            </div>
            <div class="form-group">
                <label for="lehrer">Lehrer</label>
                <input class="form-control" type="text" name="lehrer" id="lehrer">
            </div>
            <div class="form-group">
                <label for="von">Von</label>
                <input class="form-control" type="date" name="von" id="von">
            </div>
            <div class="form-group">
                <label for="bis">Bis</label>
                <input class="form-control" type="date" name="bis" id="bis">
            </div>
            <div class="form-group">
                <label for="grund">Grund</label>
                <input class="form-control" type="text" name="grund" id="grund"></input>
            </div>
            <button type="submit">Formular erstellen</button>
        </form>
    </div>
    <?php include "../_hidden/bottomScripts.php" ?>
</body>
</html>