<table class="table table-striped">
    <tr>
        <th>Stunde</th>
        <th>Typ</th>
        <th>Notiz</th>
    </tr>
<?php

list($user, $pass) = array('root', '74cb0A0kER');
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