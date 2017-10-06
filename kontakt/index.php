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
    <a id="part-1" href="mailto:contact@rindula.de?subject=Kontaktmail" target="_blank">Via E-Mail</a>
    <a id="part-2" href="https://discord.gg/wHYgQxU" target="_blank">Auf meinem Discord Server</a>
    <a id="part-3" href="ts3server://rindula.de?port=9987" target="_blank">Vielleicht bin ich auch auf meinem TS 3 Server...</a>
    <?php if ($loggedIn) ?><a id="part-4" href="./lehrer">Oder doch lieber einen Lehrer?</a><?php ; ?>
</body>
</html>