<?php include "../_hidden/verify.php" ?>
<!DOCTYPE html>
<html class="bg-light" lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Neues Ticket</title>
    <?php include "../css/controller.php" ?>
</head>
<body>
<?php include "../navbar.php" ?>
    <h1 class="display-4 m-4">Neues Ticket erstellen</h1>
    <form class="form p-4" action="enterTicket.php" method="post">
        <div class="input-group">
            <span class="input-group-addon fa fa-id-card"></span>
            <input class="form-control" type="name" placeholder="Dein Name" name="name">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon fa fa-bug"></span>
            <textarea class="form-control" type="text" placeholder="Dein Problem/gefundener Bug" name="text"></textarea>
        </div>
        <br>
        <div class="btn-group">
            <button class="btn btn-outline-success" type="submit">Abschicken</button>
            <button class="btn btn-danger" type="reset">Eingabe zurücksetzen</button>
        </div>
    </form>
    <?php include "../_hidden/bottomScripts.php" ?>
</body>
</html>