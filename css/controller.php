<?php
$styles[] = "style";

foreach ($styles as $s) {
    echo "<link rel='stylesheet' href='/css/$s.css'>";
}
if ($loggedIn) {
?>
<style>
    .dropdown .dropbtn, .container a, .container {
        background-color: <?= $_SESSION["colors"][0] ?>;
        color: <?= $_SESSION["colors"][1] ?>;
    }
     .container .hr {
         border: 1px solid <?= $_SESSION["colors"][1] ?>;
         background-color: <?= $_SESSION["colors"][0] ?>;
         display: block;
         height: 100%;
     }
    html, body, content {
        background-color: <?= $_SESSION["colors"][2] ?>;
    }
</style>
<?php } ?>