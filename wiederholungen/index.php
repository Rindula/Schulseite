<?php
$needVerify = true;
$vLevel = 1;

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
$styles[] = "lightbox";
include "../css/controller.php";

function dirToArray($dir) {

    $result = array();

    $cdir = scandir($dir, 1);
    ?>
    <div style="margin-left: 20px; margin-top: 10px;">
        <?php
        $ctr = 1;
        foreach ($cdir as $key => $value) {
            $show = false;
            if (!in_array($value, array(".", ".."))) {
                if (is_image($dir . DIRECTORY_SEPARATOR . $value)) {
                    $path_parts = pathinfo($dir . DIRECTORY_SEPARATOR . $value);
                    list($dump, $year, $month, $day, $fach) = explode("-", str_replace(DIRECTORY_SEPARATOR, "-", $dir));
                    ?>
                    <div style="display: inline-block; background-color: red">
                        <a style="text-decoration: none; color: white; display: block; padding: 10;" data-lightbox='wiederholung<?= str_replace(".", "", str_replace(DIRECTORY_SEPARATOR, "-", $dir)) ?>' href='<?= $dir . DIRECTORY_SEPARATOR . $value ?>'><?= strftime("%a, %d.%B.%Y", strtotime($year . "-" . $month . "-" . $day)) . " | $fach | " . $ctr ?><img style='padding: 2.5%; width: 25%; display: none;' src='<?= $dir . DIRECTORY_SEPARATOR . $value ?>' /></a>
                    </div>
                    <?php
                    $ctr++;
                    $show = true;
                } else {
                    
                }
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $value;
                }
            }
        }
        if ($show) {
            ?>
            <hr>
            <?php
        }
        ?>
    </div>
    <?php
    return $result;
}

function is_image($path) {
    $a = getimagesize($path);
    $image_type = $a[2];

    if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
        return true;
    }
    return false;
}
?>
<script type="text/javascript" src="/scripts/lightbox.js"></script>
<?php
dirToArray(".");
?> 