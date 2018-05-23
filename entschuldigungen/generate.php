<?php

$name = $_GET["name"];
$klasse= $_GET["klasse"];
$lehrer = $_GET["lehrer"];
$date_von = $_GET["von"];
$date_bis = $_GET["bis"];
$grund = $_GET["grund"];


function dateDiff($start, $end) {
    $start = new DateTime($start);
    $end = new DateTime($end);
    // otherwise the  end date is excluded (diff = 0)
    $end->modify('+1 day');

    $interval = $end->diff($start);

    // total days
    $days = $interval->days;

    // create an iterateable period of date (P1D equates to 1 day)
    $period = new DatePeriod($start, new DateInterval('P1D'), $end);

    // best stored as array, so you can add more than one
    $holidays = array();

    foreach($period as $dt) {
        $curr = $dt->format('D');

        // substract if Saturday or Sunday
        if ($curr == 'Sat' || $curr == 'Sun') {
            $days--;
        }

        // (optional) for the updated question
        elseif (in_array($dt->format('Y-m-d'), $holidays)) {
            $days--;
        }
    }


    return $days;
}


//select a base image
$rImg = imagecreatefrompng("form.png");
 
//define color
$cor = imagecolorallocate($rImg, 0, 0, 0);


imagettftext($rImg, 40, 0, 620, 280, $cor, "arial.ttf", $name);
imagettftext($rImg, 40, 0, 620, 360, $cor, "arial.ttf", $klasse);
imagettftext($rImg, 40, 0, 940, 360, $cor, "arial.ttf", $lehrer);
imagettftext($rImg, 40, 0, 670, 450, $cor, "arial.ttf", date("d.m.Y", strtotime($date_von)));
imagettftext($rImg, 40, 0, 1040, 450, $cor, "arial.ttf", date("d.m.Y", strtotime($date_bis)));
imagettftext($rImg, 40, 0, 230, 570, $cor, "arial.ttf", $grund);
imagettftext($rImg, 40, 0, 1410, 560, $cor, "arial.ttf", dateDiff($date_von, $date_bis));
 
//Header output
header('Content-type: image/png');
imagepng($rImg);