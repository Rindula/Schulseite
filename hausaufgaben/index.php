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
// $styles[] = "hausaufgaben";
$styles[] = "lightbox";
include "../css/controller.php";


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

function addEvent(click) {
    /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
    click.classList.toggle("active");
    /* Toggle between hiding and showing the active panel */
    var panel = click.nextElementSibling;
    panel.classList.toggle("shown");
}
</script>
<script type="text/javascript" src="/scripts/lightbox.js"></script>

<body class="" onload="callPageH(ha_sel.value); callPageK(ka_sel.value)">
    <div id="content">
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
            
            $facher = "";
            $tsel = "";
            
            while ($f = $result2->fetch_assoc()) {
                if ($f["id"] == "-1") {
                    continue;
                }
                $tsel .= "<option value='".$f["fach"]."'>".$f["fach"]."</option>";
            }
            $facher = substr($facher, 0, -1);
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
        </div>
        <div id="table_ka"><h1>Entweder hast du Javascript deaktivert, oder ziemlich beschissenes Internet...</h1>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </div>
</body>
