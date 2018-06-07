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
<form class="form form-control" action="process.php" method="post">
    <label for="news">Nachrichten		:</label> <input type="text" id="news" name="news" class="form-control" />
	<label for="showdate">Datum der Anzeige:</label> <input type="date" id="showdate" name="showdate" class="form-control" />
	<label for="expdate">Enddatum			:</label> <input type="date" id="expdate" name="expdate" class="form-control" />
	<label for="needLogin">Login Notwendig		:</label> <select id="needLogin" name="needLogin" class="form-control" >
		<option value="0" selected>Nein</option>
		<option value="1">Ja</option>
	</select>
    <input type="submit" value="absenden" />
</form>
<?php include "../_hidden/bottomScripts.php" ?>
</body>
</html>
