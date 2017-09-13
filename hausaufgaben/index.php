<?php
//$exitLink = "/hausaufgaben/show";
$needVerify = false;

// Verifikation des Clients
include "../_hidden/verify.php";

// Navigationsleiste
$pageId = 1;
include "../navbar.php";

// Global Header
include "../header.php";

// Benötigte Variablen
include "../_hidden/vars.php";

// CSS Controller
$styles[] = "hausaufgaben";
$styles[] = "lightbox";
include "../css/controller.php";

function is_image($path) {
    $a = getimagesize($path);
    $image_type = $a[2];

    if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
        return true;
    }
    return false;
}

function is_dir_empty($dir) {
    if (!is_readable($dir))
        return NULL;
    $handle = opendir($dir);
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            return FALSE;
        }
    }
    return TRUE;
}
?>
<script>
function callPageH(id)
{
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (xhr.readyState == XMLHttpRequest.DONE) {
        document.getElementById("table_ha").innerHTML = xhr.responseText;
    }
}
xhr.open('GET', 'get_ha.php?q='+id, true);
xhr.send(null);
}

function callPageK(id)
{
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (xhr.readyState == XMLHttpRequest.DONE) {
        document.getElementById("table_ka").innerHTML = xhr.responseText;
    }
}
xhr.open('GET', 'get_ka.php?q='+id, true);
xhr.send(null);
}
</script>
<script type="text/javascript" src="/scripts/lightbox.js"></script>

<body class="Hausaufgaben" onload="callPageH(ha_sel.value); callPageK(ka_sel.value)">
    <div class="legend">
        <fieldset>
            <legend>Farben</legend>
            Bis heute: <div class="rect fertig">&nbsp;</div><br>
            Bis morgen: <div class="rect dringend">&nbsp;</div><br>
            Normale Hausaufgabe: <div class="rect zuErledigen">&nbsp;</div><br>
            Lösung verfügbar: <div class="rect erledigt">&nbsp;</div><br>
        </fieldset>
    </div>
    <div id="content">
<?php
$dbname = "homeworks";
include_once "../_hidden/mysqlconn.php";
?>
        <h1>Hausaufgaben</h1>
        <label for="ha_sel">Fach ausw&auml;hlen: </label>
        <select id="ha_sel" onchange="callPageH(this.value)">
            <?php
            $result2 = $mysqli->query("SELECT * FROM flist ORDER BY fach");
            
            $facher = "";
            $tsel = "";
            
            while ($f = $result2->fetch_assoc()) {
                if ($f["id"] == "-1") {
                    continue;
                }
                $facher .= $f["fach"].",";
                $tsel .= "<option value='".$f["fach"]."'>".$f["fach"]."</option>";
            }
            $facher = substr($facher, 0, -1);
            echo "<option value='$facher'>Alle F&auml;cher</option>";
            echo $tsel;
            ?>
        </select>
        <div id="table_ha"><h1>Entweder hast du Javascript deaktivert, oder ziemlich beschissenes Internet...</h1>
        </div>
        
        <h1>Arbeiten</h1>
        <label for="ka_sel">Fach ausw&auml;hlen: </label>
        <select id="ka_sel" onchange="callPageK(this.value)">
            <?php
            $result2 = $mysqli->query("SELECT * FROM flist ORDER BY fach");
            
            $facher = "";
            $tsel = "";
            
            while ($f = $result2->fetch_assoc()) {
                if ($f["id"] == "-1") {
                    continue;
                }
                $facher .= $f["id"].",";
                $tsel .= "<option value='".$f["id"]."'>".$f["fach"]."</option>";
            }
            $facher = substr($facher, 0, -1);
            echo "<option value='$facher'>Alle F&auml;cher</option>";
            echo $tsel;
            ?>
        </select>
        <div id="table_ka"><h1>Entweder hast du Javascript deaktivert, oder ziemlich beschissenes Internet...</h1>
        </div>
        
    </div>
</body>
