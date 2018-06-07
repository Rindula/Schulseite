<?php
// Takes the String in the Field "name" and gives the Value to $name , Note: "name" is already filled in if the user is logged in.
$name = $_GET["name"];
// Takes the String in the Field "grund" and gives the Value to $grund.
$grund = $_GET["grund"];

// Takes the Dates from the DatePickers.
$date_von = $_GET["von"];
$date_bis = $_GET["bis"];

// Takes the String from the Selected Dropdown Options.
$klasse= $_GET["klasse"];

// Takes the String from the Selected Dropdown Options , Note: the join function seperates the Teachers if multiple are selected with a comma and a space.
$lehrer = join(", ", $_GET["lehrer"]);

function dateDiff($start, $end) {
    $start = new DateTime($start);
    $end = new DateTime($end);
    // Otherwise the end date is excluded (diff = 0).
    $end->modify('+1 day');

    // Calculates the total amount of days not present.
    $days = $end->diff($start)->days;

    // Create an iterateable (repetable) period of date (P1D equates to 1 day).
        // Use: with this we will decrese the total amount of days not present by the amount of days that are Weekends or Holidays.
    $period = new DatePeriod($start, new DateInterval('P1D'), $end);

    // Best stored as array, so you can add more than one.
    $holidays = array();

    foreach($period as $dt) {
        $curr = $dt->format('D');

        // Substract if Saturday or Sunday.
        if ($curr == 'Sat' || $curr == 'Sun') {
            $days--;
        }

        // (Optional) For the updated question.
        elseif (in_array($dt->format('Y-m-d'), $holidays)) {
            $days--;
        }
    }

    // Returns the amount total amount of days not present.
    return $days;
}


// Select a base image (Our standart sickness form).
$rImg = imagecreatefrompng("form.png");
 
// Define color.
$cor = imagecolorallocate($rImg, 0, 0, 0);

// Add the before established Values to all of the Fields.
imagettftext($rImg, 40, 0, 630, 290, $cor, "arial.ttf", $name);
imagettftext($rImg, 40, 0, 680, 370, $cor, "arial.ttf", $klasse);
imagettftext($rImg, 40, 0, 940, 370, $cor, "arial.ttf", $lehrer);
imagettftext($rImg, 40, 0, 680, 450, $cor, "arial.ttf", date("d.m.Y", strtotime($date_von)));
imagettftext($rImg, 40, 0, 1040, 450, $cor, "arial.ttf", date("d.m.Y", strtotime($date_bis)));
imagettftext($rImg, 40, 0, 230, 570, $cor, "arial.ttf", $grund);
imagettftext($rImg, 40, 0, 1410, 440, $cor, "arial.ttf", dateDiff($date_von, $date_bis));
 
// Header output.
header('Content-type: image/png');
imagepng($rImg);
