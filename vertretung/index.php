<!doctype html>
<html lang="de">
    <?php include "../header.php"; include "../_hidden/vars.php"; $needVerify = false; include "../_hidden/verify.php"; include "../css/controller.php" ?>
    <script>
        function getKnownRepresentations() {
            var processer = new XMLHttpRequest();
            processer.onreadystatechange = function() {
                if (this.readyState == XMLHttpRequest.DONE) {
                    document.getElementById("content-<?=date()?>").innerHTML = this.responseText;
                    console.log("=====Geladen=====");
                    console.log(this.responseText);
                } else {
                    console.log("-----Status-----");
                    console.log(this.readyState);
                    console.log(this.status);
                }
            }
            processer.open('GET', './process.php', true);
            processer.send(null);
        }
        function getKnownRepresentationsTomorrow() {
            var processer = new XMLHttpRequest();
            processer.onreadystatechange = function() {
                if (this.readyState == XMLHttpRequest.DONE) {
                    document.getElementById("content-<?= date("Y-m-d", strtotime('+1 day', time())) ?>").innerHTML = this.responseText;
                    console.log("=====Geladen=====");
                    console.log(this.responseText);
                } else {
                    console.log("-----Status-----");
                    console.log(this.readyState);
                    console.log(this.status);
                }
            }
            processer.open('GET', './processTomorrow.php', true);
            processer.send(null);
        }
    </script>
    <body onLoad="getKnownRepresentations();getKnownRepresentationsTomorrow();" class="container">
        <?php include "../navbar.php" ?>
        <h1>Vertretung (<?= date("d.m.Y") ?>)</h1>
        <div id="content-<?=date()?>"></div>
        <h1>Vertretung (<?= date("d.m.Y", strtotime('+1 day', time())) ?>)</h1>
        <div id="content-<?= date("Y-m-d", strtotime('+1 day', time())) ?>"></div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>

