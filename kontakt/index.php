<?php $needVerify = false; include "../_hidden/verify.php" ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kontakt</title>
    <?php $styles[] = "kontakt"; include "../css/controller.php" ?>
</head>
<body>
    <div id="part-1"><a href="mailto:contact@rindula.de?subject=Kontaktmail" target="_blank">Via E-Mail</a></div>
    <div id="part-2"><a href="https://discord.gg/wHYgQxU" target="_blank">Auf meinem Discord Server</a></div>
    <div id="part-3"><a href="ts3server://rindula.de?port=9987" target="_blank">Vielleicht bin ich auch auf meinem TS 3 Server...</a></div>
    <?php if ($loggedIn) ?><div id="part-4"><a href="./lehrer">Oder doch lieber einen Lehrer?</a></div><?php ; ?>
</body>
</html>