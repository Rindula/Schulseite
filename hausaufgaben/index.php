<?php
//$exitLink = "/hausaufgaben/show";
$needVerify = false;

// Verifikation des Clients
include "../_hidden/verify.php";

// Navigationsleiste
$page = "hausaufgaben";
include "../navbar.php";

// Global Header
$title="Hausaufgaben";
include "../header.php";

// Benötigte Variablen
include "../_hidden/vars.php";

// CSS Controller
// $styles[] = "hausaufgaben";
$styles[] = "lightbox";
include "../css/controller.php";


?>
<link rel="stylesheet" href="loader.css">
<script>
function callPageH(id)
{
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (xhr.readyState == XMLHttpRequest.DONE) {
        document.getElementById("table_ha").innerHTML = xhr.responseText;
    } else {
        document.getElementById("table_ha").innerHTML = "<ul class=\"drops blue\"><li></li><li></li><li></li><li></li><li></li></ul>";
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
    } else {
        document.getElementById("table_ka").innerHTML = "<ul class=\"drops blue\"><li></li><li></li><li></li><li></li><li></li></ul>";
    }
}
xhr.open('GET', 'get_ka.php?q='+id, true);
xhr.send(null);
}

function addEvent(click) {
    /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
    click.classList.toggle("active");
    /* Toggle between hiding and showing the active panel */
    var panel = click.nextElementSibling;
    panel.classList.toggle("shown");
}
</script>

<body class="" onload="callPageH(ha_sel.value); callPageK(ka_sel.value)">
    <div id="content" class="content">
<?php
$dbname = "homeworks";
include_once "../_hidden/mysqlconn.php";
?>
        <h1 class="display-4">Hausaufgaben</h1>
        <div class="input-group">
        <span class="input-group-addon fa fa-book"></span>
        <select id="ha_sel" class="form-control" onchange="callPageH(this.value)">
            <?php
            $result2 = $mysqli->query("SELECT * FROM flist ORDER BY fach");
            
            $tsel = "";
            
            while ($f = $result2->fetch_assoc()) {
                if ($f["id"] == "-1") {
                    continue;
                }
                $tsel .= "<option value='".$f["id"]."'>".$f["fach"]."</option>";
            }
            echo "<option value='all'>Alle F&auml;cher</option>";
            echo $tsel;
            ?>
        </select>
        </div>
        <div id="table_ha"><h1>Entweder hast du Javascript deaktivert, oder ziemlich beschissenes Internet...</h1>
        </div>
        
        <h1 class="display-4">Arbeiten</h1>
        <div class="input-group">
        <span class="input-group-addon fa fa-book"></span>
        <select id="ka_sel" class="form-control" onchange="callPageK(this.value)">
            <?php
            $result2 = $mysqli->query("SELECT * FROM flist ORDER BY fach");
            
            $tsel = "";
            
            while ($f = $result2->fetch_assoc()) {
                if ($f["id"] == "-1") {
                    continue;
                }
                $tsel .= "<option value='".$f["id"]."'>".$f["fach"]."</option>";
            }
            echo "<option value='all'>Alle F&auml;cher</option>";
            echo $tsel;
            ?>
        </select>
        </div>
        <div id="table_ka"><h1>Entweder hast du Javascript deaktivert, oder ziemlich beschissenes Internet...</h1>
        </div>
    </div>
    <?php include "../_hidden/bottomScripts.php" ?>
</body>
