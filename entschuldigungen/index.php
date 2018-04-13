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
        input, textarea {
            box-shadow: none !important;
            background: transparent;
            border: transparent !important;
            resize: none;
        }
    </style>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
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
        });
    </script>
</head>
<body>
    <img style="position: absolute; height: 297mm; width: 210mm" src="form.png" alt="Fehler bei laden des Bildes!">
    <input type="text" value="<?= (loggedIn) ? $_SESSION["nachname"] . ", " . $_SESSION["vorname"] : "" ?>" name="name" id="name" style="position: absolute; top: 31.3mm; left: 80.5mm; width: 11.85cm; height: .95cm; font-size: 18pt;">
    <input type="text" name="klasse" id="klasse" style="text-align: center; position: absolute; top: 41.3mm; left: 80.5mm; width: 4cm; height: .95cm; font-size: 18pt;">
    <input type="text" name="lehrer" id="lehrer" style="position: absolute; top: 41.3mm; left: 120.5mm; width: 7.85cm; height: .95cm; font-size: 18pt;">
    <input type="date" name="von" id="von" style="position: absolute; top: 51.3mm; left: 85.5mm; width: 5.35cm; height: .95cm; font-size: 18pt;">
    <input type="date" name="bis" id="bis" style="position: absolute; top: 51.3mm; left: 135.5mm; width: 5.35cm; height: .95cm; font-size: 18pt;">
    <output name="tage" id="tage" style="position: absolute; top: 51.3mm; left: 185.5mm; width: 5.35cm; height: .95cm; font-size: 18pt;">1</output>
    <textarea name="grund" id="grund" style="position: absolute; top: 67.75mm; left: 27.5mm; width: 17cm; height: 3.3cm; font-size: 18pt;"></textarea>

    <?php include "../_hidden/bottomScripts.php" ?>
</body>
</html>