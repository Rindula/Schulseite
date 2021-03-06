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
$needVerify = true;

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

$id = $_REQUEST["id"];
$path = $_SERVER['DOCUMENT_ROOT'] . "/hausaufgaben/loesungen/$id/";

if(isset($_GET["u"])) {
    $upload = true;
} else {
    $upload = false;
}

if($upload) {
    $img = base64_encode(file_get_contents($_FILES["datei"]["tmp_name"]));
    $dbh = new PDO('mysql:host=localhost;dbname=homeworks', DB_USER, DB_PASSWORD);
    $dbh->query('SET NAMES utf8');
    
    $sql = "INSERT INTO loesungen (hid, data, extension) VALUES (:id, :data, :ext)";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(":id", $id);
    $sth->bindParam(":data", $img);
    $sth->bindParam(":ext", $_FILES["datei"]["type"]);
    $sth->execute();
}

?>
    <body class="container">
        <script src="/scripts/jquery.form.js"></script>
        <article>
            <header>
                <h1>Lösungsuploader</h1>
            </header>
    
            <section>
                <form action="upload.php?u" method="post" enctype="multipart/form-data" id="upload_form">
                    <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="test">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div>
                        <label for="datei">Datei auswählen:</label>
                        <input type="file" name="datei" id="datei">
                    </div>
                    <div class="btn-group">
                        <input class="btn btn-success" name="upload_start" type="submit" value="Hochladen">
                        <input class="btn btn-danger" name="abbrechen" type="button" value="Abbrechen" id="abbrechen">
                    </div>
                </form>
            </section>
    
            <section>
                <h2>Fortschritt:</h2>
                <div>
                    <div class="progress">
                        <div id="fortschritt" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="1">
                        </div>
                    </div>
                </div>
            </section>   
        </article>
        <script>
            var intervalID = 0;
            solId = <?= ltrim($id, '0') ?>;
            
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
                                var val = data.bytes_processed / data.content_length;
                                $('#fortschritt').css('width', val+'%').attr('aria-valuenow', val);
                            }
                        });
                    }, 100); //Zeitintervall auf 0.1s setzen

                    $('#upload_form').ajaxSubmit({    
                        success: function()
                        {
                            $('#fortschritt').css('width', '100%').attr('aria-valuenow', "1");
                            clearInterval(intervalID);    
                        },                                                
                        error:    function()
                        {
                            $('#fortschritt').css('width', '100%').attr('aria-valuenow', "1");
                            clearInterval(intervalID);    
                        },
                        complete: function()
                        {
                            $(location).attr('href', '/hausaufgaben/loesungen/?id=' + solId);
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