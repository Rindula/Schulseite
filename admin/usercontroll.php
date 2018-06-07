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
    
        list($user, $pass) = array('root', '74cb0A0kER');
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
                        <span id='email'>".$row["email"]."</span>
                    </div>
                    <div class='form-group'>
                    <select class='form-control' name='gruppe'>
                ";
                foreach ($gruppen as $value) {
                    echo "<option".(($value[0] == $row["gruppe"]) ? " selected" : "")." value='".$value[0]."'>".$value[1]."</option>";
                }
                echo "
                    </select>
                    </div>
                    <button class='btn btn-outline-info float-right form-control' name='user' type='submit' value='".$row["id"]."'>Speichern</button>
                </form>
            </li>
            ";
        }
        ?>
        </ul>
        <?php include "../_hidden/bottomScripts.php" ?>
    </body>
</html>
