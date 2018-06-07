<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <title><?= $title ?></title>
    </head>
    <body class="container">
        <form class="form form-control" method="post">
        <ul class="list-group list-group-flush">
    <?php
    
        list($user, $pass) = array('root', '74cb0A0kER');
        $dbh = new PDO('mysql:host=localhost;dbname=stats', $user, $pass);
        $dbh->query("SET NAMES utf8");

        $gruppen = array();

        foreach ($dbh->query('SELECT id, displayName FROM groups') as $row) {
            $gruppen[] = array($row["id"], $row["displayName"]);
        }

        foreach ($dbh->query('SELECT name, vorname, id, email, gruppe FROM users ORDER BY name') as $row) {
            echo "
            <li class='list-group-item'>
                <div class='float-left'>
                    <span id='name'>".$row["name"].", ".$row["vorname"]."</span><br>
                    <span id='email'>".$row["email"]."</span>
                </div>
                <select class='form-control' name='gruppe'>
            ";
            foreach ($gruppen as $value) {
                echo "<option".(($value[0] == $row["gruppe"]) ? " selected" : "")." value='".$value[0]."'>".$value[1]."</option>";
            }
            echo "
                </select>
                <button class='btn btn-outline-info float-right form-control' name='user' type='submit' value='".$row["id"]."'>Speichern</button>
            </li>
            ";
        }
        ?>
        </ul>
        </form>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>
