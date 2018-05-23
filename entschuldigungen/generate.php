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


imagettftext($rImg, 16, 0, 620, 240, $cor, "arial.ttf", $name);
imagettftext($rImg, 16, 0, 620, 330, $cor, "arial.ttf", $klasse);
imagettftext($rImg, 16, 0, 940, 330, $cor, "arial.ttf", $lehrer);
imagettftext($rImg, 16, 0, 670, 430, $cor, "arial.ttf", $date_von);
imagettftext($rImg, 16, 0, 1040, 430, $cor, "arial.ttf", $date_bis);
imagettftext($rImg, 16, 0, 230, 550, $cor, "arial.ttf", $grund);
imagettftext($rImg, 16, 0, 1410, 540, $cor, "arial.ttf", $days);
 
//Header output
header('Content-type: image/png');
imagepng($rImg);