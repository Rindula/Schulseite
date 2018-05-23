<?php

$name = $_GET["name"];
$klasse= $_GET["klasse"];
$lehrer = $_GET["lehrer"];
$date_von = $_GET["von"];
$date_bis = $_GET["bis"];
$grund = $_GET["grund"];

//select a base image
$rImg = imagecreatefrompng("form.png");
 
//define color
$cor = imagecolorallocate($rImg, 0, 0, 0);


imagettftext($rImg, 40, 0, 620, 280, $cor, "arial.ttf", $name);
imagettftext($rImg, 40, 0, 620, 360, $cor, "arial.ttf", $klasse);
imagettftext($rImg, 40, 0, 940, 360, $cor, "arial.ttf", $lehrer);
imagettftext($rImg, 40, 0, 670, 450, $cor, "arial.ttf", $date_von);
imagettftext($rImg, 40, 0, 1040, 450, $cor, "arial.ttf", $date_bis);
imagettftext($rImg, 40, 0, 230, 570, $cor, "arial.ttf", $grund);
imagettftext($rImg, 40, 0, 1410, 560, $cor, "arial.ttf", $days);
 
//Header output
header('Content-type: image/png');
imagepng($rImg);