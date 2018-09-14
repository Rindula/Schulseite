<!doctype html>
<html lang="de">
<?php

function is_image($path) {
    $a = getimagesize($path);
    $image_type = $a[2];

    if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
        return true;
    }
    return false;
}

//$exitLink = "/hausaufgaben/show";
$needVerify = false;

// Verifikation des Clients
include "../../_hidden/verify.php";

// Secrets
include "../../../secrets.php";

// Navigationsleiste
include "../../navbar.php";

// Global Header
$title="Lösungen";
include "../../header.php";

// Benötigte Variablen
include "../../_hidden/vars.php";

// CSS Controller
// $styles[] = "hausaufgaben";
$styles[] = "lightbox";
include "../../css/controller.php";

$id = $_GET["id"];
$path = $_SERVER['DOCUMENT_ROOT'] . "/hausaufgaben/loesungen/$id/";

// Hausaufgaben Infos
// select `h`.`ID` AS `ID`,`h`.`Aufgaben` AS `Aufgaben`,`h`.`Datum` AS `Datum`,`f`.`fach` AS `Fach` from (`homeworks`.`list` `h` join `homeworks`.`flist` `f` on((`h`.`Fach` = `f`.`id`))) where (`h`.`Datum` >= (now() + interval -(16) hour)) order by `h`.`Datum`

$dbh = new PDO('mysql:host=localhost;dbname=homeworks', DB_USER, DB_PASSWORD);
$dbh->query('SET NAMES utf8');

$sql = "select `h`.`ID` AS `id`,`h`.`Aufgaben` AS `aufgaben`,`h`.`Datum` AS `datum`,`f`.`fach` AS `fach` from (`homeworks`.`list` `h` join `homeworks`.`flist` `f` on((`h`.`Fach` = `f`.`id`))) WHERE h.ID = :id order by `h`.`Datum`";

$sth = $dbh->prepare($sql);
$sth->bindParam(":id", $id);
$sth->execute();
$res = $sth->fetchAll();
foreach ($res as $row) {
    $fach = $row["fach"];
    $datum = $row["datum"];
}

?>
    <body class="container">
        <script src="http://malsup.github.io/jquery.form.js"></script>
        <article>
            <header>
                <h1>PHP 5.4 Datei-Upload mit Fortschrittanzeige</h1>
            </header>
    
            <section>
                <form action="upload.php" method="post" enctype="multipart/form-data" id="upload_form">
                    <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="test">
                    <div>
                        <label for="datei">Datei auswählen:</label>
                        <input type="file" name="file1" id="datei">
                    </div>
                    <div>
                        <input name="upload_start" type="submit" value="Hochladen">
                        <input name="abbrechen" type="button" value="Abbrechen" id="abbrechen">
                    </div>
                </form>
            </section>
    
            <section>
                <h2>Fortschritt:</h2>
                <div>
                    <progress max="1" value="0" id="fortschritt"></progress>
                    <p id="fortschritt_txt"></p>
                </div>
            </section>   
        </article>
        <script>
            var intervalID = 0;
            
            $(document).ready(function(e) {

                $('#upload_form').submit(function(e) {

                    if($('#datei').val() == ''){
                        e.preventDefault(); //Event abbrechen

                        return false;
                    }

                    intervalID = setInterval(function() {
                        $.getJSON('fortschritt.php', function(data){

                            if(data)
                            {
                                $('#fortschritt').val(data.bytes_processed / data.content_length);
                                $('#fortschritt_txt').html('Fortschritt '+ Math.round((data.bytes_processed / data.content_length)*100) + '%');
                            }
                        });
                    }, 100); //Zeitintervall auf 0.1s setzen

                    $('#upload_form').ajaxSubmit({    
                        success: function()
                        {
                            $('#fortschritt').val('1');
                            $('#fortschritt_txt').html('Fertig');
                            clearInterval(intervalID);    
                        },                                                
                        error:    function()
                        {
                            $('#fortschritt').val('1');
                            $('#fortschritt_txt').html('Ein Fehler ist aufgetreten');
                            clearInterval(intervalID);    
                        }
                    });
                    e.preventDefault(); //Event Abbrechen

                });

                $('#abbrechen').click(function(e) {
                    $.ajax("fortschritt.php?cancel=true");
                    $('#fortschritt').val('1');
                    $('#fortschritt_txt').html('Upload abgebrochen');

                    clearInterval(intervalID);
                });
            });
        </script>
        <?php include "../../_hidden/bottomScripts.php" ?>
        
    </body>
</html>