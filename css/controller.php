<?php
$styles[] = "style";

foreach ($styles as $s) {
    echo "<link rel='stylesheet' href='/css/$s.css'>";
}
if ($loggedIn) {
    $gervsf = new mysqli("localhost", "root", "74cb0A0kER", "stats");
    if ($gervsf->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $gervsf->connect_error);
    }
    $sql = "SET NAMES 'utf8'";
    $gervsf->query($sql);
    $req = $gervsf->query("SELECT navbarBack, navbarText, backgroundPage FROM users WHERE id = '".$_SESSION["userid"]."'");
    $r = $req->fetch_assoc();
?>
<style>
    .dropdown .dropbtn, .container a, .container {
        background-color: <?= $r["navbarBack"] ?>;
        color: <?= $r["navbarText"] ?>;
    }
     .container .hr {
         border: 1px solid <?= $r["navbarText"] ?>;
         background-color: <?= $r["navbarBack"] ?>;
         display: block;
         height: 100%;
     }
    html, body, content {
        background-color: <?= $r["backgroundPage"] ?>;
    }
</style>
<?php } ?>