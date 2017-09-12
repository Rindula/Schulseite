<?php

include "functions.php";

function masterconnect(){

global $dbcon;
$dbcon = mysqli_connect('localhost', 'arma3', '{x}E{7#t=d!mq{kgLU!p', 'altislife') or die ('Database connection failed');
}

function loginconnect(){

global $dbconL;
$dbconL = mysqli_connect('localhost', 'arma3', '{x}E{7#t=d!mq{kgLU!p', 'altislife');
}

function Rconconnect(){

global $rcon;
$rcon = new \Nizarii\ArmaRConClass\ARC('213.202.252.221', 2309, 'pat@D7phu6pE');
}

global $DBHost;
$DBHost = 'localhost';
global $DBUser;
$DBUser = 'arma3';
global $DBPass;
$DBPass = '{x}E{7#t=d!mq{kgLU!p';
global $DBName;
$DBName = 'altislife';

global $RconHost;
$RconHost = '213.202.252.221';
global $RconPort;
$RconPort = 2309;
global $RconPass;
$RconPass = 'pat@D7phu6pE';

global $maxCop;
$maxCop = 7;
global $maxMedic;
$maxMedic = 5;
global $maxAdmin;
$maxAdmin = 3;
global $maxDonator;
$maxDonator = 5;

global $apiUser;
$apiUser = 'default';
global $apiPass;
$apiPass = '5';
global $apiEnable;
$apiEnable = 0;

?>
