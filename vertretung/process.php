<?php
if (isset($_GET["mobil"])) {
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <?php
}
?>
<table class="table table-striped">
    <tr>
        <th>Stunde</th>
        <th>Typ</th>
        <th>Notiz</th>
    </tr>
<?php

list($user, $pass) = array('query', 'Gen11!1y');
$dbh = new PDO('mysql:host=rindula.de;dbname=stats', $user, $pass);

foreach ($dbh->query('SELECT stunde, typ, note FROM vertretung WHERE datum BETWEEN adddate(now(), interval -1 day) AND adddate(now(), interval 0 day)') as $row) {
    switch ($row["typ"]) {
        case '1':
            $typ = "Vertretung";
            break;
        
        case '2':
            $typ = "Raumvertretung";
            break;
        
        case '1':
            $typ = "Entfall";
            break;
        
        default:
            $typ = "ERROR: Typ nicht definiert!";
            break;
    }
    ?>
<tr>
    <td><?= $row["stunde"] ?></td>
    <td><?= $typ ?></td>
    <td><?= $row["note"] ?></td>
</tr>
    <?php
}
?>
</table>