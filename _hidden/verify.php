<?php
//set cookie lifetime for 100 days (60sec * 60mins * 24hours * 1000days)
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 1000);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 1000);
session_start();

//$now = time();
//if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
//    session_unset();
//    session_destroy();
//    session_start();
//}
//
//$_SESSION['discard_after'] = $now + 3600;

function showErrors() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

showErrors();

if (!isset($needVerify)) {
    $needVerify = true;
}

if ($needVerify && !isset($_SESSION['userid'])) {
    if (isset($exitLink)) {
        die("<meta http-equiv='refresh' content='0; $exitLink'>");
    } else {
        die("<meta http-equiv='refresh' content='2; /login'><h1 style=\"cursor: pointer;\" title=\"Zum Login...\" onclick=\"location.assign('/login')\">Du musst eingeloggt sein, um auf diese Seite zugreifen zu dürfen!</h1>");
    }
}

if ($_SESSION["group"] == "4" && $vLevel == 1) {
    header('HTTP/1.1 403 Forbidden');
    die();
}

$_SESSION['url'] = $_SERVER['REQUEST_URI'];


if (!isset($_SESSION['userid'])) {
    $loggedIn = false;
} else {
    $loggedIn = true;
}


$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

function getOS() { 

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}


$user_os        =   getOS();
$user_browser   =   getBrowser();


if ($loggedIn) {
    // Gruppe
    $sbvfdyvyd = new mysqli("localhost", "root", "74cb0A0kER", "stats");
    $sbvfdyvyd->query("SET NAMES 'utf8'");
    $ret = $sbvfdyvyd->query("SELECT gruppe FROM users WHERE id = '".$_SESSION["userid"]."'");
    $r = $ret->fetch_assoc();
    $gruppe = $r["gruppe"];

    // Wahlfächer
    $ret = $sbvfdyvyd->query("SELECT bk,ct,pc,re,fr,sk FROM users WHERE id = '".$_SESSION["userid"]."'");
    list($bk, $ct, $pc, $re, $fr, $sk) = $ret->fetch_array();

    $bks = ($bk == 0) ? "" : "Bildende Kunst";
    $cts = ($ct == 0) ? "" : "Computertechnik";
    if ($fr == 0) {
        $frs = "";
    } elseif ($fr == 1) {
        $frs = "Spanisch";
    } else {
        $frs = "Französisch";
    }
    $pcs = ($pc == 0) ? "Physik" : "Chemie";
    $res = ($re == 0) ? "Ethik" : "Religion";
    $sks = ($sk == 0) ? "" : "Seminarkurs";
}

// Access Logging
$date = new DateTime();
$date = $date->format("d.m.Y H:i:s");
$logText = "[".$date."] Zugriff von ".$_SERVER['REMOTE_ADDR']." auf ".$_SERVER['REQUEST_URI']." | OS: ".$user_os." | Browser: ".$user_browser;

$fpLog = fopen($_SERVER['DOCUMENT_ROOT']."/log/accesslog_" . date("Y-m-d") . ".txt", 'a');
fwrite($fpLog, $logText . "\n");
fclose($fpLog);
