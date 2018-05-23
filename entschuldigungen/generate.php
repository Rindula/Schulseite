<?php

$name = $_GET["name"];
$klasse= $_GET["klasse"];
$lehrer = $_GET["lehrer"];
$date_von = $_GET["von"];
$date_bis = $_GET["bis"];
$grund = $_GET["grund"];

//select a base image
$rImg = ImageCreateFromPNG("form.png");
 
//define color
$cor = imagecolorallocate($rImg, 255, 255, 255);
 
//define image, font style, location of string, String, color.
imagestring($rImg,5,620,240,$name,$cor);
imagestring($rImg,5,620,240,$klasse,$cor);
imagestring($rImg,5,620,240,$lehrer,$cor);
imagestring($rImg,5,620,240,$date_von,$cor);
imagestring($rImg,5,620,240,$date_bis,$cor);
imagestring($rImg,5,620,240,$grund,$cor);
imagestring($rImg,5,620,240,$days,$cor);
 
//Header output
header('Content-type: image/jpeg');
imagejpeg($rImg,NULL,100);