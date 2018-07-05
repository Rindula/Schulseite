<?php
//$exitLink = "/hausaufgaben/show";
$needVerify = true;
$needAdmin = true;

// Verifikation des Clients
include "../_hidden/verify.php";

// Navigationsleiste
$page = "hausaufgaben";
include "../navbar.php";

// Global Header
$title="Benutzerverwaltung";
include "../header.php";

// Benötigte Variablen
include "../_hidden/vars.php";

// CSS Controller
include "../css/controller.php";


?>
<!doctype html>
<html lang="de">
    
    <body class="container">
        <ul class="list-group list-group-flush">
    <?php
    
        list($user, $pass) = array('query', 'Gen11!1y');
        $dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
        $dbh->query("SET NAMES utf8");

        $gruppen = array();

        foreach ($dbh->query('SELECT id, displayName FROM groups ORDER BY id') as $row) {
            $gruppen[] = array($row["id"], $row["displayName"]);
        }

        foreach ($dbh->query('SELECT name, vorname, id, email, gruppe FROM users ORDER BY name') as $row) {
            echo "
            <li class='list-group-item'>
                <form class='form form-control' action='processUser.php' method='post'>
                    <div class='form-group'>
                        <span id='name'>".$row["name"].", ".$row["vorname"]."</span><br>
                        <span id='email'><a class='text-info' href='mailto:".$row["email"]."'>".$row["email"]."</a></span>
                    </div>
                    <input type='hidden' name='email' value='".$row["email"]."'>
                    <input type='hidden' name='name' value='".$row["vorname"]." ".$row["name"]."'>
                    <div class='form-group'>
                    <select class='form-control' name='gruppe'>
                ";
                foreach ($gruppen as $value) {
                    echo "<option".(($value[0] == $row["gruppe"]) ? " selected" : "")." value='".$value[0]."'>".$value[1]."</option>";
                }
                echo "
                    </select>
                    </div>
                    <div class='form-group mt-1'>
                        <button class='btn btn-outline-info form-control' name='user' type='submit' value='".$row["id"]."'>Speichern</button>
                    </div>
                    <div class='form-group mt-1'>
                        <button class='btn btn-outline-danger form-control' name='resetPass' type='submit' value='".$row["id"]."'>Passwort zurücksetzen</button>
                    </div>
                </form>
            </li>
            ";
        }
        ?>
        </ul>
        <?php include "../_hidden/bottomScripts.php" ?>
    </body>
</html>
