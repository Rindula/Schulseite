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
 
//define image, font style, location of string, String, color.
imagettftext($rImg, 16, 0, 620, 240, $cor, NULL, $name);
imagettftext($rImg, 16, 0, 620, 330, $cor, NULL, $klasse);
imagettftext($rImg, 16, 0, 940, 330, $cor, NULL, $lehrer);
imagettftext($rImg, 16, 0, 670, 430, $cor, NULL, $date_von);
imagettftext($rImg, 16, 0, 1040, 430, $cor, NULL, $date_bis);
imagettftext($rImg, 16, 0, 230, 550, $cor, NULL, $grund);
imagettftext($rImg, 16, 0, 1410, 540, $cor, NULL, $days);
 
//Header output
header('Content-type: image/png');
imagepng($rImg);