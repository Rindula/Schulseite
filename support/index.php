<?php $needVerify = false; include "../_hidden/verify.php" ?>
<?php include "../css/controller.php" ?>
<?php include "../navbar.php" ?>
<?php

$conn = new mysqli("25.83.12.108", "root", "SiSal2002", "support");
if($conn->connect_error) {
    echo("<h1 class='display-4'>Datenbank nicht erreichbar, Supportsystem nicht funktionsfähig!</h1>");
} else {
?>
<a class="btn btn-warning btn-block rounded-0" href="new.php">Neues Ticket</a>
<h2 class="display-4">Aktuelle Tickets</h2>
<div class="list-group">
<?php
    $ret = $conn->query("SELECT t.text, t.timestamp, t.von, s.name FROM tickets as t inner join supporter as s on s.id = t.supporter WHERE erledigt = 0");
    while($r = $ret->fetch_assoc()) {
        ?>
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?= $r["von"] ?></h5>
                <small><?= date("d.m.Y, G:i", strtotime($r["timestamp"])) ?></small>
            </div>
            <p class="mb-1"><?= $r["text"] ?></p>
            <small>Angenommen von: <?= $r["name"] ?></small>
        </a>
        <?php
    }
?>
</div>

<?php } include "../_hidden/bottomScripts.php" ?>