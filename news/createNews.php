<?php $needVerify = false; include "../_hidden/verify.php"; include "../_hidden/vars.php"; $darkMode = ($_COOKIE["darkmode"] == "true") ? true : false; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Nachrichten Erstellen</title>
<?php include "../css/controller.php" ?>
</head>

<body class="container">
<?php include "../navbar.php" ?>
<div>
<h2 class="display-2">Changelog</h2>
<div id="changelog"></div>
</div>
<?php include "../_hidden/bottomScripts.php" ?>
</body>
</html>
